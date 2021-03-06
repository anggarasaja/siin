<?php $__env->startPush('styles'); ?>
<style type="text/css">
	#not-available {
		float: left;
	    margin: 0 0 0 20px;
	    padding: 3px 10px;
	    color: #FFF;
	    border-radius: 3px 4px 4px 3px;
	    background-color: #CE5454;
	    max-width: 170px;
	    white-space: pre;
	    position: relative;
	    left: 0;
	    opacity: 1;
	    z-index: 1;
	    transition: 0.15s ease-out;
	}
	#not-available::after{
		content: '';
	    display: block;
	    height: 0;
	    width: 0;
	    border-color: transparent #CE5454 transparent transparent;
	    border-style: solid;
	    border-width: 11px 7px;
	    position: absolute;
	    left: -13px;
	    top: 1px;
	}
	#available {
		float: left;
	    margin: 0 0 0 20px;
	    padding: 3px 10px;
	    color: #FFF;
	    border-radius: 3px 4px 4px 3px;
	    background-color: #26B99A;
	    max-width: 170px;
	    white-space: pre;
	    position: relative;
	    left: 0;
	    opacity: 1;
	    z-index: 1;
	    transition: 0.15s ease-out;
	}
	#available::after{
		content: '';
	    display: block;
	    height: 0;
	    width: 0;
	    border-color: transparent #26B99A transparent transparent;
	    border-style: solid;
	    border-width: 11px 7px;
	    position: absolute;
	    left: -13px;
	    top: 1px;
	}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="x_panel col-md-12">
	<div>
		<h3>Input Web Service</h3>
	</div>
	<hr>
	<?php if($status=="fail"): ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  	<strong>Gagal!</strong> Terjadi kesalahan pada proses penyimpanan Web Service !
	</div>
	<?php elseif($status=="success"): ?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  	<strong>Sukses!</strong> Penyimpanan Web Service telah berhasil !
	</div>
	<?php endif; ?>
	<form action="/rml/submit" method="POST" class="form-horizontal form-label-left">
		<div class="item form-group">
	    	<label for="penyedia" class="control-label col-md-3 col-sm-3 col-xs-12">Penyedia</label>
	    	<div class="col-md-6 col-sm-6 col-xs-12">
	    		<input type="text" class="form-control col-md-7 col-xs-12" id="penyedia" name="penyedia" value="" required="required">
	    	</div>
	  	</div>
	 	<div class="item form-group">
	    	<label for="namaservice" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Web Service</label>
	    	<div class="col-md-6 col-sm-6 col-xs-12">
	    		<input type="text" class="form-control col-md-7 col-xs-12" id="namaservice" name="namaservice" value="" required="required">
	    	</div>
	    	<div id='not-available' style="display: none">Sudah digunakan</div>
	    	<div id='available' style="display: none"><i class="fa fa-check" aria-hidden="true"></i> Tersedia</div>
	  	</div>
	  	<div class="item form-group">
	    	<label for="deskripsi" class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
	    	<div class="col-md-6 col-sm-6 col-xs-12">
	    		<textarea class="form-control col-md-7 col-xs-12" rows="3" id="deskripsi" name="deskripsi" required="required"></textarea>
	    	</div>
	  	</div>
	  	<div class="item form-group">
	  		<label for="jenis" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Web Service</label>
	  		<div class="col-md-6 col-sm-6 col-xs-12">
			 	<select class="form-control col-md-7 col-xs-12" name="jenis" id="jenis" required="required">
			  		<option value="">== Pilih Jenis ==</option>
			  		<option value="oai">OAI</option>
			  		<option value="json">JSON</option>
			  		<!-- <option value="xml">XML</option> -->
			  	</select>
			</div>
	  	</div>
	  	<div class="item form-group" id="posisi" style="display: none">
	    	<label for="link" class="control-label col-md-3 col-sm-3 col-xs-12">Posisi Kedalaman Record di JSON</label>
	    	<div class="col-md-6 col-sm-6 col-xs-12">
	    		<input type="number" class="form-control col-md-7 col-xs-12" id="posisi_record" name="posisi_record" data-toggle="tooltip" data-placement="top" title="Letak record dalam array jika record berada dalam array bersarang (Nested Array). Nilai default adalah 0, yang berarti record tidak berada pada array bersarang" value="0" required="required"> 
	    	</div>
	  	</div>
	  	<div class="item form-group">
	    	<label for="link" class="control-label col-md-3 col-sm-3 col-xs-12">Link Web Service</label>
	    	<div class="col-md-6 col-sm-6 col-xs-12">
	    		<input type="text" class="form-control col-md-7 col-xs-12" id="link" name="link" value=""  required="required">
	    	</div>
	  	</div>
	  	<div class="item form-group">
	  		<div class="checkbox">

	    	<div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
		    	<label>
		    		<div class="col-md-6 col-sm-6 col-xs-12 ">
		      			<input type="checkbox" name="aktif" id="aktif" checked=""> Aktif
		      		</div>
		    	</label>
		  	</div>
	  	</div>
	  	
	  	<input type="hidden" name="proses" value="<?php echo e($proses); ?>">
	  	<?php echo e(csrf_field()); ?>	
	  	<button type="submit" class="btn btn-primary" id="submit" disabled>Submit</button>
	</form>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<?php echo Html::script('vendors/validation/dist/jquery.validate.min.js');; ?>


<script type="text/javascript">
	var timeout;
	$(document).ready(function() {
		$("form").validate();	

	    $( "#namaservice" ).keyup(function() {
		  	 if(timeout){ clearTimeout(timeout);}

			  //start new time, to perform ajax stuff in 500ms
			  timeout = setTimeout(function() {
				checkAvailability()
			  },1000);
		});
	});

	 
	function checkAvailability() {
		$.ajax({
	      url: "/rml/get-service-name/",
	      method: "GET",
	      success: function(data) {
	        result = jQuery.parseJSON(data);
	        val = $( "#namaservice" ).val();
	        avail = (jQuery.inArray(val,result));
	        $("#namaservice").closest("div.not-available").remove();
	        $("#namaservice").closest("div.available").remove();
	        if(avail==-1){
	        	$("#namaservice").css({"border":"1px solid #26B99A","position":"relative"})
	        	$("#not-available").hide();
	        	$("#available").show();

	        	$("#submit").prop('disabled',false);
	    	} else {
	    		$("#namaservice").css({"border":"1px solid #CE5454","position":"relative"})
	    		$("#not-available").show();
	        	$("#available").hide();
	    		$("#submit").prop('disabled',true);

	    	}
	        
	      },
	      error: function(data) {
	        console.log(data);
	      }
	    });

	}
	$( "#jenis" ).change(function() {
		if($("#jenis").val()=="json"){
			$("#posisi").show();
		} else {
			$("#posisi").hide();
		}
  		
	});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>