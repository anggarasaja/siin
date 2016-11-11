@extends('layouts.dashboard')

@section('content')
<div class="back-white col-md-12">
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
	    	<input type="text" class="form-control" id="penyedia" name="penyedia">
	  	</div>
	 	<div class="form-group">
	    	<label for="namaservice">Nama Web Service</label>
	    	<input type="text" class="form-control" id="namaservice" name="namaservice">
	  	</div>
	  	<div class="form-group">
	    	<label for="deskripsi">Deskripsi</label>
	    	<textarea class="form-control" rows="3" id="deskripsi" name="deskripsi"> </textarea>
	  	</div>
	  	<div class="form-group">
	  		<label for="jenis">Jenis Web Service</label>
		 	<select class="form-control" name="jenis">
		  		<option value="oai">OAI</option>
		  		<option value="json">JSON</option>
		  		<option value="xml">XML</option>
		  	</select>
	  	</div>
	  	<div class="form-group">
	    	<label for="link">Link Web Service</label>
	    	<input type="text" class="form-control" id="link" name="link">
	  	</div>
	  	<div class="checkbox">
	    	<label>
	      		<input type="checkbox" name="aktif" checked=""> Aktif
	    	</label>
	  	</div>
	  	{{ csrf_field() }}	
	  	<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

@endsection