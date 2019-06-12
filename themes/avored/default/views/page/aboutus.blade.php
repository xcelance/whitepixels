@extends('layouts.app_new')

@section('meta_title')
    {{ $page->title }}
@endsection

@section('slider')
<div class="aboutus-banner inner-banner">
    <div class="container">
        <div class="banner-heading">
            <h2>About Us</h2>
        </div>
    </div>
</div>
@endsection
@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('aboutus') }}
        </nav>
    </div>
</div>
@endsection

@section('content')
	<section class="become-partner-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="become-partner-content about-content">
                            <h4>WHITE PIXELS</h4>
                            <p>We strive to offer you a consistently superior service throughout your experience with us. We achieve this by combining qualityprinting practices, informative customer interactions, and excellent turnaround time at extremely competitive prices.Our ethos is defined by the commitment shown to outperform our client's  expectations.</p>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                        <div class="become-partner-img">
                           <img src="{{url('public/vendor/avored-default/images/about-img.jpg')}}">                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-content-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-md-5">
                        <div class="about-content-box">
                            <div class="about-icon">                                
                                <!--<img src="{{url('public/vendor/avored-default/images/about-icon-1.png')}}">-->
                                <i class="about-timeglass-icon"></i>
                            </div>
                            <div class="about-text">
                                <h4>OUTSTANDING TURNAROUND TIME</h4>
                                <p>We operate the factory 24 hours a day, delivering quick turnaround times to our customer base. Standard lead-time is 5 days, but we are committed to assisting all of your printing needs and will do everything we can to accommodate a tight deadline</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-md-5">
                        <div class="about-content-box">
                            <div class="about-icon">
                                <!--<img src="{{url('public/vendor/avored-default/images/about-icon-2.png')}}">-->
                                <i class="about-printer-icon"></i>
                            </div>
                            <div class="about-text">
                                <h4>EXCELLENT FULL COLOUR PRINTING</h4>
                                <p>Our 5-colour capability with in-line coating, allows us to offer our clients the results they want at a price that can't be beat. Paper weight selection indicates minimum weight, heavier paper may be substituted for operational purposes.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="about-content-box">
                            <div class="about-icon">
                                <!--<img src="{{url('public/vendor/avored-default/images/about-icon-3.png')}}">-->
                                <i class="about-finishing-icon"></i>
                            </div>
                            <div class="about-text">
                                <h4>HIGH QUALITY PRINT FINISHING</h4>
                                <p>Our bindery department finishes the job with in-house cutting, creasing, folding, saddle stitching and laminating capabilities. Through our technical know-how and practical experience we are able to provide you with the highest quality finishing that your job deserves.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="about-content-box">
                            <div class="about-icon">
                                <!--<img src="{{url('public/vendor/avored-default/images/about-icon-4.png')}}">-->
                                <i class="about-price-icon"></i>
                            </div>
                            <div class="about-text">
                                <h4>INDUSTRY COMPETITVE PRICING</h4>
                                <p>Our quote prices include the cost of proofing, printing, finishing and delivering of your job to anywhere in Ireland and U.K. There are no hidden extras.</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>  
      
@endsection


