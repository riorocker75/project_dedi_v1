<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>

	<h3>Edit anggota</h3>
	<a href="/anggota"> Kembali</a>
	
	<br/>
	<br/>

	@foreach($anggota as $a)
	<form action="/anggota/anggota_update" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $a->anggota_id }}"> <br/>
		NIK <input type="text" name="nik" value="{{ $a->anggota_nik }}"> <br/>
		NAMA <input type="text" name="nama" value="{{ $a->anggota_nama }}"> <br/>
		KELAMIN 
		<select name="kelamin" required="required">
			<option value="">--Pilih--</option>
			<option value="Laki - Laki">Laki - Laki</option>
			<option value="Perempuan">Perempuan</option>
		</select><br/>
		TEMPAT LAHIR <input type="text" name="tempat_lahir" value="{{ $a->anggota_tempat_lahir }}"> <br/>
		TANGGAL LAHIR <input type="date" name="tanggal_lahir" value="{{ $a->anggota_tanggal_lahir }}"> <br/>
		ALAMAT KTP <input type="text" name="alamat_ktp" value="{{ $a->anggota_alamat_ktp }}"> <br/>
		ALAMAT SEKARANG <input type="text" name="alamat_sekarang" value="{{ $a->anggota_alamat_sekarang }}"> <br/>
		KONTAK <input type="number" name="kontak" value="{{ $a->anggota_kontak }}"> <br/>
		PEKERJAAN <input type="text" name="pekerjaan" value="{{ $a->anggota_pekerjaan }}"> <br/>
		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
		

</body>
</html>