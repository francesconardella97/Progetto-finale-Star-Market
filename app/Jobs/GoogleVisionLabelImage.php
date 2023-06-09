<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GoogleVisionLabelImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        private $announcement_image_id;
    /**
     * Create a new job instance.
     */
    public function __construct($announcement_image_id)
    {
        $this->announcement_image_id=$announcement_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i= Image::find($this->announcement_image_id);
        // dd($i);
       if(!$i){
        // dd($i);
        return;
       }

       $image = file_get_contents(storage_path('app/public/' . $i->path));

       //imposta la vairabile di ambiente Googgle_application_credentials al path del credentials file

       putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

       $imageAnnotator= new ImageAnnotatorClient();
       $response = $imageAnnotator->labelDetection($image);
       $labels= $response->getLabelAnnotations();


       if($labels){
        $result=[];
        foreach ($labels as $label){
            $result[]=$label->getDescription();
        }
        $i->labels=$result;
        $i->save();
       }

       $imageAnnotator->close();

       

       // echo json_encode([$adult, $medical, $spoof, $violence, $racy])

    }
    
}
