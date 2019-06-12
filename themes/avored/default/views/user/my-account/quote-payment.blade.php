@extends('layouts.quote-payment')

@section('meta_title','Quote payment')
@section('meta_description','Quote payment')

@section('quotePayment-content')
 <form action="{{url('/quotation/cart')}}" method="post">
 {{csrf_field()}}
 <input type="hidden" name="qid" value="{{$quotes->id}}">
    <section class="quote-id-sec quote-payment-sec">
      <div class="container">
        <div class="quote-id">
                <h2 class="quote-main-heading" style="margin-bottom: 0">QUOTE ID: {{strtoupper($quotes->order_id)}}</h2>
                <div class="table-responsive">
                    <table class="table table-vertical-middle">
                        <thead>
                            <tr>
                                <th colspan="2" style="border-top: 0px solid #dee2e6;">Order Details</th>
                            </tr>
                        </thead>
                         <tbody>
                            <tr>
                                <th>Job Description</th>
                                <td>{{$quotes->product->name}}({{$quotes->category->name}}),{{$quotes->orderdata->size}},{{$quotes->orderdata->colors}},{{$quotes->orderdata->pages}},{{$quotes->orderdata->finishing_req}},{{$quotes->orderdata->papertype}},({{$quotesinfo->quotesdata->quote_tat}}Days TAT),x{{$quotesinfo->quotesdata->quote_quantity}}</td>
                            </tr>
                            <tr>
                                <th>Paper Stock</th>
                                <td>{{$quotes->orderdata->papertype}}</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
        </div>
<div class="turnaround_time" style="display: none;">{{$quotesinfo->quotesdata->quote_tat}}</div>
      </div>
    </section>
    <section class="order-details-box">
            <div class="container">
                <div class="order-details-title">
                    <h4>Printing Details</h4>
                </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>PO# <span class="mandotary-field">*</span></label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="NO-PO" name="po" required="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="reference" id="exampleInputPassword1" placeholder="Reference" required="">
                            </div>
                        </div> 
                      
                         <div class="col-md-12">
                            <div class="form-group">
                                <label>Orientation (Flat size) <span class="mandotary-field">*</span></label>
                                <select class="form-control" name="orientation" required="">
                                     <option>None</option>
                                     <option selected="" value="Portrait">Portrait</option>
                                      <option value="Landscape">Landscape</option>
                                </select>
                            </div>
                        </div> 
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Proof Needed</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="proof" class="custom-control-input" value="pdf" >
                                    <label class="custom-control-label" for="customRadio1">PDF</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="proof" class="custom-control-input" checked="" value="no">
                                    <label class="custom-control-label" for="customRadio2">NO</label>
                                </div>
                            </div>
                        </div> 
                        
                    </div>
                
            </div>
    </section> 
    <section class="order-details-box">
                    <div class="container">
                        <div class="order-details-title">
                            <h4>Delivery Instructions</h4>
                            <p>Comments provided below are for delivery instructions only.</p>
                            <p>Special or split delivery instructions should be emailed to our orders team to make the appropriate arrangements.</p>
                        </div>
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea class="form-control" name="instructions" placeholder="Instructions"></textarea>                                
                                    </div>
                                </div>
                            </div>
                    </div>
    </section>  
    <section class="order-details-box">
            <div class="container">
                <div class="order-details-title">
                    <h4>Delivery Address</h4>
                </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contact Person" name="contact_person" value="@if(isset($user_address->delivery_contact_person)){{$user_address->delivery_contact_person}}@endif" required="">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contact Number" name="phone" required="" value="@if(isset($user_address->delivery_contact_person)){{$user_address->delivery_contact_number}}@endif">
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email" required="" value="@if(isset($user_address->delivery_email)){{$user_address->delivery_email}}@endif">
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Business Name" name="business_name" required="" value="@if(isset($user_address->delivery_business)){{$user_address->delivery_business}}@endif">
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address Line 1" name="address1" required="" value="@if(isset($user_address->delivery_address1)){{$user_address->delivery_address1}}@endif">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address Line 2" name="address2" value="@if(isset($user_address->delivery_address2)){{$user_address->delivery_address2}}@endif">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="City/Town" name="city" required="" value="@if(isset($user_address->delivery_city)){{$user_address->delivery_city}}@endif">
                            </div>
                        </div>
                        <?php $countries = array("England-UK", "Scotland-UK", "Wales-UK", "Northern Ireland-UK", "Republic of Ireland");
                                ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="country" required="">
                                    <option>Please select country</option>
                                     @foreach ($countries as $country): ?>
                                        <option value="{{ $country }}" @if(isset($user_address->delivery_country))@if($user_address->delivery_country == $country) selected @endif @endif>{{ $country }}</option>
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

                                    <select class="form-control" name="state" required="" state="@if(isset($user_address->delivery_state)){{$user_address->delivery_state}}@endif">
                                    <option value="">Please select county</option>
                                </select>
                                </div>
                            </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Postal Code" name="postalcode" required="" value="@if(isset($user_address->delivery_postalcode)){{$user_address->delivery_postalcode}}@endif">
                            </div>
                        </div>
                        
                    </div>
                
            </div>
    </section>  
    <section class="place-order-details">
        <div class="container">
            <div class="row">
                    <div class="col-md-6">
                            <div class="products-order-heading">
                                <h4>Place order</h4>
                            </div>   
                    <div class="place-order-box">

                       <label class="order-box-heading">Order details</label>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="order_detail" class="custom-control-input" value="" checked="">
                                    <label class="custom-control-label" for="customRadio3">{{$quotes->product->name}}({{$quotes->category->name}}),{{$quotes->orderdata->size}},{{$quotes->orderdata->colors}},{{$quotes->orderdata->pages}},{{$quotes->orderdata->finishing_req}},{{$quotes->orderdata->papertype}},({{$quotesinfo->quotesdata->quote_tat}}Days TAT),x{{$quotesinfo->quotesdata->quote_quantity}} </label>
                                </div>
                            </div>
                        </div>
                       <label class="order-box-heading">How do you wish to pay?</label>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" name="stripe" class="custom-control-input" value="stripe" checked="">
                                    <label class="custom-control-label" for="customRadio4">Stripe </label>
                                </div>
                            </div>                           
                        </div> 
                        
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox place-order-chk">
                                <input type="checkbox" id="customCk4" name="customRadio" class="custom-control-input sustainable_paper_checkbox" value="20" required>
                                <label class="custom-control-label sustainable_paper" for="customCk4">
                                    <span class="under-line-span"><a href="#" class="green-underline">Terms and conditions</a></span> accepted by customer
                                </label>
                           </div> 
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="ct-btn order_btn">Place Order</button>

                        </div>                        


                    </div>                                
  
                    </div>
                        
                    <div class="col-md-6">
                        <div class="time-box">
                            <div class="row">
                                <div class="col s12">
                                    <div class="time-box-head">
                                        <img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/order-approve-icon.png"> <span class="inline-block vertical-align-middle">Order and approve within the next</span>
                                    </div>
                                    <div class="time-box-content">
                                        <div class="vertical-align-wrap">
                                                <div class="count-down">
                                                    <div class="count-down-row" id="countdown"></div>
                                                </div>
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="ship_aroundajax">
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="time-box-head">
                                                  <img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/order-dispatched-icon.png"> <span class="inline-block vertical-align-middle">Your order will be dispatched on</span>
                                            </div>
                                            <div class="time-box-content">
                                                        <div class="time-box-content-text">
                                                            <input type="hidden" name="dispatch_date">
                                                            <span class="dispatch">Monday 20th May</span>
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="time-box-head">
                                                  <img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/order-receive-icon.png"> <span class="inline-block vertical-align-middle">Receive your order on</span>
                                            </div>
                                            <div class="time-box-content">
                                                        <div class="time-box-content-text">
                                                            <input type="hidden" name="orderend_date">
                                                            <span class="order_end">Tuesday 21th May</span>
                                                        </div>                      
                                            </div>
                                        </div>
                                    </div>
                           </div>
                        </div>
                  </div>
            </div>
        </div>
    </section> 
    </form>             
