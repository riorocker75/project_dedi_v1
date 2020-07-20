<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
	 <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

	<h3>Data Kategori Simpanan</h3>
	<a href="/kategori_simpanan"> Kembali</a>
	<br/>
	<br/>
	<form action="/kategori_simpanan/kategori_simpanan_act" method="post">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">	
		JENIS <input type="text" name="jenis" required="required"> <br/>
		BESAR BIAYA SIMPANAN <input type="number" name="besar" required="required"> <br/>			
		<input type="submit" value="Simpan Data">
	</form>

</body>
</html>