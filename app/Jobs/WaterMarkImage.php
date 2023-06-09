<?php

namespace App\Jobs;


use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image as SpatieImage;
use Spatie\Image\Manipulations;

class WaterMarkImage implements ShouldQueue
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
        $i = Image::find($this->announcement_image_id);
        if(!$i) {
          return;
        }
 
        $srcPath = storage_path('app/public/' . $i->path);
        $image = file_get_contents($srcPath);
 
        $image = SpatieImage::load($srcPath);
 
           $image->watermark(base_path('public/media/logo2.png'))
            ->watermarkWidth(40, Manipulations::UNIT_PERCENT)
            //->watermarkHeight(10, Manipulations::UNIT_PERCENT)
        //    ->watermarkFit(Manipulations::FIT_STRETCH)
            ->watermarkPosition(Manipulations::POSITION_BOTTOM_RIGHT)
           ->watermarkPadding(8, 8, Manipulations::UNIT_PERCENT)
           ->watermarkOpacity(80);
                
 
           $image->save($srcPath);
        }
       
     
    }

