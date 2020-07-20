<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>
	<a href="/kategori_pinjaman/kategori_pinjaman_tambah"> + Tambah Kategori Pinjaman</a>
	
	<br/>
	<br/>

	<table border="1">
		<tr>
			<th>JENIS</th>
			<th>BESAR PINJAMAN</th>
			<th>LAMA PINJAMAN</th>
			<th>BESAR BUNGA</th>
			<th>OPSI</th>
		</tr>
		@foreach($kategori_pinjaman as $kat)
		<tr>
			<td>{{ $kat->kategori_jenis }}</td>
			<td>{{ $kat->kategori_besar_pinjaman }}</td>
			<td>{{ $kat->kategori_lama_pinjaman }} Bulan</td>
			<td>{{ $kat->kategori_besar_bunga }} %</td>
			<td>
				<a href="/kategori_pinjaman/kategori_pinjaman_edit/{{ $kat->kategori_id }}">Edit</a>
				|
				<a href="/kategori_pinjaman/kategori_pinjaman_hapus/{{ $kat->kategori_id }}">Hapus</a>
			</td>
		</tr>
		@endforeach
	</table>


</body>
</html>