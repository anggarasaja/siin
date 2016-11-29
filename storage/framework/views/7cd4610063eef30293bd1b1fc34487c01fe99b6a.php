<?php $__env->startSection('content'); ?>
<section id="contact" class="contact">
  <div class="contact-area">
    <!-- Google Map Section -->

    <div id="message-details" class="message-details">
      <div class="container">
        <form action="/search" method="GET" id="myForm" class="message-form">
          <div class="row">
            <div class="col-sm-6">
              <input id="author" class="form-control" name="key" type="text" value="" size="30" aria-required="true" placeholder="Kata Kunci Pencarian" title="Name" required="">
              
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select class="form-control" id="sel1" name="id_service" aria-required="true" required>
                  <option value="">== Kategori Data ==</option>
                  <?php foreach($services as $service): ?>
                      <option value="<?php echo e($service['_id']); ?>"><?php echo e($service['nama_service']." (".$service['penyedia'].")"); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <button name="submit" class="btn full-width" type="submit" id="submit">Submit</button>
            </div>
          </div><!-- /.row -->
        </form><!-- /#commentform -->
        <hr>
        <?php if(isset($data)): ?>
        <div class="post-area">
          <div class="post-area-top text-center">
            <h2 class="post-area-title">Hasil Pencarian</h2>
          </div><!-- /.post-area-top -->
        <div class="row">
        <div class="latest-post">
        <?php foreach($data as $result): ?>
        <div class="col-sm-12">
            <div class="item">
              <article class="post type-post">
                <div class="post-content">
                  <div class="table-responsive">
                    
                    <table class="table">
                    <?php if(is_object($result)): ?>
                      <?php if(isset($result->data)): ?>
                        <?php 
                          $arrayRs = $result->data;
                         ?>
                      <?php elseif(isset($result->metadata)): ?>
                        <?php 
                          $arrayRs = $result->metadata;
                         ?>
                      <?php endif; ?>
                    <?php elseif(is_array($result)): ?>
                      <?php if(isset($result['data'])): ?>
                        <?php 
                          $arrayRs = $result['data'];
                         ?>
                      <?php elseif(isset($result['metadata'])): ?>
                        <?php 
                          $arrayRs = $result['metadata'];
                         ?>
                      <?php endif; ?>
                    <?php endif; ?>
                    

                    <?php foreach($arrayRs as $key => $value): ?>
                    <tr>
                      <td>
                        <?php echo trim($key); ?>

                      </td>
                      <td>
                        :
                      </td>
                      <td>
                        <?php if(is_object($value) or is_array($value)): ?>
                          <?php foreach($value as $key2 => $value2): ?>
                          <ul>
                            <li>
                              <?php echo $key2." : ".$value2; ?>

                            </li>
                          </ul>
                          <?php endforeach; ?>
                        <?php else: ?>
                        <?php echo $value; ?>

                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    </table>
                  </div>
                </div><!-- /.post-content -->
              </article>
            </div><!-- /.item -->
          </div>
          <?php endforeach; ?>

          <?php echo e($data->render()); ?>

          </div>  
          </div>
          </div>
          <?php endif; ?>
      </div><!-- /.container -->
    </div><!-- /.message-details -->
  </div><!-- /.contact-area -->
</section> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>