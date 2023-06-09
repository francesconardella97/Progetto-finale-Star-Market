<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Image;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Spatie\Image\Image as SpatieImage;
use Spatie\Image\Manipulations;

class RemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $announcement_image_id;
    private $smile;

    /**
     * Create a new job instance.
     */
    public function __construct($announcement_image_id, $smile='')
    {
        $this->announcement_image_id = $announcement_image_id;
        $this->smile = $smile;
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       $i = Image::find($this->announcement_image_id);
       if(!$i) {
         return;
       }

       $srcPath = storage_path('app/public/' . $i->path);
       $image = file_get_contents($srcPath);

       putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

       $imageAnnotator = new ImageAnnotatorClient();
       $response = $imageAnnotator->faceDetection($image);
       $faces = $response->getFaceAnnotations();

       foreach ($faces as $face) {
          $vertices = $face->getBoundingPoly()->getVertices();
          
          $bounds = [];
          foreach ($vertices as $vertex){
             $bounds[] = [$vertex->getX(), $vertex->getY()];
          }
          $w = $bounds[2][0] - $bounds[0][0];
          $h = $bounds[2][1] - $bounds[0][1];

          $image = SpatieImage::load($srcPath);

          //decommentare per scegliere lo smile
         $image->watermark(base_path('public/media/smile/' . $this->smile))

          //commentare per scegliere lo smile
          //$image->watermark(base_path('public/media/dartvader.png'))

                ->watermarkPosition('top-left')
                ->watermarkPadding($bounds[0][0]-28, $bounds[0][1]-21)
                ->watermarkWidth($w+56, Manipulations::UNIT_PIXELS)
                ->watermarkHeight($h+32, Manipulations::UNIT_PIXELS)
                ->watermarkFit(Manipulations::FIT_STRETCH);

          $image->save($srcPath);
       }
       $imageAnnotator->close();
    }
}
