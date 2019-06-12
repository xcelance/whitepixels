@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')
        <div id="accordion" class="customer-accordion">
            <div class="container">
            <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                        <span>ACCOUNT INFORMATION</span> 
                        <i class="accordion-arrow"></i>
                    </a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="customer-accordion-content">
                        <div class="edit-customer-form">
                            <i class="edit-btn" data-toggle="modal" data-target="#account_info"></i>
                        </div>
                         <ul class="">
                             <li>
                                 <span class="">Business Name:</span>
                                 <span class="">{{Auth::user()->company_name}}</span>
                             </li>
                             
                             <li>
                                 <span class="">Primary Contact Person:</span>
                                 <span class="">{{Auth::user()->contact_person}}</span>
                             </li>
                             
                             <li>
                                 <span class="">Telephone:</span>
                                 <span class="">{{Auth::user()->phone}}</span>
                             </li>
                             
                             <li>
                                 <span class="">Email:</span>
                                 <span class="">{{Auth::user()->email}}</span>
                             </li>
                             
                             <li>
                                 <span class="">Username:</span>
                                 <span class="">{{Auth::user()->username}}</span>
                             </li>
                             <li>
                                 <span class="">Last Update:</span>
                                 <span class="">{{Auth::user()->updated_at}}</span>
                             </li>
                            
                             
                        </ul>
                        
                       <!--  <div class="custom-control custom-checkbox check-box">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Subscribe to our Newsletter</label>
                        </div> -->
                        
                        <div class="account-btns">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#change_password">Change Passowrd</a>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a class="card-link collapsed" data-toggle="collapse" href="#collapseTwo">
                        <span>BILLING INFORMATION</span> 
                        <i class="accordion-arrow"></i>
                    </a>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <div class="customer-accordion-content">
                        <div class="edit-customer-form">
                            <i class="edit-btn" data-toggle="modal" data-target="#billing_info"></i>
                        </div>
                        <ul class="">
                            <li>
                                <span class="">Business Name:</span>
                                <span class="">{{$useraddress->billing_business}}</span>
                            </li>

                            <li>
                                <span class="">Address Line 1:</span>
                                <span class="">{{$useraddress->billing_address1}}</span>
                            </li>

                            <li>
                                <span class="">Address Line 2:</span>
                                <span class="">{{$useraddress->billing_address2}}</span>
                            </li>

                            <li>
                                <span class="">City/Town:</span>
                                <span class="">{{$useraddress->billing_city}}</span>
                            </li>

                            <li>
                                <span class="">Country:</span>
                                <span class="">{{$useraddress->billing_country}}</span>
                            </li>
                            <li>
                                <span class="">County:</span>
                                <span class="">{{$useraddress->billing_state}}</span>
                            </li>
                            <li>
                                <span class="">Postcode:</span>
                                <span class="">{{$useraddress->billing_postalcode}}</span>
                            </li> 
                            <li>
                                <span class="">Last Update:</span>
                                <span class="">{{$useraddress->updated_at}}</span>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                        <span>DEFAULT DELIVERY INFORMATION</span> 
                        <i class="accordion-arrow"></i>
                    </a>
                </div>
                <div id="collapseThree" class="collapse" data-parent="#accordion">
                    <div class="customer-accordion-content">
                        <div class="edit-customer-form">
                            <i class="edit-btn" data-toggle="modal" data-target="#delivery_info"></i>
                        </div>
                        <ul class="">
                            <li>
                                <span class="">Business Name:</span>
                                <span class="">{{$useraddress->delivery_business}}</span>
                            </li>

                            <li>
                                <span class="">Address Line 1:</span>
                                <span class="">{{$useraddress->delivery_address1}}</span>
                            </li>

                            <li>
                                <span class="">Address Line 2:</span>
                                <span class="">{{$useraddress->delivery_address2}}</span>
                            </li>

                            <li>
                                <span class="">City/Town:</span>
                                <span class="">{{$useraddress->delivery_city}}</span>
                            </li>

                            <li>
                                <span class="">Country:</span>
                                <span class="">{{$useraddress->delivery_country}}</span>
                            </li>
                            <li>
                                <span class="">County:</span>
                                <span class="">{{$useraddress->delivery_state}}</span>
                            </li>
                            <li>
                                <span class="">Postcode:</span>
                                <span class="">{{$useraddress->delivery_postalcode}}</span>
                            </li> 

                            <li>
                                <span class="">Last Update:</span>
                                <span class="">{{$useraddress->updated_at}}</span>
                            </li>
                            
                             <li>
                                <span class="">Status</span>
                                <span class="">On</span>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-- change paswword Modal -->
        <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body clearfix">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="popup-content account-edit-popup">
                            <h4>Change Password</h4>
                            <form method="post" id="change_password_form" action="{{url('my-account/change-password')}}">
                                {{csrf_field()}}
                                <div class="change_password_msg"></div>
                                <div class="form-group">
                                    <label>Old Password <span class="mandotary-field">*</span></label>
                                        <input id="current_password" type="text" class="form-control" placeholder="Old Password" name="current_password" value="" required>
                                        <input id="userid" type="hidden" class="form-control" name="userid" value="{{Auth::user()->id}}" required>
                                </div>
                                <div class="form-group">
                                    <label>New Password <span class="mandotary-field">*</span></label>
                                        <input id="password" type="text" class="form-control" placeholder="New Password" name="password" value="" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Confirm New Password <span class="mandotary-field">*</span></label>
                                    <input id="password_confirmation" type="text" class="form-control" placeholder="Confirm New Password" name="password_confirmation" value="" required>
                                    <button class="search-btn ct-btn" type="submit">Save</button>
                                    <button class="search-btn ct-btn" data-dismiss="modal" aria-label="Close" type="button">Cancel</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Modal -->
        <div class="modal fade" id="account_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body clearfix">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="popup-content account-edit-popup">
                            <h4>Account Information Edit</h4>
                            <form method="post" id="edit_form" action="{{url('my-account/edit_profile')}}">
                                {{csrf_field()}}
                                <div class="edit_msg"></div>
                                <div class="form-group">
                                    <label>Primary Contact Person <span class="mandotary-field">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="contact_person" value="{{Auth::user()->contact_person}}" required="">
                                </div>
                                <div class="form-group">
                                    <label>Username <span class="mandotary-field">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="username" value="{{Auth::user()->username}}" required="">
                                </div>
                                
                                <div class="form-group">
                                    <label>Telephone <span class="mandotary-field">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="phone" value="{{Auth::user()->phone}}" required="">
                                    <button class="search-btn ct-btn" type="submit">Save</button>
                                    <button class="search-btn ct-btn" data-dismiss="modal" aria-label="Close" type="button">Cancel</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- billing model -->
        <div class="modal fade" id="billing_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body clearfix">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="popup-content account-edit-popup">
                            <h4>Billing Information Edit</h4>
                            <form method="post" id="billing_form" action="{{url('my-account/edit_billing')}}">
                                {{csrf_field()}}
                                <div class="edit_bill_msg"></div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" id="business-name" placeholder="Business Name" class="form-control" name="billing_business"  required="" autofocus="" value="{{$useraddress->billing_business}}">
                                             </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Address line 1 <span class="mandotary-field">*</span>
                                                </label>
                                                <input type="text" id="address" placeholder="chandigarh" class="form-control" name="billing_address1" value="{{$useraddress->billing_address1}}" required="" autofocus="">
                                             </div>
                                        </div>  
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Address line 2 <span class="mandotary-field">*</span>
                                                </label>
                                                <input type="text" id="address2" placeholder="chandigarh" class="form-control" name="billing_address2" value="{{$useraddress->billing_address2}}" required="" autofocus="">
                                             </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    City/Town <span class="mandotary-field">*</span>
                                                </label>
                                                <input type="text" id="town" placeholder="carlow" class="form-control" name="billing_city" value="{{$useraddress->billing_city}}" required="" autofocus="">
                                             </div>
                                        </div> 
                                        <?php $countries = array("England-UK", "Scotland-UK", "Wales-UK", "Northern Ireland-UK", "Republic of Ireland");
                                        ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Country <span class="mandotary-field">*</span>
                                                </label>
                                                <select class="form-control" name="billing_country" required="">
                                                        <option>Please Select a Country</option>
                                                          @foreach ($countries as $country): ?>
                                                            <option value="{{ $country }}" @if($useraddress->billing_country == $country) selected @endif>{{ $country }}</option>
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
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    County <span class="mandotary-field">*</span>
                                                </label>
                                                <select class="form-control" name="billing_state" required="" state="{{$useraddress->billing_state}}">
                                                        <option>Please Select a County</option>
                                                    
                                       
                                                 </select>
                                             </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Postcode
                                                </label>
                                                <input type="text" id="postcode" placeholder="R93 A003" class="form-control" name="billing_postalcode" value="{{$useraddress->billing_postalcode}}" required="" autofocus="">
                                             </div>
                                        </div>  
                                        <div class="col-md-12">                                 
                                       <button class="search-btn ct-btn" type="submit">Save</button>
                                       <button class="search-btn ct-btn" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                       </div>         
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>   


    <!-- delivery model -->
        <div class="modal fade" id="delivery_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body clearfix">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="popup-content account-edit-popup">
                            <h4>Delivery Information Edit</h4>
                            <form method="post" id="delivery_form" action="{{url('my-account/edit_delivery')}}">
                                {{csrf_field()}}
                                <div class="edit_delivery_msg"></div>
                                     <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" id="cnt-person" placeholder="Contact Person" class="form-control" name="delivery_contact_person" value="{{$useraddress->delivery_contact_person}}" required="" autofocus="">
                                             </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Contact Number (for Courier) <span class="mandotary-field">*</span>
                                                </label>
                                                <input type="text" id="cnt-num" placeholder="09798732837" class="form-control" name="delivery_contact_number" value="{{$useraddress->delivery_contact_number}}" required="" autofocus="">
                                             </div>
                                        </div>  
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" id="business-name" placeholder="Business Name" class="form-control" name="delivery_business"  required="" autofocus="" value="{{$useraddress->delivery_business}}">
                                             </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Address line 1 <span class="mandotary-field">*</span>
                                                </label>
                                                <input type="text" id="address" placeholder="chandigarh" class="form-control" name="delivery_address1" value="{{$useraddress->delivery_address1}}" required="" autofocus="">
                                             </div>
                                        </div>  
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Address line 2 <span class="mandotary-field">*</span>
                                                </label>
                                                <input type="text" id="address2" placeholder="chandigarh" class="form-control" name="delivery_address2" value="{{$useraddress->delivery_address2}}" required="" autofocus="">
                                             </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    City/Town <span class="mandotary-field">*</span>
                                                </label>
                                                <input type="text" id="town" placeholder="carlow" class="form-control" name="delivery_city" value="{{$useraddress->delivery_city}}" required="" autofocus="">
                                             </div>
                                        </div> 
                                        <?php $countries = array("England-UK", "Scotland-UK", "Wales-UK", "Northern Ireland-UK", "Republic of Ireland");
                                        ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Country <span class="mandotary-field">*</span>
                                                </label>
                                                <select class="form-control" name="delivery_country" required="">
                                                        <option>Please Select a Country</option>
                                                          @foreach ($countries as $country): ?>
                                                            <option value="{{ $country }}" @if($useraddress->delivery_country == $country) selected @endif>{{ $country }}</option>
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
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    County <span class="mandotary-field">*</span>
                                                </label>
                                                <select class="form-control" name="delivery_state" required="" state="{{$useraddress->delivery_state}}">
                                                        <option>Please Select a County</option>
                                                    
                                       
                                                 </select>
                                             </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Postcode
                                                </label>
                                                <input type="text" id="postcode" placeholder="R93 A003" class="form-control" name="delivery_postalcode" value="{{$useraddress->delivery_postalcode}}" required="" autofocus="">
                                             </div>
                                        </div>  
                                        <div class="col-md-12">                                 
                                       <button class="search-btn ct-btn" type="submit">Save</button>
                                       <button class="search-btn ct-btn" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                       </div>   
                                    </div>                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
