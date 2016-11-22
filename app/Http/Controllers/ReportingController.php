<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Libraries\tbs_class;
use App\Libraries\tbs_plugin_opentbs;
use App\Http\Requests;

class ReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getData($collection){
        return DB::collection($collection)->project(['data' => array('$slice' => 1)])->get();
    }

    public function getDoc(){
        // $handle_lembaga = fopen("http://pui.ristekdikti.go.id/index.php/webservice/getData/getLembaga", "rb");
        // $handle_produk = fopen("http://pui.ristekdikti.go.id/index.php/webservice/getData/getProduk", "rb");

        // if (FALSE === $handle_lembaga) {
        //     exit("Failed to open stream to URL");
        // }

        $contents_lembaga = '';
        $contents_produk = '';
        $nama_lembaga= '';
        // while (!feof($handle_lembaga)) {
        //     $contents_lembaga .= fread($handle_lembaga, 8192);
        // }
        // while (!feof($handle_produk)) {
        //     $contents_produk .= fread($handle_produk, 8192);
        // }
        // fclose($handle_lembaga);
        // fclose($handle_produk);

        // $data_pui=json_decode($contents_lembaga);
        // $data_produk=json_decode($contents_produk);
        $data_produk = $this->getData('PUI-produk-json');
        $data_pui = $this->getData('PUI-lembaga-json');

        
        if (version_compare(PHP_VERSION,'5.1.0')>=0) { 
            if (ini_get('date.timezone')=='') { 
                date_default_timezone_set('UTC'); 
            } 
        } 

        // Initialize the TBS instance 
        $TBS = new \App\Libraries\clsTinyButStrong; // new instance of TBS 
        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin 
        $rekap = array();
        $rekap_produk = array();

        $template = app_path().'/Libraries/laporan-pui-new.docx'; 
        $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);

        foreach ($data_pui as $key=> $value) {
            $nm_lmbaga = (string) $value['data']['nama_lembaga'];
            $nama_lembaga = $nm_lmbaga;
            $rekap[] = array(
                'nama_lembaga' => $value['data']['nama_lembaga'],
                'lembaga_induk' => $value['data']['lembaga_induk'],
                'bentuk_lembaga' => $value['data']['bentuk_lembaga'],
                'fokus_bidang' => $value['data']['fokus_bidang'],
                'alamat' => $value['data']['alamat'],
                'no_telp' => $value['data']['no_telp'],
                'fax' => $value['data']['fax'],
                'provinsi' => $value['data']['provinsi'],
                'email' => $value['data']['email'],
                'homepage' => $value['data']['homepage'],
                'kepala_nama' => $value['data']['kepala_nama'],
                'kepala_telp' => $value['data']['kepala_telp'],
                'kepala_email' => $value['data']['kepala_email'],
                'cp_nama' => $value['data']['cp_nama'],
                'cp_email' => $value['data']['cp_email'],
                'cp_jabatan' => $value['data']['cp_jabatan'],
                'deskripsi' => $value['data']['deskripsi'] 
                );
        }
        $TBS->MergeBlock('a', $rekap); 

        // foreach ($data_produk as $key=> $value) {
        //     $name_lembaga = (string) $value['data']['nama_lembaga'];
        //     // if(strcasecmp($name_lembaga, $nama_lembaga)==0){
        //         $rekap_produk[] = array(
        //             'nama_lembaga' => $value['data']['nama_lembaga'],
        //             'nama_produk' => $value['data']['nama_produk'],
        //             'deskripsi' => $value['data']['deskripsi'],
        //             'trl' => $value['data']['trl'],
        //             'potensi_pengguna' => $value['data']['potensi_pengguna'],
        //             'potensi_mitra' => $value['data']['potensi_mitra']
        //             );
        //     // }
        // }

        $TBS->MergeBlock('b', $rekap_produk); 

        $TBS->PlugIn(OPENTBS_DELETE_COMMENTS); 

        $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : ''; 
        $output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template); 
        if ($save_as==='') { 
            // Output the result as a downloadable file (only streaming, no data saved in the server) 
            $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields. 
            // Be sure that no more output is done, otherwise the download file is corrupted with extra data. 
            exit(); 
        } else { 
            // Output the result as a file on the server. 
            $TBS->Show(OPENTBS_FILE, $output_file_name); // Also merges all [onshow] automatic fields. 
            // The script can continue. 
            exit("File [$output_file_name] has been created."); 
        }
    }
}
