<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
	 <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

	<h3>Data Kategori Pinjaman</h3>
	<a href="/kategori_pinjaman"> Kembali</a>
	<br/>
	<br/>
	<form action="/kategori_pinjaman/kategori_pinjaman_act" method="post">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">	
		JENIS KATEGORI <input type="text" name="jenis" required="required"> <br/>
		BESAR PINJAMAN <input type="number" name="besar" required="required"> <br/>
		LAMA PINJAMAN <input type="number" name="lama" required="required"> <br/>
		BESAR BUNGA <input type="number" name="bunga" required="required"> <br/>		
		<input type="submit" value="Simpan Data">
	</form>

</body>
</html>