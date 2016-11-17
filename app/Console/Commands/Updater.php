<?php

namespace App\Console\Commands;

use App\Http\Controllers\RMLController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\OaiController;
use App\Http\Controllers\JsonController;
use Illuminate\Console\Command;

class Updater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:dataset {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $id = $this->argument('id');
        // $this->info($id);
        // exit;
        // print_r($this->id);
        $RML = new RMLController;
        $documents = $RML->getId($id);
        
        if($documents->count()==0){
            $this->info("Web Service tidak ditemukan");
            exit;
        }
        DB::collection('rml')->where('_id', $id)
                       ->update(['last_update'=>'Sedang Memperharui Data'], ['upsert' => true]);
        foreach ($documents as $document) {
            switch ($document->jenis) {
                case 'oai':
                    $this->getOai($document);
                    // echo "oai";
                    break;
                case "json":
                   $this->getJson($document);
                    // echo "json";
                    break;
                case "xml":
                    // echo "xml";
                    break;
                default:
                    // echo "kosong";
                    break;
            }
        
        }

        DB::collection('rml')->where('_id', $id)
                       ->update(['last_update'=>date("Y-m-d H:i:s")], ['upsert' => true]);

        $this->info("finish");
    }

    public function getOai($document){
        $oaiController = new OaiController($document->nama_collection,$document->link);
        $oaiController->getRecords();
    }
    public function getJson($document){
        $jsonController = new JsonController($document->nama_collection,$document->link,$document->posisi_record);
        $jsonController->getRecords();
    }
}
