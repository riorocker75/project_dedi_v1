<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>

	<h3>Data Anggota</h3>

	<a href="/anggota"> Kembali</a>
	<br/>
	<br/>
	<form action="/anggota/anggota_act" method="post">
		{{ csrf_field() }}
		NIK <input type="text" name="nik" required="required"> <br/>
		NAMA <input type="text" name="nama" required="required"> <br/>
		KELAMIN 
		<select name="kelamin" required="required">
			<option value="">--Pilih--</option>
			<option value="Laki - Laki">Laki - Laki</option>
			<option value="Perempuan">Perempuan</option>
		</select><br/>
		TEMPAT LAHIR <input type="text" name="tempat_lahir" required="required"> <br/>
		TANGGAL LAHIR <input type="date" name="tanggal_lahir" required="required"> <br/>
		ALAMAT KTP <input type="text" name="alamat_ktp" required="required"> <br/>
		ALAMAT SEKARANG <input type="text" name="alamat_sekarang" required="required"> <br/>
		KONTAK <input type="number" name="kontak" required="required"> <br/>
		PEKERJAAN <input type="text" name="pekerjaan" required="required"> <br/>
		<input type="submit" value="Simpan Data">
	</form>

</body>
</html>