@endsection
@push("scripts")
 <script type="text/javascript">
        jQuery(document).ready(function () {
            ///////////////////// change form  /////////////////////
            jQuery(document).on("submit","#change_password_form",function(e){
                e.preventDefault();

                    var action = jQuery(this).attr("action");
                    var data = jQuery(this).serialize();
                     jQuery.ajax({
                        headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                                      },
                        type: 'post',
                        url: action,
                        data: data,
                        success: function(response) {
                               var obj = JSON.parse(response);
                                    if(obj.action == "edit_error"){
                                       $(".change_password_msg").html('<div class="alert alert-danger">'+obj.msg+'</div>');
                                    }else if(obj.action == "edit_success"){
                                        $(".change_password_msg").html('<div class="alert alert-success">'+obj.msg+'</div>');
                                        // var redirect="{{url('my-account')}}";
                                        
                                         setTimeout(function(){ 
                                              window.location.reload();
                                         }, 2000);
                                    }else{
                                       $(".change_password_msg").html("Something went wrong");
                                    }
                            }
                        });


            });
            ///////////////////// edit form button /////////////////////
            jQuery(document).on("submit","#edit_form",function(e){
                e.preventDefault();

                    var action = jQuery(this).attr("action");
                    var data = jQuery(this).serialize();
                     jQuery.ajax({
                        headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                                      },
                        type: 'post',
                        url: action,
                        data: data,
                        success: function(response) {
                               var obj = JSON.parse(response);
                                    if(obj.action == "edit_error"){
                                       $(".edit_msg").html('<div class="alert alert-danger">'+obj.msg+'</div>');
                                    }else if(obj.action == "edit_success"){
                                        $(".edit_msg").html('<div class="alert alert-success">'+obj.msg+'</div>');
                                        // var redirect="{{url('my-account')}}";
                                        
                                         setTimeout(function(){ 
                                              window.location.reload();
                                         }, 2000);
                                    }else{
                                       $(".edit_msg").html("Something went wrong");
                                    }
                            }
                        });


            });

            ///////////////////// billing form  /////////////////////
            jQuery(document).on("submit","#billing_form",function(e){
                e.preventDefault();

                    var action = jQuery(this).attr("action");
                    var data = jQuery(this).serialize();
                     jQuery.ajax({
                        headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                                      },
                        type: 'post',
                        url: action,
                        data: data,
                        success: function(response) {
                               var obj = JSON.parse(response);
                                    if(obj.action == "edit_error"){
                                       $(".edit_bill_msg").html('<div class="alert alert-danger">'+obj.msg+'</div>');
                                    }else if(obj.action == "edit_success"){
                                        $(".edit_bill_msg").html('<div class="alert alert-success">'+obj.msg+'</div>');
                                        // var redirect="{{url('my-account')}}";
                                        
                                         setTimeout(function(){ 
                                              window.location.reload();
                                         }, 2000);
                                    }else{
                                       $(".edit_bill_msg").html("Something went wrong");
                                    }
                            }
                        });


            });

             ///////////////////// delivery form  /////////////////////
            jQuery(document).on("submit","#delivery_form",function(e){
                e.preventDefault();

                    var action = jQuery(this).attr("action");
                    var data = jQuery(this).serialize();
                     jQuery.ajax({
                        headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                                      },
                        type: 'post',
                        url: action,
                        data: data,
                        success: function(response) {
                               var obj = JSON.parse(response);
                                    if(obj.action == "edit_error"){
                                       $(".edit_delivery_msg").html('<div class="alert alert-danger">'+obj.msg+'</div>');
                                    }else if(obj.action == "edit_success"){
                                        $(".edit_delivery_msg").html('<div class="alert alert-success">'+obj.msg+'</div>');
                                        // var redirect="{{url('my-account')}}";
                                        
                                         setTimeout(function(){ 
                                              window.location.reload();
                                         }, 2000);
                                    }else{
                                       $(".edit_delivery_msg").html("Something went wrong");
                                    }
                            }
                        });


            });
        });
 </script>

