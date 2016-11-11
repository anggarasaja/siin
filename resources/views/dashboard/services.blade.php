 @extends('layouts.dashboard')
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
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        </div>
        
    </div>
    
@stop
@push('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
$(function() {
    $('#rml-table').DataTable({
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
            { data: 'action', name: 'action'}
        ],

    });
});
</script>
@endpush