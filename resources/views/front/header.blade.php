
   <!-- Main Header-->
   <header class="main-header header-style-one">
    
    <!-- Header Top -->
    <div class="header-top">
        <div class="auto-container">
            <div class="top-outer clearfix">
                
                <!--Top Left-->
                <div class="top-left">
                    <ul class="links clearfix">
                        <!--Language-->
                      
                        <li><a href="#"><span class="icon fa fa-phone"></span>Kontak: <strong>+085232662</strong> </a></li>
                    </ul>
                </div>
                
                <!--Top Right-->
                <div class="top-right clearfix">
                    <ul class="clearfix">
                        <li>
                            {{-- <a data-toggle="modal" data-target="#login"><span class="icon flaticon-user"></span>Login</a>  --}}
                        <a href="{{url('/login/user')}}"><span class="icon flaticon-user"></span>Login</a>
                            <span>or</span> <a href="{{url('/')}}/daftar/anggota"><span class="icon flaticon-upload"></span>Daftar</a></li>
                        <!--Search Box-->
                        <li class="search-box-outer">
                            <div class="dropdown">
                                <button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
                                <ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu3">
                                    <li class="panel-outer">
                                        <div class="form-container">
                                            <form method="post" action="blog.html">
                                                <div class="form-group">
                                                    <input type="search" name="field-name" value="" placeholder="Search Here" required>
                                                    <button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>                        
                </div>
                
            </div>
            
        </div>
    </div>
    <!-- Header Top End -->
    
    <!-- Main Box -->
    <div class="main-box">
        <div class="auto-container">
            <div class="outer-container clearfix">
                <!--Logo Box-->
                <div class="logo-box">
                </div>
                
                <!--Nav Outer-->
                <div class="nav-outer clearfix">
                
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <!-- Toggle Button -->    	
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="{{url('/')}}">Home</a></li>
                                <li class="dropdown"><a href="#">Layanan</a>
                                    <ul>
                                        <li><a  data-toggle="modal" data-target="#pinjaman">Pembiayaan</a></li>
                                        <li><a  data-toggle="modal" data-target="#simpanan">Simpanan</a></li>
                                        <li><a  data-toggle="modal" data-target="#anggota">Anggota</a></li>

                                      
                                    </ul>
                                </li>
                                <li class="dropdown"><a data-toggle="modal" data-target="#tentang">Tentang</a></li>

                                <li class="dropdown"><a data-toggle="modal" data-target="#lokasi">Lokasi</a></li>
                             </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->
                    
                    <!--Outer Box-->
                    <div class="outer-box">
                        <a href="" class="theme-btn btn-style-one"> <span class="icon flaticon-right-arrow-1"></span> Lebih Dekat</a>
                    </div>
                    
                </div>
                <!--Nav Outer End-->
                
            </div>    
        </div>
    </div>

    
</header>
<!--End Main Header -->  

