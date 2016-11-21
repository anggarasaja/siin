<?php

namespace App\Console\Commands;

use App\Http\Controllers\RMLController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\OaiController;
use App\Http\Controllers\JsonController;
use Illuminate\Console\Command;

class Updater extends Command
{
    protected $fields = array();
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

    protected $update_version ;

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
        $document = $RML->getId($id);

        
        if($document->count()==0){
            $this->info("Web Service tidak ditemukan");
            exit;
        }
        if(isset($document[0]->update_version)){
            $this->update_version = $document[0]->update_version + 1;
        } else {
            $this->update_version = 1;
        }
        DB::collection('rml')->where('_id', $id)
                       ->update(['last_update'=>'Sedang Memperharui Data', 'update_version'=>$this->update_version], ['upsert' => true]);
        
            switch ($document[0]->jenis) {
                case 'oai':
                    $this->getOai($document[0]);
                    // echo "oai";
                    break;
                case "json":
                   $this->getJson($document[0]);

                    // echo "json";
                    break;
                case "xml":
                    // echo "xml";
                    break;
                default:
                    // echo "kosong";
                    break;
            }
        
        
        $this->info($document[0]->nama_collection);
        $this->updateFields($document[0]);

        DB::collection('rml')->where('_id', $id)
                       ->update(['last_update'=>date("Y-m-d H:i:s"),'fields'=>$this->fields], ['upsert' => true]);

        $this->info("finish");
    }

    public function getOai($document){

        $oaiController = new OaiController($document->nama_collection,$this->update_version,$document->link);
        $oaiController->getRecords();
    }
    public function getJson($document){
         $this->info("proses");
        $jsonController = new JsonController($document->nama_collection,$this->update_version,$document->link,$document->posisi_record);
        $jsonController->getRecords();
    }

    public function updateFields($document){
        $result = DB::collection($document->nama_collection)->raw()->findOne();
        switch ($document->jenis) {
            case 'oai':
                $this->findFields((array)$result->metadata);
                // echo "oai";
                break;
            case "json":
               $this->findFields((array)$result->data);
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

    public function findFields(array $array, $prevPrefix=""){
        if($prevPrefix==""){
            $dot="";
        } else {
            $dot=".";
        }
        foreach ($array as $key => $value) {
            if(is_array($value)){
                
                $this->findFields($value,$prevPrefix.$dot.$key);
            } elseif (is_object($value)){
                // $prevPrefix=$prevPrefix.'.'.$key;
                $this->findFields((array)$value,$prevPrefix.$dot.$key);
            } else {
                array_push($this->fields,$prevPrefix.$dot.$key);
            }
        }
    }
}
