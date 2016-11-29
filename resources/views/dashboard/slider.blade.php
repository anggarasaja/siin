 @extends('layouts.dashboard')
 @push('styles')
 {!! Html::style('vendors/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css'); !!}
 {!! Html::style('vendors/dropzone/dist/min/dropzone.min.css'); !!}
 @endpush
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="">
        <div class="row">
        <div class="x_panel">
           <div id="main-slider" class="main-slider carousel slide" data-ride="carousel">
                <div id="slider">
                    {!!$slider!!}
                </div>
            </div> 
        </div>
        </div>
           
        <div class="row">
            
            @include('flash::message')
            <div class="col-md-6">
                <div class="x_panel">
                <h2>Daftar gambar yang tersedia</h2>
                <hr>
                <table class="table stripe" id="slider-table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="x_panel">
                <h3>Download template untuk slider <a href="/slider-template" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Download</a></h3>
                </div>
                <div class="x_panel">
                <h2>Tambah Gambar Baru <small>Drag & drop gambar atau klik kotak dibawah ini</small></h2>
                <hr>
                <form action="/slider-upload" class="dropzone dz-clickable" method="POST" enctype="multipart/form-data" id="slider-dropzone"><div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div> 
                    {{ csrf_field() }}
                </form>
                </div>
            </div>
        </div>
        
    </div>
    
@stop
@push('scripts')
{!! Html::script('vendors/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js'); !!}
{!! Html::script('vendors/dropzone/dist/min/dropzone.min.js'); !!}
<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
var sliderTable;

function refreshSlider(){
    $.ajax({
        url: '/slider-html',
        error: function() {
            alertl('<p>Terjadi kesalahan dalam menampilkan slider</p>');
        },
        success: function(data){
            $( "#slider" ).empty();
            $( "#slider" ).html(data);
        }
    })
}
$(function() {


    Dropzone.options.sliderDropzone = {
      init: function() {
        this.on("error", function(file) { 
            new PNotify({
                            title: 'Gagal',
                            text: 'Pengunggahan gambar gagal.',
                            type: 'fail',
                            styling: 'bootstrap3'
                        });
        });
        this.on("success", function(file) { 
            new PNotify({
                            title: 'Berhasil',
                            text: 'Pengunggahan gambar telah berhasil',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
            sliderTable.ajax.reload( null, false );
            refreshSlider();
            

        });
      }
    };

    sliderTable = $('#slider-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/datatables/slider',
        columns: [
            { data: 'gambar', name: 'gambar' },
            { data: 'aktif', name: 'aktif' },
            { data: 'action', name: 'action'}
        ],

    });

    $('#slider-table').on( 'draw.dt', function () {

        $( ".btn-hapus" ).click(function() {
             // alert( $(this).val() );
            var id = $(this).val();
            var filename = $(this).attr('data-filename');
            $.ajax({
                url: '/slider-drop',
                data:{id:id, filename:filename},
                method:"POST",
                error: function() {
                    alert('Terjadi kesalahan dalam menghapus slider');
                },
                success: function(data){
                    sliderTable.ajax.reload( null, false );
                    refreshSlider();
                }
            })
        });
        $( ".btn-aktif" ).click(function() {
            var id = $(this).val();
            $.ajax({
                url: '/slider-activate',
                data:{id:id},
                method:"POST",
                error: function() {
                    alert('Terjadi kesalahan dalam mengaktifkan slider');
                },
                success: function(data){
                    sliderTable.ajax.reload( null, false );
                    refreshSlider();
                }
            })
        });
        $( ".btn-nonaktif" ).click(function() {
            var id = $(this).val();
            $.ajax({
                url: '/slider-deactivate',
                data:{id:id},
                method:"POST",
                error: function() {
                    alert('Terjadi kesalahan dalam menonaktifkan slider');
                },
                success: function(data){
                    sliderTable.ajax.reload( null, false );
                    refreshSlider();
                }
            })
        });
    } );
});
</script>
@endpush