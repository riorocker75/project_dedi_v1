<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>
	<a href="/kategori_simpanan/kategori_simpanan_tambah"> + Tambah Kategori Pinjaman</a>
	
	<br/>
	<br/>

	<table border="1">
		<tr>
			<th>JENIS</th>
			<th>BIAYA SIMPANAN</th>			
			<th>OPSI</th>
		</tr>
		@foreach($kategori_simpanan as $kat)
		<tr>
			<td>{{ $kat->kategori_jenis }}</td>
			<td>{{ $kat->kategori_biaya_simpanan }}</td>			
			<td>
				<a href="/kategori_simpanan/kategori_simpanan_edit/{{ $kat->kategori_id }}">Edit</a>
				|
				<a href="/kategori_simpanan/kategori_simpanan_hapus/{{ $kat->kategori_id }}">Hapus</a>
			</td>
		</tr>
		@endforeach
	</table>


</body>
</html>