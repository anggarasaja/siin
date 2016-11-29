 
 <?php $__env->startPush('styles'); ?>
 <?php echo Html::style('vendors/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css');; ?>

 <?php echo Html::style('vendors/dropzone/dist/min/dropzone.min.css');; ?>

 <?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="x_panel">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img class="first-slide" src="<?php echo e(URL::asset('img/slider/2.jpg')); ?>" alt="First slide">
                  <div class="container">
                    <div class="carousel-caption">
                        <div class="slider-icon hidden-xs">
                            <img src="<?php echo e(URL::asset('img/Logo_SIIN_white.png')); ?>" style="max-width: 150px">
                        </div><!-- /.slider-icon -->
                        <h3 class="carousel-title"> Sistem Informasi IPTEK Nasional</h3>
                    </div><!-- /.carousel-caption -->
                  </div>
                </div>
                <div class="item">
                  <img class="second-slide" src="<?php echo e(URL::asset('img/slider/1.jpg')); ?>" alt="Second slide">
                  <div class="container">
                    <div class="carousel-caption">
                        <div class="slider-icon hidden-xs">
                            <img src="<?php echo e(URL::asset('img/Logo_SIIN_white.png')); ?>" style="max-width: 150px">
                        </div><!-- /.slider-icon -->
                        <h3 class="carousel-title"> Sistem Informasi IPTEK Nasional</h3>
                    </div><!-- /.carousel-caption -->
                  </div>
                </div>
               
              </div>
              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
        <div class="row">
            
        
            <div class="col-md-6">
                <div class="x_panel">
                <h2>Daftar gambar yang tersedia</h2>
                <hr>
                <div class="row">
                    <a class="btn btn-primary" href="/rml/input" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Gambar</a>
                </div>
                <table class="table stripe" id="rml-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Icon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="x_panel">
                <h2>Daftar gambar yang tersedia</h2>
                <hr>
                <form action="/slider-upload" class="dropzone dz-clickable" method="POST" enctype="multipart/form-data"><div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div> 
                    <?php echo e(csrf_field()); ?>

                </form>
                </div>
            </div>
        </div>
        
    </div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<?php echo Html::script('vendors/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js');; ?>

<?php echo Html::script('vendors/dropzone/dist/min/dropzone.min.js');; ?>

<script>
$(function() {

    var rmlTable = $('#rml-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/datatables/getRml',
        columns: [
            { data: 'penyedia', name: 'penyedia' },
            { data: 'nama_service', name: 'nama_service' }, 
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>