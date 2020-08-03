@extends('layouts.front_app')
@section('content')
<!--Services Section-->
    <section class="services-section">
    	<div class="auto-container">
        	<!--Sec Title-->
            <div class="sec-title centered">
            	<h2>Layanan Kami</h2>
                <div class="text">Kami memberikan pelayanan terbaik dalam hal Simpan, Pinjam dan memiliki banyak anggota bergabung</div>
            </div>
            
            <div class="three-item-carousel owl-carousel owl-theme">
            	
                <!--Services Block-->
                <div class="services-block">
                	<div class="inner-box">
                    	<div class="icon-box">
                        	<span class="icon"><img src="{{url('/')}}/a_front/images/icons/services-1.png" alt="" /></span>
                        </div>
                        <h3><a href="">Simpanan</a></h3>
                        <div class="text">Kami memberikan layanan simpanan terbaik </div>
                        <a href="" class="read-more"><span class="icon flaticon-right-arrow-1"></span> Selengkapnya</a>
                    </div>
                </div>
                
                <!--Services Block-->
                <div class="services-block">
                	<div class="inner-box">
                    	<div class="icon-box">
                        	<span class="icon"><img src="{{url('/')}}/a_front/images/icons/services-2.png" alt="" /></span>
                        </div>
                        <h3><a href="">Pinjaman</a></h3>
                        <div class="text">Pinjaman kami memilki skema yang menraik untuk di jalani.</div>
                        <a href="" class="read-more"><span class="icon flaticon-right-arrow-1"></span> Selengkapnya</a>
                    </div>
                </div>
                
                <!--Services Block-->
         
                
                
            </div>
            
        </div>
    </section>
    <!--End Services Section-->

    <section class="services-section">
    	<div class="auto-container">
        	<!--Sec Title-->
            <div class="sec-title centered">
            	<h2>Visi, Misi & TUJUAN</h2>
                <div class="text"></div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                   <h2 class=" text-center">VISI</h2>
                   <p>Menjadi Koperasi Syariah terbaik yang menebar kebajikan dan mampu mensejahtrakan masyarakat</p>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                   
                        <h2 class="text-center">MISI</h2>
                   <p>1.  Menjadi Koperasi Syariah yang terpercaya dalam menjalankan kegiatan usaha Simpan Pinjam dan Pembiayaan Syariah</p>
                    <p>2.  Memberikan layanan yang nyaman dan Bersahabat serta mampu memberikan nilai tambah bagi anggota dan masyarakat Umum</p>
                    </div>
                    <br>
                
                    <div class="col-lg-6  col-md-12 col-12">
                       
                            <h2 class="text-center">Tujuan</h2>
                         
                            <p>Mengelola kegiatan simpan pinjam dan pembiayaan secara profesional yang berlandaskan prinsip-prinsip syariah untuk meningkatkan pendapatan anggotanya dan secara berkelanjutan dan meningkatkan daya saing usaha.</p>

                    </div>
            </div>
    </section>
@endsection