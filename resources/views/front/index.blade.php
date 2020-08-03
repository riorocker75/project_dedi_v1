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
                        <div class="text">Explain to you how all this onemistaken idea of denouncing pleasure...</div>
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
                        <div class="text">Explain to you how all this onemistaken idea of denouncing pleasure...</div>
                        <a href="" class="read-more"><span class="icon flaticon-right-arrow-1"></span> Selengkapnya</a>
                    </div>
                </div>
                
                <!--Services Block-->
         
                
                
            </div>
            
        </div>
    </section>
    <!--End Services Section-->
@endsection