<!--Main Slider-->
<section class="main-slider">
    	
    <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_one_wrapper" data-source="gallery">
        <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
            <ul>
            
                <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1688" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="{{url('/')}}/a_front/images/main-slider/image-1.jpg" data-title="Slide Title" data-transition="parallaxvertical">
                <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="{{url('/')}}/a_front/images/main-slider/image-1.jpg"> 
                
                
                <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme"
                data-paddingbottom="[0,0,0,0]"
                data-paddingleft="[0,0,0,0]"
                data-paddingright="[0,0,0,0]"
                data-paddingtop="[0,0,0,0]"
                data-responsive_offset="on"
                data-type="shape"
                data-height="auto"
                data-whitespace="nowrap"
                data-width="none"
                data-hoffset="['15','15','15','15']"
                data-voffset="['20','15','15','15']"
                data-x="['right','right','right','right']"
                data-y="['middle','middle','middle','middle']"
                data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                <figure class="content-image"><img src="{{url('/')}}/gambar/gambar_1.jpg" style="width:100px!important;height:100px!important;"></figure>
                 
                {{-- <figure class="content-image"><img src="{{url('/')}}/a_front/images/main-slider/content-image-1.png" alt=""></figure> --}}
                </div>
                
                </li>

                <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1689" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="{{url('/')}}/a_front/images/main-slider/image-1.jpg" data-title="Slide Title" data-transition="parallaxvertical">
                    <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="{{url('/')}}/a_front/images/main-slider/image-1.jpg"> 
                  
                    
                    <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme"
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingtop="[0,0,0,0]"
                    data-responsive_offset="on"
                    data-type="shape"
                    data-height="auto"
                    data-whitespace="nowrap"
                    data-width="none"
                    data-hoffset="['15','15','15','15']"
                    data-voffset="['20','0','0','0']"
                    data-x="['left','left','left','left']"
                    data-y="['middle','middle','middle','middle']"
                    data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                         <figure class="content-image"><img src="{{url('/')}}/gambar/gambar_2.jpeg" style="width:100px!important;height:100px!important;"></figure>
                    
                    </div>
                    
                    </li>

                    <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1690" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="{{url('/')}}/a_front/images/main-slider/image-1.jpg" data-title="Slide Title" data-transition="parallaxvertical">
                        <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="{{url('/')}}/a_front/images/main-slider/image-1.jpg"> 
                      
                        
                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="auto"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['15','15','15','15']"
                        data-voffset="['20','0','0','0']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                             <figure class="content-image"><img src="{{url('/')}}/gambar/gambar_4.jpeg" style="width:100px!important;height:100px!important;"></figure>
                        
                        </div>
                        
                        </li>

                        
                    <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1691" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="{{url('/')}}/a_front/images/main-slider/image-1.jpg" data-title="Slide Title" data-transition="parallaxvertical">
                        <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="{{url('/')}}/a_front/images/main-slider/image-1.jpg"> 
                      
                        
                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="auto"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['15','15','15','15']"
                        data-voffset="['20','0','0','0']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                             <figure class="content-image"><img src="{{url('/')}}/gambar/gambar_3.jpeg" style="width:100px!important;height:100px!important;"></figure>
                        
                        </div>
                        
                        </li>

                
            </ul>
        </div>
    </div>
</section>
<!--End Main Slider-->

<!--Featured Section-->
<section class="featured-section">
    <div class="auto-container">
        <div class="inner-container clearfix">
            
            <!--Featured Block-->
            <div class="featured-block col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    
                    <div class="lower-box">
                        <div class="lower-inner">
                            <div class="icon-box">
                                <span class="icon"><img src="{{url('/')}}/a_front/images/icons/featured-icon-1.png" alt="" /></span>
                            </div>
                            <h3><a href="">Bunga terendah</a></h3>
                            <div class="title">Besar, Menegah</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Featured Block-->
            <div class="featured-block col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                   
                    <div class="lower-box">
                        <div class="lower-inner">
                            <div class="icon-box">
                                <span class="icon"><img src="{{url('/')}}/a_front/images/icons/featured-icon-2.png" alt="" /></span>
                            </div>
                            <h3><a href="">Simpanan Terbaik</a></h3>
                            <div class="title">Kecil, Menengah</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Featured Block-->
            <div class="featured-block col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    {{-- <div class="upper-box">
                        <div class="text">Explain to you how all this mistaken idea of denouncing pleasure and praising pain was  complete account system. </div>
                        <a class="read-more" href=""><span class="icon flaticon-right-arrow-1"></span> Selengkapnya</a>
                    </div> --}}
                    <div class="lower-box">
                        <div class="lower-inner">
                            <div class="icon-box">
                                <span class="icon"><img src="{{url('/')}}/a_front/images/icons/featured-icon-3.png" alt="" /></span>
                            </div>
                            <h3><a href="">Keuntungan Berlipat</a></h3>
                            <div class="title">Mulai sekarang</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Featured Section-->




