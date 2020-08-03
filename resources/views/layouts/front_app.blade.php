
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

<link rel="shortcut icon" href="{{url('/')}}/gambar/koperasi.jpeg" type="image/x-icon">
<link rel="icon" href="{{url('/')}}/gambar/koperasi.jpeg" type="image/x-icon">
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
{{-- <script>
    function startRefresh() {
        $.get('', function(data) {
            $(document.body).html(data);    
        });
    }
    $(function() {
        setTimeout(startRefresh,12000);
    });
</script> --}}
</body>
</html>