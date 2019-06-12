@extends('layouts.app_new')

@section('meta_title', 'Register: AvoRed E commerce')
@section('meta_description', 'Register to Manage your Account for AvoRed E Commerce')
@section('slider')
        <div class="registration-banner inner-banner">
            <div class="container">
                <div class="banner-heading">
                    <h2>Customer Registration</h2>
                </div>
            </div>
        </div>
@endsection
@section('breadcrumbs')
        <div class="breadcrumb-block">
            <div class="container">
                <nav aria-label="breadcrumb">
                   {{ Breadcrumbs::render('registeration') }}
                </nav>
            </div>
        </div>

@endsection
@section('content')
  <section class="registration-sec">
            <div class="container">
                <div class="registration-header">
                    <h4>Create a Customer Account with <a href="#">whitepixels.net</a> by completing the form below and receive <a href="#" class="underline">10% off your first order.</a></h4>
                </div>
                
                <div class="reg-form">
                    @if(Session::has('register_success'))
                      <p class="alert alert-success">{{ Session::get('register_success') }}</p>
                    @endif
                    @if(Session::has('captcha_error'))
                      <p class="alert alert-danger">{{ Session::get('captcha_error') }}</p>
                    @endif
                    <form method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" @if($errors->has('username'))
                                           class="form-control is-invalid"
                                           @else
                                           class="form-control"
                                           @endif
                                           name="username"
                                           value="{{ old('username') }}" required autofocus>
                                    @if($errors->has('username'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('username') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="exampleInputPassword1" placeholder="Company name" @if($errors->has('company_name'))
                                           class="form-control is-invalid"
                                           @else
                                           class="form-control"
                                           @endif
                                           name="company_name"
                                           value="{{ old('company_name') }}" required autofocus>
                                    @if($errors->has('company_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('company_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="exampleInputPassword1" placeholder="Contact Person" @if($errors->has('contact_person'))
                                           class="form-control is-invalid"
                                           @else
                                           class="form-control"
                                           @endif
                                           name="contact_person"
                                           value="{{ old('contact_person') }}" required autofocus>
                                    @if($errors->has('contact_person'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('contact_person') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="exampleInputPassword1" placeholder="Telephone" @if($errors->has('phone'))
                                           class="form-control is-invalid"
                                           @else
                                           class="form-control"
                                           @endif
                                           name="phone"
                                           value="{{ old('phone') }}" required autofocus>
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="exampleInputPassword1" placeholder="Email Address" @if($errors->has('email'))
                                           class="form-control is-invalid"
                                           @else
                                           class="form-control"
                                           @endif
                                           name="email"
                                           value="{{ old('email') }}" required autofocus>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="exampleInputPassword1" placeholder="Address 1" @if($errors->has('address1'))
                                           class="form-control is-invalid"
                                           @else
                                           class="form-control"
                                           @endif
                                           name="address1"
                                           value="{{ old('address1') }}" required autofocus>
                                    @if($errors->has('address1'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address1') }}
                                        </div>
                                    @endif       
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="exampleInputPassword1" placeholder="Address 2" @if($errors->has('address2'))
                                           class="form-control is-invalid"
                                           @else
                                           class="form-control"
                                           @endif
                                           name="address2"
                                           value="{{ old('address2') }}" required autofocus>
                                    @if($errors->has('address2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address2') }}
                                        </div>
                                    @endif       
                                </div>
                            </div>
                            
                            
                            <?php $countries = array("England-UK", "Scotland-UK", "Wales-UK", "Northern Ireland-UK", "Republic of Ireland");
                                ?>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <select class="form-control"  name="country" required="">
                                    <option value="">Please select country</option>
                                     @foreach($countries as $country): ?>
                                        <option value="{{ $country }}">{{ $country }}</option>
                                     @endforeach 
                                </select>
                                </div>
                            </div>
                            <?php 
                              
                              $england_uk_state  = array("Avon","Bedfordshire","Buckinghamshire","Berkshire","Cambridgeshire","Cheshire","Cleveland","Cumbria","Cornwall","Cumberland","Derbyshire","Devon","Dorset","Durham","East Riding of Yorkshire","Essex","Gloucestershire","Greater Manchester","Hampshire","Herefordshire","Hertfordshire","Humberside","Huntingdonshire","Hereford and Worcester","Isle of Wight","Kent","Lancashire","Leicestershire","Lincolnshire","London","Middlesex","Merseyside","Northumberland","Norfolk","North Riding of Yorkshire","Northamptonshire","Nottinghamshire","North Yorkshire","Oxfordshire","Rutland","Shropshire","Suffolk","Somerset","Surrey","Sussex","Staffordshire","East Sussex","West Sussex","South Yorkshire","Tyne and Wear","Warwickshire","Westmorland","Wiltshire","West Midlands","Worcestershire","West Riding of Yorkshire","West Yorkshire","Yorkshire","Isle of Man","Other","Guernsey");
                             $england_uk_state = json_encode($england_uk_state);

                              $scotland_uk_state  = ["Aberdeenshire","Angus","Argyllshire","Ayrshire","Banffshire","Berwickshire","Borders","Bute","Caithness","Central","Clackmannanshire","Dumfries-shire","Dumfries and Galloway","Dunbartonshire","East Lothian","Fife","Grampian","Highland","Inverness-shire","Kincardineshire","Kirkcudbrightshire","Kinross-shire","Lanarkshire","Lothian","Midlothian","Morayshire","Nairn","Orkney","Peebles-shire","Perth","Renfrewshire","Ross and Cromarty","Roxburghshire","Selkirkshire","Shetland","Strathclyde","Stirlingshire","Sutherland","Tayside","Wigtownshire","Western Isles","West Lothian","Other"];
                              $scotland_uk_state = json_encode($scotland_uk_state);
                              $wales_uk_state  = ["Anglesey","Breconshire","Caernarvonshire","Cardiganshire","Carmarthenshire","Clwyd","Denbighshire","Dyfed","Flintshire","Glamorgan","Gwent","Gwynedd","Merionethshire","Mid Glamorgan","Montgomeryshire","Monmouthshire","Pembrokeshire","Powys","Radnorshire","South Glamorgan","West Glamorgan","Wrexham","Other"];
                              $wales_uk_state = json_encode($wales_uk_state);
                              $north_iralnad_state  = ["Antrim","Armagh","Down","Fermanagh","Derry/Londonderry","Tyrone","Other"];
                              $north_iralnad_state = json_encode($north_iralnad_state);

                              $ireland_state  = ["Carlow","Cavan","Clare","Cork","Donegal","Dublin","Galway","Kerry","Kildare","Kilkenny","Leitrim","Laois","Limerick","Longford","Louth","Mayo","Meath","Monaghan","Offaly","Roscommon","Sligo","Tipperary","Waterford","Westmeath","Wexford","Wicklow","Other"]; 
                              $ireland_state = json_encode($ireland_state);

                            ?>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <select class="form-control" name="state" required="">
                                    <option value="">Please select county</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="exampleInputPassword1" placeholder="City" @if($errors->has('city'))
                                           class="form-control is-invalid"
                                           @else
                                           class="form-control"
                                           @endif
                                           name="city"
                                           value="{{ old('city') }}" required autofocus>
                                    @if($errors->has('city'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('city') }}
                                        </div>
                                    @endif       
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Postcode" @if($errors->has('postcode'))
                                           class="form-control is-invalid"
                                           @else
                                           class="form-control"
                                           @endif
                                           name="postcode"
                                           value="{{ old('postcode') }}" required autofocus>
                                    @if($errors->has('postcode'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('postcode') }}
                                        </div>
                                    @endif       
                                </div>
                            </div>
                        </div>
                        
                        <div class="custom-control">
                        	<div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                          
                            <!-- <div class="recaptcha-block">
                                <label for="ReCaptcha">Recaptcha:</label>
                            </div> -->
                            
                            <div class="custom-control custom-checkbox check-box">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Subscribe to our Newsletter</label>
                            </div>
                            
                            
                            <div class="submit-btn">
                                <button type="submit" class="ct-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
    </section>
   
@endsection
@push("scripts")
  <script type="text/javascript">
      $(document).ready(function(){
          $("select[name=country]").change(function(){
              if($(this).val() == "England-UK"){
                  var obj = <?php echo $england_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else if($(this).val() == "Scotland-UK"){
                  var obj = <?php echo $scotland_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else if($(this).val() == "Wales-UK"){
                  var obj = <?php echo $wales_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else if($(this).val() == "Northern Ireland-UK"){
                  var obj = <?php echo $north_iralnad_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else if($(this).val() == "Republic of Ireland"){
                  var obj = <?php echo $ireland_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else{
                  var html = "<option value=''>Select Your County</option>";
                  $("select[name=state]").html(html);
              }
          });
      });

  </script>
@endpush
