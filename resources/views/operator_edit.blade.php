<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI SIMPAN PINJAM KOPERASI</title>
</head>
<body>

	<h3>Edit operator</h3>
	<a href="/operator"> Kembali</a>
	
	<br/>
	<br/>

	@foreach($operator as $o)
	<form action="/operator/operator_update" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $o->operator_id }}"> <br/>
		NOMOR PEGAWAI <input type="text" name="nomor_pegawai" value="{{ $o->operator_nomor_pegawai }}"> <br/>
		NAMA <input type="text" name="nama" value="{{ $o->operator_nama }}"> <br/>
		KELAMIN 
		<select name="kelamin" required="required">
			<option value="">--Pilih--</option>
			<option value="Laki - Laki">Laki - Laki</option>
			<option value="Perempuan">Perempuan</option>
		</select><br/>
		TEMPAT LAHIR <input type="text" name="tempat_lahir" value="{{ $o->operator_tempat_lahir }}"> <br/>
		TANGGAL LAHIR <input type="date" name="tanggal_lahir" value="{{ $o->operator_tanggal_lahir }}"> <br/>
		ALAMAT <input type="text" name="alamat" value="{{ $o->operator_alamat }}"> <br/>
		KONTAK <input type="number" name="kontak" value="{{ $o->operator_kontak }}"> <br/>
		USERNAME <input type="text" name="username" value="{{$o->operator_username}}" required="required"> <br/>
		<!-- PASSWORD <input type="password" name="password" required="required"> 
		<p style="color: red">* Input Jika akan diganti</p>	 -->	
		<br/>
		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
		

</body>
</html>