<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\OaiModel;

use Phpoaipmh\Client;
use Phpoaipmh\Endpoint;

class OaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        /**
     * @var Endpoint
     */
    private $endpoint;
    /**
     * @var RecordIterator
     */
    private $metadataIterator;
    /**
     * @var Collection
     */
    private $collection;
    /**
     * @var update_version
     */
    private $update_version;

    public function __construct($collection,$update_version,$url)
    {
        $oaiUrl   = $url;
        $this->update_version = $update_version;
        $client = new Client($oaiUrl);
        $this->endpoint = new Endpoint($client);
        $this->collection = $collection;
    }

    public function index()
    {
        // //
        // $url = 'http://isjd.pdii.lipi.go.id/oai2/oai2.php';

        // $client = new OaiPmhClient($url, array(
        //     'schema' => 'oai_dc',
        //     'user-agent' => 'MyTool/0.1',
        //     'max-retries' => 10,
        //     'sleep-time-on-error' => 30,
        // ));

        // try {
        //     $record = $client->record('oai:isjd.pdii.lipi.go.id:3835');
        // } catch (Scriptotek\OaiPmh\ConnectionError $e) {
        //     echo $e->getMsg();
        //     die;
        // } catch (Scriptotek\OaiPmh\BadRequestError $e) {
        //     echo 'Bad request: ' . $e->getMsg() . "\n";
        //     die;
        // }

        // echo $record->identifier . "<br>";
        // echo $record->datestamp . "<br>";
        // echo $record->data->asXML() . "<br>";   

    }

    public function getAvailableMetadataFormats(){
        // $url = 'http://isjd.pdii.lipi.go.id/oai2/oai2.php';
        // $client = new \Phpoaipmh\Client($url);
        // $this->$endpoint = new \Phpoaipmh\Endpoint($client);

        // Result will be a SimpleXMLElement object
        $data = array();
        // List identifiers
        if (is_null($this->metadataIterator)) {
            $this->metadataIterator = $this->endpoint->listMetadataFormats();
        }
        $data = array(
            'header' => array('Metadata Prefix', 'Schema', 'Namespace'),
            'rows' => array(),
        );
        foreach ($this->metadataIterator as $rec) {
            $data['rows'][] = array(
                $rec->metadataPrefix,
                $rec->schema,
                $rec->metadataNamespace
            );
        }
        print_r($data);
    }

    public function getRecords()
    {
        // $oaim = new OaiModel(['collection'=> 'asd']);
        // $oaim = new OaiModel;
        // $oaim->unguard();
        // $oaim->setTable('lkjl');
        DB::connection()->disableQueryLog();
        OaiModel::unguarded(function() {
            if (empty($this->metadataIterator)) {
                $this->metadataIterator = $this->endpoint->listMetadataFormats();
            } else {
                $this->metadataIterator->rewind(); // rewind the iterator
            }
            $mdPrefix = (string) $this->metadataIterator->current()->metadataPrefix;
            $recordIterator = $this->endpoint->listRecords($mdPrefix);
            $i =0;
            
            foreach($recordIterator as $rec) {
                $namespaces= $rec->getNameSpaces(true);
                foreach ($namespaces as $key => $value) {
                    $arrayNamespaces[$key]=$value;
                }
                $dc = $rec->metadata->children($namespaces['oai_dc'])->dc->children($namespaces['dc']);
                foreach ($dc as $key => $value) {
                    $arrayMetadata[$key]=$value->__toString();
                }

                $model = new OaiModel(['header'=>$arrayNamespaces, 'metadata'=>$arrayMetadata,'update_version'=>$this->update_version]);
                $model->setTable($this->collection);
                $model->save();
                $i++;
            }
            echo $i;
        });
        
    }

    public function listMetadataFormat(){
        $url = 'http://isjd.pdii.lipi.go.id/oai2/oai2.php';
        $client = new \Phpoaipmh\Client($url);
        $myEndpoint = new \Phpoaipmh\Endpoint($client);
        $result = $myEndpoint->identify();
        print("<pre>".print_r($result)."</pre>");

        // Results will be iterator of SimpleXMLElement objects
        $results = $myEndpoint->listMetadataFormats();
        foreach($results as $item) {
            var_dump($item);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
