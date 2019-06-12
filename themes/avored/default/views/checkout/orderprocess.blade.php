@extends('layouts.app_new')

@section('meta_title', 'Register: AvoRed E commerce')
@section('meta_description', 'Register to Manage your Account for AvoRed E Commerce')
@section('slider')
        <div class="registration-banner inner-banner">
            <div class="container">
                <div class="banner-heading">
                    <h2>Order Details</h2>
                </div>
            </div>
        </div>
@endsection
@section('breadcums')
        <div class="breadcrumb-block">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer Registration</li>
                    </ol>
                </nav>
            </div>
        </div>

@endsection
        
@section('content')
<div class="product-timeline">
            <div class="container">
                <ol class="clearfix">
                    <li class="check-icon">
                        <h6>Basket</h6>
                        <span class="timeline-number">1</span>
                    </li>    
                    <li class="active">
                        <h6>Details</h6>
                        <span class="timeline-number">2</span>
                    </li> 
                    <li>
                        <h6>Confirm</h6>
                        <span class="timeline-number">3</span>
                    </li> 
                </ol>
            </div>
        </div>
  <section class="order-details-sec">
            <div class="container">
                <div class="order-details-title">
                    <h4>Order Details</h4>
                </div>
                
                <div class="table-responsive order-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Paper</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Sort</th>
                                <th scope="col">Side</th>
                                <th scope="col">Turnaround Time</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php //echo "<pre>"; print_r($orderData); die; ?>
                                <td>{{$orderData['product']}}  @if($orderData['product_total']->printing_sample)<br> +6 printed samples @endif  @if($orderData['product_total']->sustainable_paper)<br> +printed on sustainable paper @endif</td>
                                <td>{{$orderData['material']}}</td>
                                <td>{{$orderData['product_total']->quantity}}</td>
                                <td>{{$orderData['product_total']->select_sort}}</td>                                
                                <td>{{$orderData['side']}}</td>
                                <td>{{$orderData['product_total']->order_day}} days</td>
                                <?php $price = $orderData['org_price']; 
                                  if($orderData['product_total']->printing_sample) {
                                       $price =  $price + $orderData['product_total']->printing_sample;
                                  } 
                                  if($orderData['product_total']->sustainable_paper) {
                                       $price =  $price + $orderData['product_total']->sustainable_paper;
                                  }
                                ?>                         
                                <td>{{$orderData['symbol']}}{{$price}}</td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>

                <div class="row">
                   <div class="col-sm-9">
                              <div class="order-back-content">
                                    <p><span class="bold-text">If this is</span> the product you want to order, please continue with the process below.</p>
                                    <p>You have requested that the item is <span class="bold-text colored">Saddle Stitch.</span></p>
                                    <p><span class="bold-text">If this is not</span> the product you want to order, or you want to make a change to the order, please use the back button below to change your order.</p>
                                    <a href="{{ url('product') }}/{{$orderData['product_slug']}}" class="ct-btn">Back</a>
                                </div> 
                    </div>
                    <div class="col-sm-3">
                                 <div class="order-back-image">
                                    <img src="{{url('/')}}/public/vendor/avored-default/images/cart.png" alt="cart-img">
                                </div>
                    </div>
                </div>
                
            </div>
        </section>
        
    <form action="{{url('add-to-cart')}}" method="post">
    	{{csrf_field()}}
    	<input type="hidden" name="order_process_id" value="{{$orderData['order_process_id']}}">
        <div class="order-details-box">
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
                                	 @foreach($orientation_data as $orientation)
                                       <option <?php echo ($orderData['orientation_id'] == $orientation->id)?'selected':'';?> value="{{$orientation->name}}">{{$orientation->name}}</option>
                                     @endforeach  
                                </select>
                            </div>
                        </div> 
                        
                        <!-- <div class="col-md-12">
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
                        </div>  -->
                        
                    </div>
                
            </div>
        </div>
        
        
        <div class="order-details-box">
            <div class="container">
                <div class="order-details-title">
                    <h4>Delivery Instructions</h4>
                    <p>Comments provided below are for delivery instructions only. Special or split delivery instructions should be emailed to our orders team to make the appropriate arrangements.</p>
                </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <textarea class="form-control" name="instructions" placeholder="Instructions"></textarea>                                
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        
         <div class="order-details-box">
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
        </div>
        
        
         <div class="order-details-box">
            <div class="container">
                <div class="order-details-title">
                    <h4>Billing Address</h4>
                </div>
               
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contact Person" name="contact_person_bill" required="" value="@if(isset($user_address->billing_contact_person)){{$user_address->billing_contact_person}}@endif">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Contact Number" name="phone_bill" required="" value="@if(isset($user_address->billing_contact_number)){{$user_address->billing_contact_number}}@endif">
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email_bill" required="" value="@if(isset($user_address->billing_email)){{$user_address->billing_email}}@endif">
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Business Name" name="business_bill" required="" value="@if(isset($user_address->billing_business)){{$user_address->billing_business}}@endif">
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address Line 1" name="address1_bill" required="" value="@if(isset($user_address->billing_address1)){{$user_address->billing_address1}}@endif">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address Line 2" name="address2_bill" value="@if(isset($user_address->billing_address2)){{$user_address->billing_address2}}@endif">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="City/Town" name="city_bill" required="" value="@if(isset($user_address->billing_city)){{$user_address->billing_city}}@endif">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="country_bill" required="">
                                    <option>Please select country</option>
                                    @foreach ($countries as $country): ?>
                                        <option value="{{ $country }}"  @if(isset($user_address->billing_country))@if($user_address->billing_country == $country) selected @endif @endif>{{ $country }}</option>
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

                                    <select class="form-control" name="state_bill" required="" state="@if(isset($user_address->billing_state)){{$user_address->billing_state}}@endif">
                                    <option value="">Please select county</option>
                                </select>
                                </div>
                            </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Postal Code" name="postalcode_bill" required="" value="@if(isset($user_address->billing_postalcode)){{$user_address->billing_postalcode}}@endif">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="ct-btn">Continue</button>
                            </div>
                        </div>
                        
                    </div>
            </div>
        </div>
    </form>    
        
        <div class="customize-block">
            <div class="container">
                <div class="row customize-b-line">       
                  <div class="col-sm-9">
                    <div class="customize-content">
                        <h4>Delivery Included</h4>
                        <p>This job will ship in <span class="bold-text colored">8 Days</span> after approval of the proof. For any issues concerning this job you can email :  <a href="mailto:orders@quinnstheprinters.com" target="_top" class="email">orders@quinnstheprinters.com</a></p>
                    </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="customize-image">
                        <img src="{{url('/')}}/public/vendor/avored-default/images/delivery.png" alt="delivery-img">          
                     </div>
                  </div>              
                </div>
                <div class="row">       
                  <div class="col-sm-9">
                        <div class="customize-content">
                                <h4>Customize Your Design</h4>
                                <p>You can send colour match samples so that we could match them at the press. If you need to colour match more than one job, for each job you need to send separate colour match samples.</p>
                        </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="customize-image">                    
                        <img src="{{url('/')}}/public/vendor/avored-default/images/design.png" alt="design-img">
                    </div>
                  </div>              
                </div>                
             </div>
        </div>
   
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

  </script>
@endpush