@endsection
@push("scripts")
<script>
var date = new Date(); 
var hrs = date.getHours();
var mins = date.getMinutes();
var secs = date.getSeconds();
var start_time = hrs+":"+mins+":"+secs;

//end time
var end_time = "7:0:0";

var mid_time = "21:0:0";

var stt = new Date(date.getMonth()+" "+date.getDate()+","+date.getFullYear()+" "+ start_time);
stt = stt.getTime();

var endt = new Date(date.getMonth()+" "+date.getDate()+","+date.getFullYear()+" "+ end_time);
endt = endt.getTime();

var midt = new Date(date.getMonth()+" "+date.getDate()+","+date.getFullYear()+" "+ mid_time);
midt = midt.getTime();

if((stt > endt) && (stt < midt)){
   var myVar = setInterval(myTimer, 1000);
}else{
    myStopFunction();
    document.getElementById("countdown").innerHTML="00:00:00";
}
//var myVar = setInterval(myTimer, 1000);

function myTimer(n) {
  var now = new Date();
  var hrs = 21-now.getHours();
  var mins = 60-now.getMinutes();
  var secs = 60-now.getSeconds();
  hrs = hrs < 10 ? "0" + hrs : hrs;
  mins = mins < 10 ? "0" + mins : mins;
  secs = secs < 10 ? "0" + secs : secs;
  timeLeft = "" +hrs+' HRS '+mins+' MINS '+secs+' SECS';
  document.getElementById("countdown").innerHTML=timeLeft;
  if(hrs+':'+mins+':'+secs == '0:0:0'){
     myStopFunction();
  }
}

