
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Koperasi</title>
<!-- Stylesheets -->
<link href="{{asset('a_front/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('a_front/plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
<link href="{{asset('a_front/plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
<link href="{{asset('a_front/plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
<link href="{{asset('a_front/css/style.css')}}" rel="stylesheet">
<link href="{{asset('a_front/css/responsive.css')}}" rel="stylesheet">

<link rel="shortcut icon" href="{{url('/')}}/gambar/logo_koperasi.png" type="image/x-icon">
<link rel="icon" href="{{url('/')}}/gambar/logo_koperasi.png" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">
    @include('front.header')
    @yield('content')

    
</div> 

<!--Main Footer-->
<footer class="main-footer">
    <div class="auto-container">
    
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row clearfix">
                
                <!--Column-->
                <div class="column col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-widget links-widget">
                        <div class="footer-title">
                            <h2>Tautan Terkait</h2>
                        </div>
                        <div class="widget-content">
                            <div class="row clearfix">
                                <div class="widget-column col-md-6 col-sm-6 col-xs-12">
                                    <ul class="footer-list">
                                        <li><a href="#">Tentang</a></li>
                                        <li><a href="#">Layanan</a></li>
                                       
                                    </ul>
                                </div>
                                <div class="widget-column col-md-6 col-sm-6 col-xs-12">
                                    <ul class="footer-list">
                                        <li><a href="#">Testimonials</a></li>
                                        <li><a href="#">FAQ’s</a></li>
                                        <li><a href="#">Kontak Kami</a></li>
                                        <li><a href="#">Syarat & Ketentuan</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Column-->
                <div class="column col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-widget subscribe-widget">
                        <div class="footer-title">
                            <h2>Ikuti Kami</h2>
                        </div>
                        <div class="widget-content">
                            <div class="text">Jangan Ketinggalan<br> Berita Terbaru.</div>
                            <div class="subscribe-form">
                                <form method="post" action="">
                                    <div class="form-group">
                                        <input type="email" name="email" value="" placeholder="Email Address..." required="">
                                        <button type="submit" class="theme-btn"><span class="flaticon-right-arrow-1"></span></button>
                                    </div>
                                </form>
                            </div>
                            <ul class="social-icon-one">
                                <li><a href="#"><span class="fa fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                                <li><a href="#"><span class="fa fa-rss"></span></a></li>
                                <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                                <li><a href="#"><span class="fa fa-vimeo"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!--Column-->
                <div class="column col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-widget office-widget">
                        <div class="footer-title">
                            <h2>Kantor</h2>
                        </div>
                        <div class="widget-content">
                            <div class="single-item-carousel owl-carousel owl-theme">
                                
                                <div class="office-info">
                                    <ul>
                                        <li><strong>Alamat:</strong></li>
                                        <li>Jakarta, Fatmawati</li>
                                        <li><a href="#">Temukan Kami</a></li>
                                    </ul>
                                </div>
                                
                                <div class="office-info">
                                    <ul>
                                        <li><strong>Alamat:</strong></li>
                                        <li>Jakarta, Fatmawati</li>
                                        <li><a href="#">Temukan Kami</a></li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
    <!--Copyright-->
    <div class="copyright">Copyright &copy; {{date('Y')}} Mahasiswa . All rights reserved.</div>
</footer>

{{-- login modal --}}

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Login Sebagai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <a href="{{url('/')}}/login/anggota" class="btn btn-primary"><i class="fa fa-user" aria-hidden="true"></i> Login Anggota</a>
            <a href="{{url('/')}}/login/admin" class="btn btn-default"><i class="fa fa-desktop" aria-hidden="true"></i> Login Admin</a>
            {{-- <a href="{{url('/')}}/login/operator" class="btn btn-default"><i class="fa fa-microphone" aria-hidden="true"></i> Login Pengurus</a> --}}
        </div>
       
      </div>
    </div>
  </div>
{{-- end login --}}

<script src="{{url('/')}}/a_front/js/jquery.js"></script> 
<script src="{{url('/')}}/a_front/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="{{url('/')}}/a_front/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="{{url('/')}}/a_front/js/main-slider-script.js"></script>

<script src="{{url('/')}}/a_front/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/a_front/js/jquery.fancybox.pack.js"></script>
<script src="{{url('/')}}/a_front/js/jquery.fancybox-media.js"></script>
<script src="{{url('/')}}/a_front/js/owl.js"></script>
<script src="{{url('/')}}/a_front/js/wow.js"></script>
<script src="{{url('/')}}/a_front/js/knob.js"></script>
<script src="{{url('/')}}/a_front/js/appear.js"></script>
<script src="{{url('/')}}/a_front/js/script.js"></script>


