        
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
                    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Tambah Pengguna</h2>
                          <div class="clearfix"></div>
                        </div>
                      <br>

                      <?php if(session()->has('flash_notification.message')): ?>
                          <div class="alert alert-<?php echo e(session('flash_notification.level')); ?>">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                              <?php echo session('flash_notification.message'); ?>

                          </div>
                      <?php endif; ?>

                        <?php if(isset($user)): ?>
                            <?php echo e(Form::model($user, ['url' => ['user', $user->_id], 'method' => 'patch', 'class' => 'form-horizontal', 'role' => 'form'])); ?>

                        <?php else: ?>
                            <?php echo e(Form::open(['url' => 'user', 'class' => 'form-horizontal', 'role' => 'form'])); ?>

                        <?php endif; ?>

                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Nama Lembaga</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e((isset($user)) ?  $user->name  : ''); ?>">

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="<?php echo e((isset($user)) ?  $user->username  : ''); ?>">

                                <?php if($errors->has('username')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e((isset($user)) ?  $user->email  : ''); ?>">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Field Jenis dan Lembaga tingkat User Biasa -->
                        <input type="hidden" name="jenis" value="1">
                        <!-- END Field Jenis dan Lembaga tingkat User Biasa -->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <?php if(!isset($user)): ?>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                                <?php else: ?>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-btn fa-pencil"></i> Edit
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
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

        <script type="text/javascript">
          $(document).ready(function() {
            $('#nice-select').niceSelect();
          });
        </script>
        <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>