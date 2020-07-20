<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>
	<a href="/operator/operator_tambah"> + Tambah Operator Baru</a>
	
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
		@foreach($operator as $o)
		<tr>
			<td>{{ $o->operator_nomor_pegawai }}</td>
			<td>{{ $o->operator_nama }}</td>
			<td>{{ $o->operator_kelamin }}</td>
			<td>{{ $o->operator_kontak }}</td>
			<td>
				<a href="/operator/operator_edit/{{ $o->operator_id }}">Edit</a>
				|
				<a href="/operator/operator_hapus/{{ $o->operator_id }}">Hapus</a>
			</td>
		</tr>
		@endforeach
	</table>


</body>
</html>