{{-- modal tentang --}}
<div class="modal fade" id="tentang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tentang Koperasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p><b>Struktur</b> </p>
         <p>
           
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Sesuai ketentuan yang tertuang dalam Undang-Undang Nomor 25 tahun 1992, bahwa perangkat organisasi suatu koperasi terdiri dari RAT (Rapat anggota Tahunan), pengurus dan dewan pengawas (dalam hal ini pengawas umum dan pengawas syariah). Sedangkan unsur lain yang melengkapi organisasi koperasi adalah: unsur penasehat unsur pelaksana, manajer dan karyawan-karyawan koperasi
            
         </p>
         <p>Struktur organisasi KSPPS KIS dapat dilihat pada Gambar Dibawah ini:</p>
         <p>
         <img src="{{url('/')}}/gambar/struktur.png" style="height:400px;max-width:100%">
         </p>

         <p>
            Susunan pengurus pengawas dan pengelola berdasarkan RAT tahun buku 2018 yang diselenggarakan tanggal 12 Januari 2019 adalah sebagai berikut :
         </p>

         <p>
            I. PENGURUS
         </p>
         <div style="margin-left:30px">
            <p>Ketua	: Ir. H.Rachmat Lubis, MM</p>
            <p>Sekretaris	: Sholihati, S.P, M.Si</p>
             <p>Bendahara	: Nurjannah Lubis, SE</p>
        </div>

        <p>
            II.	PENGAWAS
         </p>
         <div style="margin-left:30px">
            <p>Ketua		: Dr. Hj. Yeti Lisa Purnama dewi </p>
            <p>Anggota I	: Ir. H Mahmulsyah Daulay</p>
             <p>Anggota II	: Ir. H. Ali Muda Siregar</p>
        </div>
        <p>
            III. DEWAN PENGAWAS SYARIAH
         </p>
         <div style="margin-left:30px">
            <p>Ketua	: H. Edi Candra LC. M.E.I </p>
            <p>Anggota	: Ir. H. Zulfi Ramlan Pohan, MM</p>
        </div>

        <p>
            IV.	PENGAWAS
         </p>
         <div style="margin-left:30px">
            <p>Ketua		: Ir. H Mahmulsyah Daulay</p>
            <p>Anggota I	: Ir. H.Rachmat Lubis,MM </p>
             <p>Anggota II	: Ir. H. Ali Muda Siregar</p>
        </div>
        <p>
            V.	DEWAN PENGAWAS SYARIAH
         </p>
         <div style="margin-left:30px">
            <p>Ketua	: H. Edi Candra LC. M.E.I</p>
            <p>Anggota	: Ir. H. Zulfi Ramlan Pohan, MM</p>
        </div>





        </div>
       
      </div>
    </div>
  </div>


{{-- end modal tentang --}}

{{-- modal lokasi --}}

<div class="modal fade" id="lokasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Lokasi Koperasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><b>Kantor Pusat</b> </p>
          <p>Jl.Raya Dramaga, Perumahan Ziara Valley,Cluster Kencana Blok I No.1 Margajaya Kota Bogor</p>
        </div>
        
      </div>
    </div>
  </div>
{{-- end modal lokasi --}}

{{-- modal simpanan --}}
<div class="modal fade" id="simpanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Jenis Simpanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p style="font-size:16px"><b>Simpanan Umroh,</b> </p>
          <p>
            Adalah simpanan yang di prioritaskan untuk anggota atau nasabah untuk keperluan ibadah haji dan umroh dengan menggunakan akad dan ketentuan yang sesuai syariah islam.
          </p>
          <p>
          <img src="{{url('/')}}/gambar/umroh.png">
          </p>
          <br>
          <p style="font-size:16px"><b>Simpanan Pendidikan,</b> </p>
          
          <p>
            <img src="{{url('/')}}/gambar/pendidikan.png">
          </p>
          <br>
          <p style="font-size:16px"><b>Simpanan Berjangka,</b> </p>
          <p>
             <b>Simpanan </b> pada <b>koperasi</b> yang penyetorannya dilakukan satu kali untuk jangka waktu tertentu sesuai dengan perjanjian antara penyimpan dengan koperasi yang bersangkutan dan tidak boleh diambil sebelum jangka waktu tersebut berakhir
          </p>
           
          <p>
            <img src="{{url('/')}}/gambar/deposit.png">
          </p>

          <br>
          <p style="font-size:16px"><b>Simpanan Sukarela,</b> </p>
          <p>
              Dalam Upaya membudayakan Simpanan Sukarela bagi anggota, ditetapkan sebuah program yang diberi nama <b>Gema Seri</b> (Gerakan Menyimpan Seribu Sehari). Nilai bagi hasil sebagai jasa <b>wadiah yat dhamamah</b> (setara 6% pertahun)
          </p>
        </div>
        
      </div>
    </div>
  </div>

{{-- end modal simpanan --}}

{{-- modal pembiayaan --}}
<div class="modal fade" id="pinjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Pembiayaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>
                <img src="{{url('/')}}/gambar/pinjaman.png">
              </p>
        </div>
      
      </div>
    </div>
  </div>
{{-- end modal pembiayaan --}}

{{-- modal anggota --}}
<div class="modal fade" id="anggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Alur Keanggotan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>1.	Mengisi formulir pendaftaran</p>
          <p>2.	Mengikuti pendidikan perkoperasian</p>
          <p>3.	Menyerahkan fotocopy KTP</p>
          <p>4.	Memiliki usaha produktif dan ketentuan lainnya</p>
          <p>5.	Membayar simpanan pokok sebesar 20.000 *</p>
          <p>6.	Membayar simpanan wajib perdana sebesar 5000, dan simpanan wajib selanjutnya sesuai dengan ketentuan yang berlaku atau berdasarkan nilai pinjaman/pembiayaan yang diterima **</p>
          <p>7.	Menabung sukarela perdana Min Rp. 5000 dan membeli buku simpanan seharga 5000</p>
          <p>8.	Taat dan patuh terhadap aturan – aturan yang berlaku pada KSPPS KIS</p>
          <p><b>
            *Simpanan pokok dapat ditarik kembali jika berhenti jadi anggota  
            </b></p>
            <p><b>
                ** Simpanan wajib dapat ditarik kembali jika berhenti jadi anggota
                </b></p>
        </div>
      
      </div>
    </div>
  </div>

{{-- end modal anggota --}}

</body>
</html>