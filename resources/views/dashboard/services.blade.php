 @extends('layouts.dashboard')
 @push('styles')
 {!! Html::style('vendors/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css'); !!}
 @endpush
@section('content')
    <div class="col-md-12">

        <div class="x_panel">
        <h2>Daftar Web Service yang tersedia</h2>
        <hr>
        <div class="row">
            <a class="btn btn-primary" href="/rml/input" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Web Service</a>
        </div>
        <table class="table stripe" id="rml-table">
            <thead>
                <tr>
                    <th>Penyedia</th>
                    <th>Nama Layanan</th>
                    <th>Deskripsi</th>
                    <th>Jenis</th>
                    <th>Link</th>
                    <th>status</th>
                    <th>Terakhir<br>diperbaharui</th>

                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        </div>
        
    </div>
    
@stop
@push('scripts')
{!! Html::script('vendors/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js'); !!}
<script>
$(function() {

    var rmlTable = $('#rml-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/datatables/getRml',
        columns: [
            { data: 'penyedia', name: 'penyedia' },
            { data: 'nama_service', name: 'nama_service' },
            { data: 'deskripsi', name: 'deskripsi' },
            { data: 'jenis', name: 'jenis' },
            { data: 'link', name: 'link' },
            { data: 'aktif', name: 'aktif' },
            { data: 'last_update', name: 'last_update' },
            { data: 'action', name: 'action'}
        ],

    });
    $('#rml-table').on( 'draw.dt', function () {
        $('[data-toggle="popover"]').popover();

        $( ".btn-update" ).click(function() {
             // alert( $(this).val() );
             var id = $(this).val();
             $("#progress-"+id).show();
             $.ajax({
                url: '/updater/updateId/'+id,
                error: function() {
                    alertl('<p>An error has occurred</p>');
                }
            }).done(function(data){

                $("#progress-"+id).hide();
                new PNotify({
                        title: 'Pembaharuan selesai',
                        text: 'Pembaharuan dataset telah selesai',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                rmlTable.ajax.reload( null, false );
            });
        });
    } );
});
</script>
@endpush