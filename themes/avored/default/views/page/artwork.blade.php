@extends('layouts.app_new')


@section('slider')
<div class="upload-artwork-banner inner-banner">
            <div class="container">
                <div class="banner-heading">
                    <h2>Upload Artwork</h2>
                </div>
            </div>
        </div>
@endsection
@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('upload-artwork') }}
        </nav>
    </div>
</div>
@endsection

@section('content')
	<section class="become-partner-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="become-partner-content upload-art-content">
                            <h4>UPLOAD YOUR ARTWORK 24 HOURS A DAY</h4>
                            <ul class="">
                                <li>Verify that your order number matches your job description before you continue</li>
                                <li>You are required to upload 1 file per sort ordered,  unless otherwise stated</li>
                                <li>Check our Artwork Guide for how to supply your artwork correctly</li>
                            </ul>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                        <div class="become-partner-img">
                           <img src="{{url('public/vendor/avored-default/')}}/images/upload-arwork-img.jpg">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="upload-art-text">
                            <p>Need assistance? Call our PrePress team direct on 028 9032 3552 - opt 4 If any problems occur during artwork upload, the artwork can be emailed to <a href="#">artwork@whitepixels.net</a></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="upload-art-form">
                            <div class="">
                                <span class="form-number">1</span>
                                <h4> Fill in all the fields with</h4>
                            </div>
                            <form method="post" id="artwork_form" enctype='multipart/form-data'>
                                {{csrf_field()}}
                            <div class="artwork_alert"></div>
                              
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="artwork_email" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="job_id" placeholder="Job Ref ID" name="job_id" required="">
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group browse" >
                                            
                                        </div>
                                    </div> 
                                </div>

                                <div class="submit-btn">
                                    <button type="submit" class="ct-btn artwork_btn">Continue</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    
                     <div class="col-md-12">
                        <div class="upload-art-content">
                            <h5>Check before uploading your artwork</h5>
                            <ul class="">
                                <li>I have not placed text closer than 3mm to the edge of the page.</li>
                                <li>I have not supplied the front and back pages side by side on a single PDF.</li>
                                <li>I have checked to ensure there is a 3mm bleed where required.</li>
                                <li>I have checked to ensure the orientation of the artwork is correct.</li>
                                <li>I have checked to ensure there is no critical text which lies outside the printing area, as this will be cutoff during finishing.</li>
                            </ul>
                            <p>Please ensure your artwork is correct, as any errors in your artwork will cause a delay in processing your job, and will result in an <a href="#">extra charge</a> if the artwork needs changing once your job status has been updated to <a href="#">proofs approved.</a></p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
      
@endsection
@push('scripts')
  <script type="text/javascript">
        jQuery(document).ready(function () {

            ///////////////////// order button /////////////////////
            jQuery(document).on("keyup","#job_id",function(){

                    var job_id = jQuery(this).val();
                    var action = "{{url('check_jobId')}}"
                    jQuery.ajax({
                    headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                                  },
                    type: 'post',
                    url: action,
                    data:{job_id:job_id},
                    success: function(response) {
                            if(response == "true"){
                              jQuery(".browse").html("<input type='file' class='artwork_file' name='artwork_file' multiple required>");
                            }else{
                              jQuery(".browse").html("")
                            }
                            /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                        }
                    });
            });
            ///////////////////// order button /////////////////////
            jQuery(document).on("submit","#artwork_form",function(e){
                e.preventDefault();
                setTimeout(function(){ jQuery(".artwork_alert").html(''); }, 8000);
                if(jQuery(this).find(".browse").html().length < 1){
                   jQuery(".artwork_alert").html('<div class="alert alert-danger" role="alert">Wrong Job id!</div>');
                }else{
                    jQuery(".artwork_btn").prop("disabled",true);
                    var action = "{{url('uploadartwork')}}";
                    var form_data = new FormData();
                    file_data = $("input[name=artwork_file]").prop("files")

                    for (var i = 0; i < file_data.length; i++) {
                         form_data.append("artwork_file[]", file_data[i]);
                    } 
                    jQuery(this).find('input[type=text]').each(function(){
                      form_data.append([this.name], $(this).val());
                    }); 
                    jQuery(this).find('input[type=email]').each(function(){
                      form_data.append([this.name], $(this).val());
                    });   

                    jQuery.ajax({
                    headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                                  },
                    type: 'post',
                    url: action,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(response) {
                            jQuery(".artwork_btn").prop("disabled",false);
                            if(response == "true"){
                              jQuery(".artwork_alert").html('<div class="alert alert-success" role="alert">Successfully Upload files on your job id!</div>');
                              jQuery("body").find("#artwork_form")[0].reset();
                            }else{
                              jQuery(".artwork_alert").html('<div class="alert alert-danger" role="alert">Something went wrong!</div>');
                            }
                        }
                    });
                }    
            });
        });
  </script>

@endpush