@endpush

@push("scripts")
  <script type="text/javascript">
      $(document).ready(function(){

              if($("body").find("select[name=billing_country]").val() == "England-UK"){
                  var obj = <?php echo $england_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";
                 var state =  $("body").find("select[name=billing_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else if($("body").find("select[name=billing_country]").val() == "Scotland-UK"){
                  var obj = <?php echo $scotland_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("body").find("select[name=billing_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else if($("body").find("select[name=billing_country]").val() == "Wales-UK"){
                  var obj = <?php echo $wales_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("body").find("select[name=billing_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else if($("body").find("select[name=billing_country]").val() == "Northern Ireland-UK"){
                  var obj = <?php echo $north_iralnad_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("body").find("select[name=billing_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else if($("body").find("select[name=billing_country]").val() == "Republic of Ireland"){
                  var obj = <?php echo $ireland_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("body").find("select[name=billing_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else{
                  var html = "<option value=''>Select Your County</option>";
                  $("body").find("select[name=billing_state]").html(html);
              }
          $("body").find("select[name=billing_country]").change(function(){
              if($(this).val() == "England-UK"){
                  var obj = <?php echo $england_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else if($(this).val() == "Scotland-UK"){
                  var obj = <?php echo $scotland_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else if($(this).val() == "Wales-UK"){
                  var obj = <?php echo $wales_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else if($(this).val() == "Northern Ireland-UK"){
                  var obj = <?php echo $north_iralnad_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else if($(this).val() == "Republic of Ireland"){
                  var obj = <?php echo $ireland_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=billing_state]").html(html);
              }else{
                  var html = "<option value=''>Select Your County</option>";
                 $("body").find("select[name=billing_state]").html(html);
              }
          });
      });

    $(document).ready(function(){

              if($("body").find("select[name=delivery_country]").val() == "England-UK"){
                  var obj = <?php echo $england_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";
                 var state =  $("body").find("select[name=delivery_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else if($("body").find("select[name=delivery_country]").val() == "Scotland-UK"){
                  var obj = <?php echo $scotland_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("body").find("select[name=delivery_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else if($("body").find("select[name=delivery_country]").val() == "Wales-UK"){
                  var obj = <?php echo $wales_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("body").find("select[name=delivery_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else if($("body").find("select[name=delivery_country]").val() == "Northern Ireland-UK"){
                  var obj = <?php echo $north_iralnad_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("body").find("select[name=delivery_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else if($("body").find("select[name=delivery_country]").val() == "Republic of Ireland"){
                  var obj = <?php echo $ireland_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  var state =  $("body").find("select[name=delivery_state]").attr("state");

                  for (var i = 0; i < obj.length; i++) {
                     if(obj[i] == state){
                        var select = "selected";
                     }else{
                        var select = "";
                     }
                      html += "<option value='"+obj[i]+"' "+select+">"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else{
                  var html = "<option value=''>Select Your County</option>";
                  $("body").find("select[name=delivery_state]").html(html);
              }
          $("body").find("select[name=delivery_country]").change(function(){
              if($(this).val() == "England-UK"){
                  var obj = <?php echo $england_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else if($(this).val() == "Scotland-UK"){
                  var obj = <?php echo $scotland_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else if($(this).val() == "Wales-UK"){
                  var obj = <?php echo $wales_uk_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else if($(this).val() == "Northern Ireland-UK"){
                  var obj = <?php echo $north_iralnad_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else if($(this).val() == "Republic of Ireland"){
                  var obj = <?php echo $ireland_state; ?>;
                  var html = "<option value=''>Select Your County</option>";

                  for (var i = 0; i < obj.length; i++) {
                      html += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                  }
                  $("body").find("select[name=delivery_state]").html(html);
              }else{
                  var html = "<option value=''>Select Your County</option>";
                 $("body").find("select[name=delivery_state]").html(html);
              }
          });
      });
    

  </script>
@endpush