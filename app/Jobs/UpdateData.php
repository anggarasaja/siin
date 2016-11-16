<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Http\Controllers\RMLController;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateData extends Job implements ShouldQueue
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
        //
        $RML = new RMLController;
        $documents = $RML->getId($this->id);
        // print_r($documents);
        $this->execUpdate($documents);

    }

    public function execUpdate($documents){
        if($documents->count()==0){
            echo "Web Service tidak ditemukan";
            exit;
        }
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
}
