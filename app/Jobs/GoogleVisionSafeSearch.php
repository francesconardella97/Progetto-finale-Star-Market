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

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $announcement_image_id;
    /**
     * Create a new job instance.
     */
    public function __construct($announcement_image_id)
    {
        $this->announcement_image_id = $announcement_image_id;
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
       $response = $imageAnnotator->safeSearchDetection($image);
       $imageAnnotator->close();

       $safe =$response->getSafeSearchAnnotation();

       $adult= $safe->getAdult();
       $medical =$safe->getMedical();
       $spoof=$safe->getSpoof();
       $violence=$safe->getViolence();
       $racy=$safe->getRacy();

       // echo json_encode([$adult, $medical, $spoof, $violence, $racy])

       $likelihoodName=[
        'text-secondary fas fa-circle', 'text-success fas fa-circle', 'text-success fa fa-circle','text-warning fas fa-circle', 'text-warning fas fa-circle', 'text-danger fas fa-circle',
       ];

       $i->adult= $likelihoodName[$adult];
       $i->medical =$likelihoodName[$medical];
       $i->spoof =$likelihoodName[$spoof];
       $i->violence =$likelihoodName[$violence];
       $i->racy =$likelihoodName[$racy];
    //    dd($i);

       $i->save();
    }
}