function myStopFunction() {
  clearInterval(myVar);
}
</script>
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

    $(document).ready(function(){
              if($("select[name=country_bill]").val() == "England-UK"){
                  var obj = <?php echo $england_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                   var state =  $("select[name=state_bill]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else if($("select[name=country_bill]").val() == "Scotland-UK"){
                  var obj = <?php echo $scotland_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("select[name=state_bill]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else if($("select[name=country_bill]").val() == "Wales-UK"){
                  var obj = <?php echo $wales_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("select[name=state_bill]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else if($("select[name=country_bill]").val() == "Northern Ireland-UK"){
                  var obj = <?php echo $north_iralnad_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("select[name=state_bill]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else if($("select[name=country_bill]").val() == "Republic of Ireland"){
                  var obj = <?php echo $ireland_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("select[name=state_bill]").attr("state");
                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else{
                  var html = "<option value=''>Select Your County</option>";
                  $("select[name=state_bill]").html(html);
              }
          $("select[name=country_bill]").change(function(){
              if($(this).val() == "England-UK"){
                  var obj = <?php echo $england_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else if($(this).val() == "Scotland-UK"){
                  var obj = <?php echo $scotland_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else if($(this).val() == "Wales-UK"){
                  var obj = <?php echo $wales_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else if($(this).val() == "Northern Ireland-UK"){
                  var obj = <?php echo $north_iralnad_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else if($(this).val() == "Republic of Ireland"){
                  var obj = <?php echo $ireland_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("select[name=state_bill]").html(html);
              }else{
                  var html = "<option value=''>Select Your County</option>";
                  $("select[name=state_bill]").html(html);
              }
          });
      });

 //////////////////  TURNAROUND TIME//////////////////////////////////////

    var dispatch = new Date();
       var dispatch_current_day = jQuery("body .turnaround_time").html() - 1;
       const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        
        var mon= monthNames[dispatch.getMonth()];
        var dd = String(dispatch.getDate()).padStart(2, '0');
        var yyyy = dispatch.getFullYear();
        var startDate = dd+"-"+mon+"-"+yyyy;
        startDate = new Date(startDate.replace(/-/g, "/"));
        var endDate = "", noOfDaysToAdd = dispatch_current_day, count = 0;
        while(count < noOfDaysToAdd){
            dispatchDate = new Date(startDate.setDate(startDate.getDate() + 1));
            if(dispatchDate.getDay() != 0 && dispatchDate.getDay() != 6){
               //Date.getDay() gives weekday starting from 0(Sunday) to 6(Saturday)
               count++;
            }
        }
        var dd = String(dispatchDate.getDate()).padStart(2, '0');
            var mm = String(dispatchDate.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = dispatchDate.getFullYear();
             var weekday = new Array(7);
              weekday[0] = "Sunday";
              weekday[1] = "Monday";
              weekday[2] = "Tuesday";
              weekday[3] = "Wednesday";
              weekday[4] = "Thursday";
              weekday[5] = "Friday";
              weekday[6] = "Saturday";

              var n = weekday[dispatchDate.getDay()];
            const monthNames1 = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
            var m = monthNames1[dispatchDate.getMonth()]
          
            jQuery(".dispatch").html(n+" "+dd+"th "+m); 
            var dispatch_date = yyyy+"-"+mm+"-"+dd; 
            jQuery("body").find(".order_btn").attr("dispatch_date",dispatch_date);
            jQuery("body").find("input[name=dispatch_date]").val(dispatch_date);  
        ////////////////////// get order end ////////
       var order_end = new Date();
       var order_current_day = jQuery("body .turnaround_time").html();
       const monthNames2 = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        
        var mon= monthNames2[order_end.getMonth()];
        var dd = String(order_end.getDate()).padStart(2, '0');
        var yyyy = order_end.getFullYear();
        var startDate = dd+"-"+mon+"-"+yyyy;
        startDate = new Date(startDate.replace(/-/g, "/"));
        var endDate = "", noOfDaysToAdd = order_current_day, count = 0;
        while(count < noOfDaysToAdd){
            order_endDate = new Date(startDate.setDate(startDate.getDate() + 1));
            if(order_endDate.getDay() != 0 && order_endDate.getDay() != 6){
               //Date.getDay() gives weekday starting from 0(Sunday) to 6(Saturday)
               count++;
            }
        }
        var dd = String(order_endDate.getDate()).padStart(2, '0');
            var mm = String(order_endDate.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = order_endDate.getFullYear();
             var weekday = new Array(7);
              weekday[0] = "Sunday";
              weekday[1] = "Monday";
              weekday[2] = "Tuesday";
              weekday[3] = "Wednesday";
              weekday[4] = "Thursday";
              weekday[5] = "Friday";
              weekday[6] = "Saturday";

              var n = weekday[order_endDate.getDay()];
            const monthNames4 = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
            var m = monthNames4[order_endDate.getMonth()]

            jQuery(".order_end").html(n+" "+dd+"th "+m); 
            var order_date = yyyy+"-"+mm+"-"+dd; 
            jQuery("body").find(".order_btn").attr("order_date",order_date);
            jQuery("body").find("input[name=orderend_date]").val(order_date); 
            

  </script>
@endpush