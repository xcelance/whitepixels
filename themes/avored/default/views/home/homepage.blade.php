@extends('layouts.app_new')
@section('meta_title',"Home")

@section('content')       
        
        <div class="banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>

                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item one active">
                        <div class="container">
                            <div class="banner-content">
                                <h2>BUSINESS CARDS</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a href="{{url('category/business-cards')}}" class="order-btn ct-btn">order now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item two">
                        <div class="container">
                            <div class="banner-content">
                                <h2>LETTERHEADS</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a href="{{url('category/greeting-cards')}}" class="order-btn ct-btn">order now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item three">
                        <div class="container">
                            <div class="new-product-content">
                                <!-- <h2 class="new-product">New Products</h2> -->
                                <div class="new-product-box">
                                    
                                   <a href="#"><img src="{{url('public/vendor/avored-default/images/product-850x2000.png')}}"></a>
                                    <a href="#"><img src="{{url('public/vendor/avored-default/images/product-1000x2000.png')}}"></a>
                                   <a href="#"><img src="{{url('public/vendor/avored-default/images/product-1200x2000.png')}}"></a>
                                   <a href="#"><img src="{{url('public/vendor/avored-default/images/product-1500x2000.png')}}"></a>                                                                                                         

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item four">
                        <div class="container">
                            <div class="banner-content">
                                <h2>LEAFLETS</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <a href="{{url('category/flyers')}}" class="order-btn ct-btn">order now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item five">
                        <div class="container">
                        </div>
                    </div>                                        
                </div>
            </div>
        </div>
        
        
        <section class="design-sec">
            <div class="container">
                <!--<div class="design-heading">
                    <h2>Design</h2>
                </div>-->
                <div class="design-list-block">
                    <ul class="clearfix">
                        <li>
                            <a href="{{url('products')}}">
                                <div class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/browse-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/browse-icon-1.png')}}" class="hover-img">
                                    </div>
                                </div>
                                <h4>Browse Our Products</h4>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{url('request_quote')}}">
                                <span class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/request-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/request-icon-1.png')}}" class="hover-img">
                                    </div>
                                </span>
                                <h4>Request A Quote</h4>
                            </a>
                        </li>
                        
                        
                       <!--  <li>
                            <a href="#">
                                <span class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/price-tag-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/price-tag-icon-1.png')}}" class="hover-img">
                                    </div>
                                </span>
                                <h4>Estimate  Job Price</h4>
                            </a>
                        </li> -->
                        
                        
                        <li>
                            <a href="{{url('cutting-forme')}}">
                                <span class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/cutting-formes-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/cutting-formes-icon-1.png')}}" class="hover-img">
                                    </div>
                                </span>
                                <h4>View Cutting Formes</h4>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{url('artwork-guide')}}">
                                <span class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/artwork-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/artwork-icon-1.png')}}" class="hover-img">
                                    </div>
                                </span>
                                <h4>View Artwork  Guide</h4>
                            </a>
                        </li>
 
                        <li>
                            <a href="{{url('uploadartwork')}}">
                                <span class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/upload-art-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/upload-art-icon-1.png')}}" class="hover-img">
                                    </div>
                                </span>
                                <h4>Upload Your  Artwork</h4>
                            </a>
                        </li>
                        
                       <!--  <li>
                            <a href="#">
                                <span class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/re-order-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/re-order-icon-1.png')}}" class="hover-img">
                                    </div>
                                </span>
                                <h4>Quick Re- Order</h4>
                            </a>
                        </li> -->
                        
                        
                        <!-- <li>
                            <a href="#">
                                <span class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/payment-card-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/payment-card-icon-1.png')}}" class="hover-img">
                                    </div>
                                </span>
                                <h4>Make Top-up  Payment</h4>
                            </a>
                        </li> -->
                        
                        
                        <!-- <li>
                            <a href="#">
                                <span class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/truck-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/truck-icon-1.png')}}" class="hover-img">
                                    </div>
                                </span>
                                <h4>Track Your Job/Order</h4>
                            </a>
                        </li> -->
                        
                        <!-- <li class="become_icon">
                            <a href="#">
                                <span class="design-icon">
                                    <div class="table-inner">
                                        <img src="{{url('public/vendor/avored-default/images/partner-icon.png')}}">
                                        <img src="{{url('public/vendor/avored-default/images/partner-icon-1.png')}}" class="hover-img">
                                    </div>
                                </span>
                                <h4>Become A Partner</h4>
                            </a>
                        </li> -->
                        
                    </ul>
                </div>
            </div>
        </section>
        
        <section class="printers-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="printers-content">
                            <h4>LEADING UK & IRELAND TRADE PRINTERS</h4>
                            <p>We pride ourselves in being the best trade printers in the UK & Ireland We gain a competitive edge, by ensuring we keep to our high standards of offering great turn around times at  unbeatable prices.If you find yourself looking for a trade printing  partner to help grow your business in Ireland and the UK then  look no further.We have the required experience and expertise  to offer you a high quality trade printing service.</p>
                            
                            <ul class="clearfix printers-icon-list">
                                <li>
                                    <span class="printers-icon delivery-icon"> </span>
                                    <h6>Free Delivery</h6>
                                </li>
                                <li>
                                    <span class="printers-icon printing-icon"></span>
                                    <h6>Complete Printing Services</h6>
                                </li>
                                <li>
                                    <span class="printers-icon processing-icon"> </span>
                                    <h6>Fast Order Processing</h6>
                                </li>
                                <li>
                                    <span class="printers-icon pricingtag-icon"> </span>
                                    <h6>Competitive  Pricing</h6>
                                </li>
                                <li>
                                    <span class="printers-icon white-label-icon"> </span>
                                    <h6>White Label Shipping</h6>
                                </li>    
                                
                            </ul>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="printers-img">
                            <img src="{{url('public/vendor/avored-default/images/printers-img.jpg')}}">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="popular-sec">
            <div class="container">
                <div class="popular-heading">
                    <h2>Popular right now</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="popular-block">
                            <a href="{{url('category/flyers')}}"><img src="{{url('public/vendor/avored-default/images/popular-img-1.jpg')}}"></a>
                            <div class="popular-content">
                                <h4>FLYERS</h4>
                            </div>
                            <div class="price-tag">
                                <h4>From <span class="price-number">£26</span></h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="popular-block">
                                    <a href="{{url('category/leaflets')}}"><img src="{{url('public/vendor/avored-default/images/popular-img-2.jpg')}}"></a>
                                    <div class="popular-content">
                                        <h4>LEAFLETS</h4>
                                    </div>
                                    <div class="price-tag price-tag-2">
                                        <h4>From <span class="price-number">£28</span></h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="popular-block mt-3">
                                    <a href="{{url('category/business-cards')}}"><img src="{{url('public/vendor/avored-default/images/popular-img-3.jpg')}}"></a>
                                    <div class="popular-content">
                                        <h4>Business cards</h4>
                                    </div>
                                    
                                    <div class="price-tag price-tag-3">
                                        <h4>From <span class="price-number">£28</span></h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="popular-block mt-3">
                                    <a href="{{url('category/letterheads')}}"><img src="{{url('public/vendor/avored-default/images/popular-img-4.jpg')}}"></a>
                                    <div class="popular-content">
                                        <h4>Letter heads</h4>
                                    </div>
                                    <div class="price-tag price-tag-3">
                                        <h4>From <span class="price-number">£24</span></h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                
                <div class="view-btn">
                    <a href="{{url('products')}}" class="ct-btn">view all</a>
                </div>
            </div>
        </section>
        
        <section class="request-sec">
            <div class="container">
                <div class="request-content">
                    <h2>FREE SAMPLE PACK REQUEST</h2>
                    <p>We produce a complimentary sample pack that is available on request. The pack includes a  range of products and paper stock that illustrate the  quality of our colour and printing capabilities. </p>
                    <a href="{{url('samplepacks')}}" class="request-btn ct-btn">Request a sample pack</a>
                </div>
            </div>
        </section>
        
        <section class="testimonials-sec">
            <div class="container">
                <div class="popular-heading">
                    <h2>Testimonials</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                
                
                <div id="carouselExampleIndicator" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicator" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicator" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicator" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicator" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicator" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="testimonials-block">
                                    <div class="client-img">
                                        <img src="{{ url('public/vendor/avored-default/images/client-img.png')}}">
                                    </div>
                                    <div class="testimonials-content">
                                        <h4>John Doe</h4>
                                        <h6>Lorem ipsum dolor</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis eget justo id tincidunt. Nulla facilisi.Donec eget nisi elit. Vivamus molestie pharetra sapien at euismod.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="testimonials-block">
                                    <div class="client-img">
                                        <img src="{{url('public/vendor/avored-default/images/client-img.png')}}">
                                    </div>
                                    <div class="testimonials-content">
                                        <h4>John Doe</h4>
                                        <h6>Lorem ipsum dolor</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis eget justo id tincidunt. Nulla facilisi.Donec eget nisi elit. Vivamus molestie pharetra sapien at euismod.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="testimonials-block">
                                    <div class="client-img">
                                        <img src="{{url('public/vendor/avored-default/images/client-img.png')}}">
                                    </div>
                                    <div class="testimonials-content">
                                        <h4>John Doe</h4>
                                        <h6>Lorem ipsum dolor</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis eget justo id tincidunt. Nulla facilisi.Donec eget nisi elit. Vivamus molestie pharetra sapien at euismod.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="testimonials-block">
                                    <div class="client-img">
                                        <img src="{{url('public/vendor/avored-default/images/client-img.png')}}">
                                    </div>
                                    <div class="testimonials-content">
                                        <h4>John Doe</h4>
                                        <h6>Lorem ipsum dolor</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis eget justo id tincidunt. Nulla facilisi.Donec eget nisi elit. Vivamus molestie pharetra sapien at euismod.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="testimonials-block">
                                    <div class="client-img">
                                        <img src="{{url('public/vendor/avored-default/images/client-img.png')}}">
                                    </div>
                                    <div class="testimonials-content">
                                        <h4>John Doe</h4>
                                        <h6>Lorem ipsum dolor</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis eget justo id tincidunt. Nulla facilisi.Donec eget nisi elit. Vivamus molestie pharetra sapien at euismod.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
@endsection   
        
       





