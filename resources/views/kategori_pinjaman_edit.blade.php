<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>

	<h3>Edit Kategori Pinjaman</h3>
	<a href="/kategori_pinjaman"> Kembali</a>
	
	<br/>
	<br/>

	@foreach($kategori_pinjaman as $kat)
	<form action="/kategori_pinjaman/kategori_pinjaman_update" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $kat->kategori_id }}"> <br/>
		JENIS <input type="text" name="jenis" value="{{ $kat->kategori_jenis }}"> <br/>		
		BESAR PINJAMAN <input type="number" name="besar" value="{{ $kat->kategori_besar_pinjaman }}"> <br/>		
		LAMA PINJAMAN <input type="number" name="lama" value="{{ $kat->kategori_lama_pinjaman }}"> <br/>		
		BESAR BUNGA <input type="number" name="bunga" value="{{ $kat->kategori_besar_bunga }}"> <br/>		
		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
		

</body>
</html>