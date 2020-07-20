<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>

	<h3>Data Anggota</h3>
	<a href="/operator"> Kembali</a>
	<br/>
	<br/>
	<form action="/operator/operator_act" method="post">
		{{ csrf_field() }}
		NOMOR PEGAWAI <input type="text" name="nomor_pegawai" required="required"> <br/>
		NAMA <input type="text" name="nama" required="required"> <br/>
		KELAMIN 
		<select name="kelamin" required="required">
			<option value="">--Pilih--</option>
			<option value="Laki - Laki">Laki - Laki</option>
			<option value="Perempuan">Perempuan</option>
		</select><br/>
		TEMPAT LAHIR <input type="text" name="tempat_lahir" required="required"> <br/>
		TANGGAL LAHIR <input type="date" name="tanggal_lahir" required="required"> <br/>		
		ALAMAT <input type="text" name="alamat" required="required"> <br/>
		KONTAK <input type="number" name="kontak" required="required"> <br/>
		USERNAME <input type="text" name="username" required="required"> <br/>
		PASSWORD <input type="password" name="password" required="required"> <br/>
		<input type="submit" value="Simpan Data">
	</form>

</body>
</html>