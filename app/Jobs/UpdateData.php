<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Http\Controllers\RMLController;

use App\Http\Controllers\OaiController;
use App\Http\Controllers\JsonController;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateData extends Job implements SelfHandling,ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $id;
    public function __construct($id)
    {
        //
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        print_r($this->id);
        $RML = new RMLController;
        $documents = $RML->getId($this->id);
        
        // if($documents->count()==0){
        //     echo "Web Service tidak ditemukan";
        //     exit;
        // }

        foreach ($documents as $document) {
            switch ($document->jenis) {
                case 'oai':
                    $this->getOai($document);
                    echo "oai";
                    break;
                case "json":
                   $this->getJson($document);
                    echo "json";
                    break;
                case "xml":
                    echo "xml";
                    break;
                default:
                    echo "kosong";
                    break;
            }
        
        }
    }

    /**
     * Handle a job failure.
     *
     * @return void
     */
    public function failed()
    {
        echo "gagal";
    }

    public function execUpdate($documents){
        
    }
    public function getOai($document){
        $oaiController = new OaiController($document->nama_collection,$document->link);
        $oaiController->getRecords();
    }
    public function getJson($document){
        echo $document->link;
        $jsonController = new JsonController($document->nama_collection,$document->link,$document->posisi_record);
        $jsonController->getRecords();
    }
}
