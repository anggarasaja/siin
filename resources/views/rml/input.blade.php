@extends('layouts.dashboard')

@section('content')
<div class="x_panel col-md-12">
	<div>
		<h3>Input Web Service</h3>
	</div>
	<hr>
	@if ($status=="fail")
	<div class="alert alert-danger alert-dismissible" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  	<strong>Gagal!</strong> Terjadi kesalahan pada proses penyimpanan Web Service !
	</div>
	@elseif ($status=="success")
	<div class="alert alert-success alert-dismissible" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  	<strong>Sukses!</strong> Penyimpanan Web Service telah berhasil !
	</div>
	@endif
	<form action="/rml/submit" method="POST">
		<div class="form-group">
	    	<label for="penyedia">Penyedia</label>
	    	<input type="text" class="form-control" id="penyedia" name="penyedia" value="">
	  	</div>
	 	<div class="form-group">
	    	<label for="namaservice">Nama Web Service</label>
	    	<input type="text" class="form-control" id="namaservice" name="namaservice" value="">
	  	</div>
	  	<div class="form-group">
	    	<label for="deskripsi">Deskripsi</label>
	    	<textarea class="form-control" rows="3" id="deskripsi" name="deskripsi"></textarea>
	  	</div>
	  	<div class="form-group">
	  		<label for="jenis">Jenis Web Service</label>
		 	<select class="form-control" name="jenis" id="jenis">
		  		<option value="oai">OAI</option>
		  		<option value="json">JSON</option>
		  		<!-- <option value="xml">XML</option> -->
		  	</select>
	  	</div>
	  	<div class="form-group" id="posisi" style="display: none">
	    	<label for="link">Posisi Kedalaman Record di JSON</label>
	    	<input type="number" class="form-control" id="posisi_record" name="posisi_record" data-toggle="tooltip" data-placement="top" title="Letak record dalam array jika record berada dalam array bersarang (Nested Array). Nilai default adalah 0, yang berarti record tidak berada pada array bersarang" value="0">
	  	</div>
	  	<div class="form-group">
	    	<label for="link">Link Web Service</label>
	    	<input type="text" class="form-control" id="link" name="link" value="">
	  	</div>
	  	
	  	<div class="checkbox">
	    	<label>
	      		<input type="checkbox" name="aktif" id="aktif" checked=""> Aktif
	    	</label>
	  	</div>
	  	<input type="hidden" name="proses" value="{{$proses}}">
	  	{{ csrf_field() }}	
	  	<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {

	});
	$( "#jenis" ).change(function() {
		if($("#jenis").val()=="json"){
			$("#posisi").show();
		} else {
			$("#posisi").hide();
		}
  		
	});
</script>

@endsection