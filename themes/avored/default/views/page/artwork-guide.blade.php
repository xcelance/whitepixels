@extends('layouts.app_new')

@section('slider')
<div class="artwork-banner inner-banner">
            <div class="container">
                <div class="banner-heading">
                    <h2>ARTWORK GUIDE</h2>
                </div>
            </div>
        </div>
@endsection
@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('artwork-guide') }}
        </nav>
    </div>
</div>
@endsection

@section('content')	  
        
        <section class="artwork-guide-sec">
            <div class="container">
                <div class="popular-heading">
                    <h2>ARTWORK GUIDE</h2>
                    <p>The following guide is to help ensure the artwork you upload doesn't cause a delay in processing your order. If you have  any queries, please don't hesitate to call us, email us, or even use our online chat if available!  Our FAQ page includes some helpful info on common questions.</p>
                </div>
                
                <div class="artwork-guide-block">
                    <div class="artwork-guide-box">
                        <div class="artwork-guide-icon">
                            <img src="{{url('/public/vendor/avored-default')}}/images/art-icon-1.png">
                        </div>
                        <div class="artwork-guide-content">
                            <h4>FILE SIZE AND FORMAT</h4>
                            <ul class="">
                                <li>To ensure best results, please send files in PDF format.</li>
                                <li>Unnecessarily large files will cause a slow down in the processing of your files. An image for an A4+3mmbleed at 300dpi is absolutely NO larger than 40MB. View our FAQ page for help in reducing image file size</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="artwork-guide-box">
                        <div class="artwork-guide-icon">
                            <img src="{{url('/public/vendor/avored-default')}}/images/art-icon-2.png">
                        </div>
                        <div class="artwork-guide-content">
                            <h4>COLOUR MODE</h4>
                            <ul class="">
                                <li>All artwork supplied must be based in CMYK unless a spot/pantone colour is also specified.</li>
                                <li>If you supply files that are RGB or unspecified spot/pantone colours, they will be automatically converted to CMYK, which can slightly change colours as they may appear different from what is seen on screen.</li>
                                <li>We are well equipped to run five-colour work if required.</li>
                                <li>It is essential that black text is generated using only the black plate.</li>
                                
                            </ul>
                        </div>
                    </div>
                    
                    <div class="artwork-guide-box">
                        <div class="artwork-guide-icon">
                            <img src="{{url('/public/vendor/avored-default')}}/images/art-icon-3.png">
                        </div>
                        <div class="artwork-guide-content">
                            <h4>COLOUR REPRODUCTION / PROOF CHECK</h4>
                            <ul class="">
                                <li>We will provide you with a colour proof copy on request, but this is not an exact colour match.</li>
                                <li>A 'spot' colour service is provided at an additional cost to check if the colour is correct.</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="artwork-guide-box">
                        <div class="artwork-guide-icon">
                            <img src="{{url('/public/vendor/avored-default')}}/images/art-icon-4.png">
                        </div>
                        <div class="artwork-guide-content">
                            <h4>IMAGE RESOLUTION</h4>
                            <ul class="">
                                <li>All images should be 300 dpi, but a minimum of 200 dpi is stipulated. Any lower resolution will result in a blocky image.</li>
                                <li>Print materials such as business cards, brochures and flyers require a minimum of 300 dpi.</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="artwork-guide-box">
                        <div class="artwork-guide-icon">
                            <img src="{{url('/public/vendor/avored-default')}}/images/art-icon-5.png">
                        </div>
                        <div class="artwork-guide-content">
                            <h4>PAGE SIZE AND BLEED</h4>
                            <ul class="">
                                <li>Ensure your artwork is on the correct page size and that there is 3mm bleed around the finished artwork.</li>
                                <li>Bleed is required to allow for the tolerance of guillotines used in the finishing/cutting of the job and to eliminate any margin of error.</li>
                                <li>A 4mm clearance is suggested from trim size for important elements – text imagery etc. (Example: A4 page:216x303mm trim: 210x297mm) Downloads of sizes and margins are available.
                                    <a href="#"><i class="download-icon"></i>Standard page sizes</a>
                                    <a href="#"><i class="download-icon"></i>Bleed & Margins</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="artwork-guide-box">
                        <div class="artwork-guide-icon">
                            <img src="{{url('/public/vendor/avored-default')}}/images/art-icon-6.png">
                        </div>
                        <div class="artwork-guide-content">
                            <h4>FONTS</h4>
                            <ul class="">
                                <li>Please make sure all fonts used in the artwork are embedded while producing your PDF.</li>
                                <li>For unusual fonts, we recommend converting the text created with this font into curves, paths or outlines – dependent upon the software package being used. This prevents us requesting the original font when we print your job, and improves processing times.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="artwork-guide-box">
                        <div class="artwork-guide-icon">
                            <img src="{{url('/public/vendor/avored-default')}}/images/art-icon-7.png">
                        </div>
                        <div class="artwork-guide-content">
                            <h4>ORIENTATION</h4>
                            <ul class="">
                                <li>Please ensure that the files that you supply are orientated correctly.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="artwork-guide-box">
                        <div class="artwork-guide-icon">
                            <img src="{{url('/public/vendor/avored-default')}}/images/art-icon-8.png">
                        </div>
                        <div class="artwork-guide-content">
                            <h4>FOLDING JOB EXAMPLES</h4>
                            <ul class="">
                                <li>If you intend ordering a job that requires folding, please check the examples provided to ensure your artwork supplied is correct. 
                                    <a href="#"><i class="download-icon"></i>Head to Head</a>
                                </li>
                                <li>Your design is one page portrait and the other page landscape
                                    <a href="#"><i class="download-icon"></i>Head of portrait page aligned with right side of landscape page (Option 1)</a>
                                    <a href="#"><i class="download-icon"></i>Head of portrait page aligned with left side of landscape page (Option 2)</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="artwork-guide-box">
                        <div class="artwork-guide-icon">
                            <img src="{{url('/public/vendor/avored-default')}}/images/art-icon-9.png">
                        </div>
                        <div class="artwork-guide-content">
                            <h4>RESPONSIBILITY</h4>
                            <ul class="">
                                <li>Whilst every effort will be made to inform you of any apparent errors, we will reproduce the artwork you provide without further proof-reading on our part.</li>
                                <li>We do not accept responsibility for any inaccuracies in your artwork.</li>
                            </ul>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </section>
      
@endsection
@push('scripts')
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#select_category").on("change", function(){
            var catid = jQuery(this).val();
            var links = jQuery.get("{{url('getproductsbycat')}}", { catid: catid }, function (data) {
            var prodData = JSON.parse(data);

            var html = '<option>Select Product</option>'
            for(i=0; i<prodData.length;i++){
                html += '<option value="'+prodData[i].id+'">'+prodData[i].name+'</option>';
            }
            jQuery("#select_product").html(html);
        });        
    });
});
</script>
@endpush


