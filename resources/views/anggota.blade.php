<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>
	<a href="/anggota/anggota_tambah"> + Tambah Anggota Baru</a>
	
	<br/>
	<br/>

	<table border="1">
		<tr>
			<th>NIK</th>
			<th>NAMA</th>
			<th>KELAMIN</th>
			<th>KONTAK</th>
			<th>Opsi</th>
		</tr>
		@foreach($anggota as $a)
		<tr>
			<td>{{ $a->anggota_nik }}</td>
			<td>{{ $a->anggota_nama }}</td>
			<td>{{ $a->anggota_kelamin }}</td>
			<td>{{ $a->anggota_kontak }}</td>
			<td>
				<a href="/anggota/anggota_edit/{{ $a->anggota_id }}">Edit</a>
				|
				<a href="/anggota/anggota_hapus/{{ $a->anggota_id }}">Hapus</a>
			</td>
		</tr>
		@endforeach
	</table>


</body>
</html>