<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>

	<h3>Edit Kategori Simpanan</h3>
	<a href="/kategori_simpanan"> Kembali</a>
	
	<br/>
	<br/>

	@foreach($kategori_simpanan as $kat)
	<form action="/kategori_simpanan/kategori_simpanan_update" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $kat->kategori_id }}"> <br/>
		JENIS <input type="text" name="jenis" value="{{ $kat->kategori_jenis }}"> <br/>		
		BESAR BIAYA <input type="number" name="besar" value="{{ $kat->kategori_biaya_simpanan }}"> <br/>			
		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
		

</body>
</html>