@extends('layouts.app_new')

@section('meta_title')
    Sample Packs
@endsection

@section('slider')
<div class="aboutus-banner inner-banner">
    <div class="container">
        <div class="banner-heading">
            <h2>Sample Packs</h2>
        </div>
    </div>
</div>
@endsection
@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('samplepacks') }}
        </nav>
    </div>
</div>
@endsection

@section('content')	  
        
        <section class="registration-sec">
            <div class="container">
                <div class="registration-header">
                    <h3>Get free sample</h3>
                    <p>We produce a complimentary sample pack that is available on request, which includes a range of products and paper stock to illustrate our colour and print quality.</p>
                    <p>Please fill in the form below to receive your FREE sample pack.</p>
                    <p>We will use your address to update you on our latest offers.</p>
                    
                </div>
                
                <div class="reg-form">
                    @if(Session::has('sample_success'))
                      <p class="alert alert-success">{{ Session::get('sample_success') }}</p>
                    @endif
                    @if(Session::has('captcha_error'))
                      <p class="alert alert-danger">{{ Session::get('captcha_error') }}</p>
                    @endif

                    <form method="POST" action="{{ url('samplepacks') }}">
                        {{ csrf_field() }}
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="custname" name="custname" placeholder="Name*" value="@if(Auth::user()){{Auth::user()->contact_person}}@endif" required="">
                                </div>
                            </div> 
                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company" value="@if(Auth::user()){{Auth::user()->company_name}}@endif">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea id="address" class="form-control" name="address" placeholder="Address*"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="street" placeholder="Street*" name="street" value="@if(Auth::user()){{Auth::user()->street}}@endif">
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email*" value="@if(Auth::user()){{Auth::user()->email}}@endif">
                                </div>
                            </div>                           
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City/Town*" value="@if(Auth::user()){{Auth::user()->city}}@endif">                                    
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

                                    <select class="form-control" name="state" required="" state="@if(Auth::user()){{Auth::user()->state}}@endif">
                                    <option value="">Please select county</option>
                                </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="postcode" name="postcode" value="@if(Auth::user()){{Auth::user()->postcode}}@endif" placeholder="Postcode">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="phone" name="phone" value="@if(Auth::user()){{Auth::user()->phone}}@endif" placeholder="Telephone*" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ Request::old('quantity') }}" placeholder="Quantity*" required>
                                </div>
                            </div>
                            
                            
                        </div>
                        
                        <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">                                    
                                    <textarea class="form-control" id="message" name="message" placeholder="Message*"></textarea>
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
@push("scripts")
  <script type="text/javascript">
      $(document).ready(function(){

           if($("select[name=country]").val() == "England-UK"){
                  var obj = <?php echo $england_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";
                 var state =  $("select[name=state]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else if($("select[name=country]").val() == "Scotland-UK"){
                  var obj = <?php echo $scotland_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("select[name=state]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else if($("select[name=country]").val() == "Wales-UK"){
                  var obj = <?php echo $wales_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("select[name=state]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else if($("select[name=country]").val() == "Northern Ireland-UK"){
                  var obj = <?php echo $north_iralnad_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("select[name=state]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else if($("select[name=country]").val() == "Republic of Ireland"){
                  var obj = <?php echo $ireland_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("select[name=state]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state]").html(html);
              }else{
                  var html = "<option value=''>Select Your County</option>";
                  $("select[name=state]").html(html);
              }
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