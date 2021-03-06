<?php $__env->startPush('styles'); ?>
 <?php echo Html::style('vendors/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css');; ?>

 <?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
        <!-- page content -->
          <div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kelola Pengguna</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" ng-app="">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Daftar Pengguna</h2>
                          <div class="clearfix"></div>
                        </div>
                      <?php if(session()->has('flash_notification.message')): ?>
                          <div class="alert alert-<?php echo e(session('flash_notification.level')); ?>">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <?php echo session('flash_notification.message'); ?>

                          </div>
                      <?php endif; ?>
                        <div class="row">
                          <a class="btn btn-primary" href="/user/create" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Pengguna</a>
                      </div>
                        <table id="users-table" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <!-- <th>ID</th> -->
                              <th>Nama Lembaga</th>
                              <th>Username</th>
                              <th>Created at</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->
        <?php $__env->stopSection(); ?>
        
        <?php $__env->startPush('scripts'); ?>
        <?php echo Html::style('vendors/jquery-nice-select/css/nice-select.css');; ?>

        <?php echo Html::script('vendors/jquery-nice-select/js/jquery.nice-select.js');; ?>

        <?php echo Html::script('vendors/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js');; ?>

        <script type="text/javascript">

          $(document).ready(function() {
            $('#nice-select').niceSelect();
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(URL::to('getUser')); ?>",
                columns: [
                    // { data: '_id', name: '_id' },
                    { data: 'username', name: 'username' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' },
                ]
            });
          });


          $(document).on("click", ".btn-delete", function (e){
            e.preventDefault();
            var self = $(this);
            swal({
              title: "Apakah Anda Yakin?",
              text: "Anda akan menghapus salah satu data pengguna!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya, Hapuskan!",
              cancelButtonText: "Tidak, Batalkan!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
                 // $(this).parents("form").submit();
                 swal("Deleted!", "Data Berhasil Dihapus", "success");
                 setTimeout(function() {
                        self.parents("form").submit();
                    }, 2000);
              } else {
                swal("Batal", "Proses Telah Dibatalkan", "error");
              }
            });
          });

          $(document).on("click", "#aktif", function (){
            tabrow = $(this).closest('tr');
            status = 1;
            activeInactive(tabrow, status);
          });
          $(document).on("click", "#nonaktif", function (){
            tabrow = $(this).closest('tr');
            status = 0;
            activeInactive(tabrow, status);
          });
          function activeInactive(tab_row, stat_btn) {
            tabrow = table.row( tab_row );
            id_tab = tabrow.data()[0];
            un_tab = tabrow.data()[2];
            $.ajax({
              type: "post",
              url : "",
              data: {id:id_tab,username:un_tab,type:stat_btn},
              success: function(output) {
                swal(
                  'Berhasil!',
                  output,
                  'success'
                );
                table.draw();
              }
            });
            return false;
          }
        </script>

        <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>