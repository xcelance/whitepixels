@extends('layouts.app_new')

@section('meta_title')
    {{ $page->title }}
@endsection
@if(!Auth::user())
  
  <script type="text/javascript">
      window.location.href="{{url('/')}}"
  </script>

@endif
@section('slider')
<div class="aboutus-banner inner-banner">
    <div class="container">
        <div class="banner-heading">
            <h2>Request a Quote</h2>
        </div>
    </div>
</div>
@endsection
@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('request_quote') }}
        </nav>
    </div>
</div>
@endsection

@section('content')	  
        
        <section class="registration-sec">
            <div class="container">
                <div class="registration-header">
                    <p>In order to get a quote from whitepixels.com, please complete the form below.</p>
                    <p>Required fields are indicated by an asterisk (*).</p>
                    <p>Our managers will contact you shortly regarding your request.</p>
                </div>
                
                <div class="reg-form">
                    @if(Session::has('quotation_success'))
                      <p class="alert alert-success">{{ Session::get('quotation_success') }}</p>
                    @endif
                    @if(Session::has('captcha_error'))
                      <p class="alert alert-danger">{{ Session::get('captcha_error') }}</p>
                    @endif

                    <form method="POST" action="{{ url('/request_quote') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">                                    
                                    <select class="form-control" id="select_category" name="category" required>
                                        <option>Select Category</option>
                                        @foreach($categorylist as $value)
                                            <option value="{{$value->id}}" @if(Request::old('category') == $value->id) selected @endif>{{$value->name}}</option>
                                        @endforeach                                        
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="custname" name="custname" placeholder="Name*" value="@if(Auth::user()){{Auth::user()->contact_person}}@endif" required="">
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="select_product" name="product"  required>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company" value="@if(Auth::user()){{Auth::user()->company_name}}@endif">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="prodsize" name="size" placeholder="Size*"  value="{{ Request::old('size') }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="telephone" placeholder="Telephone*" name="phone" value="@if(Auth::user()){{Auth::user()->phone}}@endif">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="colours" name="colors" placeholder="No. of colours*" required>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email*" value="@if(Auth::user()){{Auth::user()->email}}@endif">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="pages" name="pages" value="{{ Request::old('pages') }}" placeholder="No. of pages*" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City/Town*" value="@if(Auth::user()){{Auth::user()->city}}@endif">                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="finishing_req" name="finishing_req" value="{{ Request::old('finishing_req') }}" placeholder="Finishing Requirements*" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="papertype" name="papertype" value="{{ Request::old('papertype') }}" placeholder="Type & Weight of paper*" required>
                                </div>
                            </div>  

                             <?php $countries = array("England-UK", "Scotland-UK", "Wales-UK", "Northern Ireland-UK", "Republic of Ireland");?>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control"                                           
                                           name="country" required >
                                           <option value="">Select Country</option>
                                           @foreach ($countries as $country)                                                 
                                              <option value="{{ $country }}"@if(Auth::user()) @if(Auth::user()->country == $country) selected @endif @endif >{{ $country }}</option>
                                           @endforeach 
                                        
                                    </select>                                 
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="artwork" name="artwork" value="{{ Request::old('artwork') }}" placeholder="Artwork Requirement*" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ Request::old('quantity') }}" placeholder="Quantity*" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="postcode" name="postcode" value="@if(Auth::user()){{Auth::user()->postcode}}@endif" placeholder="Postcode">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">                                    
                                    <textarea class="form-control" id="other_req" name="other_req" placeholder="Other"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" id="extra_info" name="extra_info" placeholder="Extra Info"></textarea>
                                </div>
                            </div>

                            <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>                        
                         
                            <div class="submit-btn">
                                <button type="submit" class="ct-btn">Submit</button>
                            </div>
                        </div>
                    </form>
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


