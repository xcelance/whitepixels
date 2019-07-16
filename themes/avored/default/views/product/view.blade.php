@extends('layouts.app_new')

@section('meta_title')
    {{ $title }}
@endsection

@section('meta_description')
    {{ $description }}
@endsection

@section('breadcrumbs')
<div class="breadcrumb-block product_bread">
    <div class="container">
        <nav aria-label="breadcrumb">
        
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="product-timeline">
            <div class="container">
                <ol class="clearfix">
                    <li class="active">
                        <h6>Basket</h6>
                        <span class="timeline-number">1</span>
                    </li>    
                    <li>
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
        
        <section class="products-details-sec">
            <div class="container">
                <div class="">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-details-img product_image">
                                @include('product.view.product-image',['imageType' => 'url','extraImage' => true])
                            </div>
                        </div>
                        
                        <div class="col-md-9 align-self-center">
                            <div class="product-details-block">
                                <h4 class="product_name_top">{{ $product->name }}</h4>
                                <p class="product_description_top">{{$product->description}}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="product-details-form">
                                
                                <div class="product-select-box">
                                    <div class="select-head-name">
                                        <h4>Select Your Subcategory</h4>
                                    </div>
                                    <div class="product-select-list">
                                        <ul class="d-flex flex-wrap product">
                                            <?php $i = 0; ?>
                                            @foreach($get_relative as $value)
                                            <li class="d-flex @if($product->id == $value[0]->id) active @endif" product_id="{{$value[0]->id}}"><a href="javascript:void(0)">{{$value[0]->name}}</a></li>
                                            <?php $i++; ?>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="product-select-box get_material">
                                    
                                </div>

                                <div class="product-select-box get_side">
                                    
                                </div>

                                <div class="product-select-box get_orientation">
                                    
                                </div>

                                <div class="product-select-box get_finishing_type">
                                    
                                </div>

                                <div class="product-select-box get_printing_side">
                                    
                                </div>

                                <div class="product-select-box get_shape">
                                    
                                </div>

                                <div class="product-select-box get_sleeve_color">
                                    
                                </div>

                                <div class="product-select-box get_size">
                                    
                                </div>


                                <div class="product-select-box get_base">
                                    
                                </div>
                               
                                <div class="quantity_currency">
                                    <div class="product-select-box get_currency">
                                        @if(!Auth::user())
                                            <button class="ct-btn currency" currency=""></button>
                                        @endif 
                                    </div>
                                    <div class="product-select-box quantity_price">
                                        
                                    </div>
                                </div>  
                                 
                                
                                
                            </div>
                        </div>
 
                    </div>
                </div>
            </div>
        </section>
        <div id="process-bar" class="wait-progress-bar" style="display: none">
            <div class="process-bar-head">Please wait...</div>
              <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%"></div>
              </div>
        </div>
       <!--  <div class="spinner-border loader_reg" style="margin: 0 auto">
            <span class="sr-only">Loading...</span>
        </div> -->
        <div class="order_details_prev"></div>
        <div class="order_details" style="display: none">
	        <section class="products-order-details">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-6">
                            <div class="products-order-heading">
                                <h4>Order Details</h4>
                            </div>                           
	                        <div class="order-details-img">
	                             @include('product.view.product-image',['imageType' => 'url','extraImage' => true])
	                        </div>
	                        <div class="order-details-content">
	                            <ul class="">
	                                <li class="active_line">
	                                    <span class="order-left-content">Product</span>
	                                    <span class="order-right-content product_name"></span>
	                                </li>
	                                
	                                 <li class="active_line">
	                                    <span class="order-left-content">Paper</span>
	                                    <span class="order-right-content order_paper"></span>
	                                </li>
	                               
	                                 <li class="order_quantity">
	                                 </li>
	                                
	                                 <li class="order_side">
	                                 </li>
	                                 <li class="order_orientation">
	                                 </li>
	                                 
	                                 <li class="order_finishing_type">
	                                 </li>
	                                 <li class="order_printing_side">
	                                 </li>
	                                 <li class="order_shape">
	                                 </li>
	                                 <li class="order_sleeve_color">
	                                 </li>
	                                 <li class="order_size">
	                                 </li>
	                                 <li class="order_base">
	                                 </li>
	                                <li class="order_sort">
	                                </li>
	                                <li class="turnaround_li">
	                                    <span class="order-left-content">Turnaround Time
                                         <span class="under-line-span"><a href="{{url('faq#tat')}}" class="tat-work green-underline">How does TAT work?</a></span>
                                        </span>
	                                    <span class="order-right-content turnaround_time">
	                                    
	                                    </span>
	                                </li>
	                                
	                            </ul>
	                        </div>	 
	                    </div>
	                    
	                    <div class="col-md-6">
	                    	<div class="time-box">
                            <div class="row">
                                <div class="col s12">
                                    <div class="time-box-head">
                                        <img src="{{url('/public/vendor/avored-default/')}}/images/order-approve-icon.png"> <span class="inline-block vertical-align-middle">Order and approve within the next</span>
                                    </div>
                                    <div class="time-box-content">
                                        <div class="vertical-align-wrap">
                                                <div class="count-down">
                                                    <div class="count-down-row" id="countdown">
                                                        <div>
                                                    
                                                                <span class="hours count-down-value vertical-align-block vertical-align-middle">05</span>
                                                                <span class="count-down-label vertical-align-block vertical-align-middle">HRS</span>
                                                           
                                                        </div>
                                                        <div>
                                                           
                                                                <span class="minutes count-down-value vertical-align-block vertical-align-middle">33</span>
                                                                <span class="count-down-label vertical-align-block vertical-align-middle">MINS</span>
                                                       
                                                        </div>
                                                        <div>
                                                        
                                                                <span class="seconds count-down-value vertical-align-block vertical-align-middle">34</span>
                                                                <span class="count-down-label vertical-align-block vertical-align-middle">SECS</span>
                                                      
                                                        </div>
                                                    </div>
                                                </div>
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div id="ship_aroundajax">
                        <div class="row">
                            <div class="col s12">
                                <div class="time-box-head">
                                      <img src="{{url('/public/vendor/avored-default/')}}/images/order-dispatched-icon.png"> <span class="inline-block vertical-align-middle">Your order will be dispatched on</span>
                                </div>
                                <div class="time-box-content">
                                            <div class="time-box-content-text">
                                                <span class="dispatch"></span>
                                            </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="time-box-head">
                                      <img src="{{url('/public/vendor/avored-default/')}}/images/order-receive-icon.png"> <span class="inline-block vertical-align-middle">Receive your order on</span>
                                </div>
                                <div class="time-box-content">
                                            <div class="time-box-content-text">
                                                <span class="order_end"></span>
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
	        
	        
	        <div class="order-block">
	            <div class="container">
	                <div class="order-ck-box">
	                    
	                    <div class="order-btn-block">
	                        <a href="javascript:void(0)" class="ct-btn order_btn" vat="">Order Now</a>
	                        <a href="javascript:void(0)" class="ct-btn order_btn" vat="{{$product_configuration['vat']}}">Order with standard rate VAT</a>
	                    </div>
	                </div>
                    <p>NB: If you are a VAT registered customer in the ROI, please forward your VAT number to <span class="click"><a href="#" class="green-underline">accounts@quinnstheprinters.com </a></span></p>
	                <p class="click-here"><span class="click"><a href="#" class="green-underline">Click here to view the HMRC website</a></span></p>
	            </div>
	        </div>
	    </div>    
        
        <section class="booklet-sec long_description_div">
            <div class="container">
                <div class="popular-heading">
                    <h2 class="product_name_top">{{ $product->name }}</h2>
                </div>
                <div class="booklet-content long_description">
                </div>
            </div>
        </section>
<div class="screenloader" style="display: none">
<!-- show loader while fetching the price. -->
   <img src="{{url('public/vendor/avored-default/images/loader.gif')}}">
</div>

@endsection
@push('scripts')

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
    <script>
    Date.prototype.addDays = function(days) {
        this.setDate(this.getDate() + parseInt(days));
        return this;
    };              
        jQuery(document).ready(function () {

            ///////////////////// order button /////////////////////
            jQuery(document).on("click",".printing_sample",function(){
                var printing_sample_checkbox =  jQuery(".printing_sample_checkbox").prop("checked");
                if(printing_sample_checkbox == false){
                    var value = jQuery(".printing_sample_checkbox").val();
                    jQuery( ".get_tat_pr" ).each(function() {
                      var text = jQuery( this ).text();
                      var html = parseInt(text) + parseInt(value);
                          jQuery( this ).text(html);
                    });
                }else{
                    var value = jQuery(".printing_sample_checkbox").val();
                    jQuery( ".get_tat_pr" ).each(function() {
                      var text = jQuery( this ).text();
                      var html = parseInt(text) - parseInt(value);
                          jQuery( this ).text(html);
                    });

                }

            });
            jQuery(document).on("click",".sustainable_paper",function(){
                var sustainable_paper_checkbox =  jQuery(".sustainable_paper_checkbox").prop("checked");
                if(sustainable_paper_checkbox == false){
                    var value = jQuery(".sustainable_paper_checkbox").val();
                    jQuery( ".get_tat_pr" ).each(function() {
                      var text = jQuery( this ).text();
                      var html = parseInt(text) + parseInt(value);
                          jQuery( this ).text(html);
                    });
                }else{
                    var value = jQuery(".sustainable_paper_checkbox").val();
                    jQuery( ".get_tat_pr" ).each(function() {
                      var text = jQuery( this ).text();
                      var html = parseInt(text) - parseInt(value);
                          jQuery( this ).text(html);
                    });

                }

            });

            jQuery(document).on("click",".order_btn",function(){
                 var order_day = jQuery("body .turnaround_time").find("ul > li.active").attr("day");
                 var order_price = jQuery("body .turnaround_time").find("ul > li.active").attr("price");
                 var order_price_symbol = jQuery("body .turnaround_time").find("ul > li.active").attr("price_symbol");
                 var select_sort = jQuery("body").find(".sort").val();
                 var dispatch_date = jQuery(this).attr("dispatch_date");
                 var order_date = jQuery(this).attr("order_date");
                 var custom_field_id = jQuery(this).attr("custom_field_id");
                 var quantity = jQuery(this).attr("quantity");
                 var vat = jQuery(this).attr("vat");
                 var sustainable_paper_checkbox =  jQuery(".sustainable_paper_checkbox").prop("checked");
                if(sustainable_paper_checkbox == true){
                   sustainable_paper = jQuery(".sustainable_paper_checkbox").val();
                }else{
                   sustainable_paper = ""; 
                }
                var printing_sample_checkbox =  jQuery(".printing_sample_checkbox").prop("checked");
                if(printing_sample_checkbox == true){
                   printing_sample = jQuery(".printing_sample_checkbox").val();
                }else{
                   printing_sample = ""; 
                }

                var action = "{{url('send_order')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'post',
                url: action,
                data:{order_day:order_day,order_price:order_price,select_sort:select_sort,dispatch_date:dispatch_date,order_date:order_date,custom_field_id:custom_field_id,order_price_symbol:order_price_symbol,quantity:quantity,vat:vat,sustainable_paper:sustainable_paper,printing_sample:printing_sample},
                success: function(response) {
                    console.log(response);
                     var data = JSON.parse(response);
                      if(data.msg == "success"){
                        window.location.href = data.redirect;
                      }  
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });



            });
            ///////////// end order /////////////////////////////////
      
            jQuery(document).on("click",".product-select-price ul li",function(){
                jQuery("#process-bar").show();
                var start = new Date().getTime();
                var scrolTime = 1800;
                 jQuery('html, body').animate({
                 scrollTop: jQuery("#process-bar").offset().top - jQuery("#process-bar").height() - jQuery('.header-top').height() - 40
                  }, scrolTime);
                jQuery(".order_details").hide();
               // jQuery(".screenloader").show();
                jQuery(".printing_sample_checkbox").prop("checked",false);
                jQuery(".sustainable_paper_checkbox").prop("checked",false);

                var current_currency = localStorage.getItem("currency");

                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
                 
                var side_id = jQuery("body .get_side").find("ul > li.active").attr("id");

                var orientation_id = jQuery("body .get_orientation").find("ul > li.active").attr("id");

                var printing_side_id = jQuery("body .get_printing_side").find("ul > li.active").attr("id");

                var finishing_type_id = jQuery("body .get_finishing_type").find("ul > li.active").attr("id");
                
                var size_id = jQuery("body .get_size").find("ul > li.active").attr("id");
                var shape_id = jQuery("body .get_shape").find("ul > li.active").attr("id");
                var sleeve_color_id = jQuery("body .get_sleeve_color").find("ul > li.active").attr("id");

                var base_id = jQuery("body .get_base").find("ul > li.active").attr("id");

                var quantity = jQuery(this).find(".quantity-text").html();
                var quantity_id = jQuery(this).attr("quantity_id");
                if(!side_id){
                  side_id = "null";
                }
                if(!orientation_id){
                  orientation_id = "null";
                }
                if(!printing_side_id){
                  printing_side_id = "null";
                }
                if(!finishing_type_id){
                  finishing_type_id = "null";
                }
                if(!size_id){
                  size_id = "null";
                }
                if(!shape_id){
                  shape_id = "null";
                }
                if(!sleeve_color_id){
                  sleeve_color_id = "null";
                }
                if(!base_id){
                  base_id = "null";
                }
                // console.log(quantity);
                var currency_val = current_currency;   
                var action = "{{url('get_order_detail_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,printing_side_id:printing_side_id,finishing_type_id:finishing_type_id,size_id:size_id,shape_id:shape_id,sleeve_color_id:sleeve_color_id,base_id:base_id,quantity:quantity,quantity_id:quantity_id,currency:currency_val},
                success: function(response) {
                    console.log(response);
                      var data = JSON.parse(response);
                            
                        setTimeout(function(){ 
                            jQuery("#process-bar").hide();
                            jQuery(".screenloader").hide();
                            jQuery(".order_details").show();
                            //jQuery('body,html').animate({ scrollTop: jQuery('.order_details_prev').offset().top  }, 100);
                            if(data.product_data.category){
                              jQuery("body").find(".product_name").html(data.product_data.category+" - "+data.product_data.product);
                            }
                            if(data.product_data.material){
                              jQuery("body").find(".order_paper").html(data.product_data.material);
                            }
                            if(data.product_data.quantity){
                              jQuery("body").find(".order_quantity").html('<span class="order-left-content">Quantity</span><span class="order-right-content">'+data.product_data.quantity+'</span>');
                              jQuery("body").find(".order_btn").attr("quantity",data.product_data.quantity);
                              jQuery("body").find(".order_quantity").addClass("active_line");
                            }
                            if(data.product_data.side){
                              jQuery("body").find(".order_side").html('<span class="order-left-content">Sides</span><span class="order-right-content">'+data.product_data.side+'</span>');
                              jQuery("body").find(".order_side").addClass("active_line");
                            }
                            if(data.product_data.orientation){
                              jQuery("body").find(".order_orientation").html('<span class="order-left-content">Orientation</span><span class="order-right-content">'+data.product_data.orientation+'</span>');
                              jQuery("body").find(".order_orientation").addClass("active_line");
                            }
                            if(data.product_data.finishing_type){
                              jQuery("body").find(".order_finishing_type").html('<span class="order-left-content">Finish Type</span><span class="order-right-content">'+data.product_data.finishing_type+'</span>');
                              jQuery("body").find(".order_finishing_type").addClass("active_line");
                            }
                            if(data.product_data.finishing_type){
                              jQuery("body").find(".order_finishing_type").html('<span class="order-left-content">Finish Type</span><span class="order-right-content">'+data.product_data.finishing_type+'</span>');
                              jQuery("body").find(".order_finishing_type").addClass("active_line");
                            }
                            if(data.product_data.printing_side){
                              jQuery("body").find(".order_printing_side").html('<span class="order-left-content">Printing Side</span><span class="order-right-content">'+data.product_data.printing_side+'</span>');
                              jQuery("body").find(".order_printing_side").addClass("active_line");
                            }
                            if(data.product_data.shape){
                              jQuery("body").find(".order_shape").html('<span class="order-left-content">Shape</span><span class="order-right-content">'+data.product_data.shape+'</span>');
                              jQuery("body").find(".order_shape").addClass("active_line");
                            }
                            if(data.product_data.sleeve_color){
                              jQuery("body").find(".order_sleeve_color").html('<span class="order-left-content">Sleeve Color</span><span class="order-right-content">'+data.product_data.sleeve_color+'</span>');
                              jQuery("body").find(".order_sleeve_color").addClass("active_line");
                            }
                            if(data.product_data.size){
                              jQuery("body").find(".order_size").html('<span class="order-left-content">Size</span><span class="order-right-content">'+data.product_data.size+'</span>');
                              jQuery("body").find(".order_size").addClass("active_line");
                            }
                            if(data.product_data.base){
                              jQuery("body").find(".order_base").html('<span class="order-left-content">Base</span><span class="order-right-content">'+data.product_data.base+'</span>');
                              jQuery("body").find(".order_base").addClass("active_line");
                            }
                            if(data.product_data.field_id){
                                html = '<span class="order-left-content">Select Sort</span><span class="order-right-content"><select class="sort" field_id="'+data.product_data.field_id+'">';
                                for (var i = 1; i <= 10; i++) {
                                    html +='<option value="'+i+'">'+i+'</option>';
                                    
                                }
                                html += "</select></span>";
                              jQuery("body").find(".order_sort").html(html);
                              jQuery("body").find(".order_sort").addClass("active_line");
                              jQuery("body").find(".order_btn").attr("custom_field_id",data.product_data.field_id);
                              

                            }

                            
                            if(data.price){
                                var html = '<div class="product-select-list"><ul class="d-flex flex-wrap">';
                                for(i = 0;i < data.price.length;i++){
                                    if(i == 0){
                                        $checked = "checked";
                                        $active = "active";
                                    }else{
                                        $checked = "";
                                        $active = "";
                                    }
                                var price  = data.price[i].tat_price;  
                                   html +='<li class="d-flex '+$active+'" day="'+data.price[i].day+'" price="'+price+'" price_symbol="'+data.price[i].symbol+'"><a href="javascript:void(0)">'+data.price[i].day+' Days  @ '+data.price[i].symbol+'<p class="get_tat_pr">'+price+'</p></a></li>';
                                 /*html +='<div class="custom-control custom-radio"><input type="radio" id="customRadio'+i+'" name="customRadio" class="custom-control-input" '+$checked+' ><label class="custom-control-label" for="customRadio'+i+'">'+data.price[i].day+' Days  @ '+data.price[i].symbol+price+'</label></div>';*/

                                }

                                html +="</ul></div>";
                                jQuery("body").find(".turnaround_time").html(html);
                                 ////////////////////// get Dispatched order ////////
                                   var dispatch = new Date();
                                   var dispatch_current_day = jQuery("body .turnaround_time").find("ul > li.active").attr("day") - 1;
                                   
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
                                    ////////////////////// get order end ////////
                                   var order_end = new Date();
                                   var order_current_day = jQuery("body .turnaround_time").find("ul > li.active").attr("day");
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
                                        
                            }
                                                

                        }, 3000);
                        
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });
            

            });


           //////////////////////////////// order sort //////////////////

            jQuery(document).on("change",".sort",function(){
                jQuery(".screenloader").show();
                jQuery(".printing_sample_checkbox").prop("checked",false);
                jQuery(".sustainable_paper_checkbox").prop("checked",false);
                var current_currency = localStorage.getItem("currency");
               
                
                var field_id = jQuery(this).attr("field_id");
                var sort = jQuery(this).val();

                var currency_val = current_currency;   
                var action = "{{url('get_sort_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{field_id:field_id,sort:sort,currency:currency_val},
                success: function(response) {
                    console.log(response);
                      var data = JSON.parse(response);
                        setTimeout(function(){ 
                            jQuery(".screenloader").hide();
                            
                            jQuery("body").find(".order_btn").attr("quantity",data.quantity);
                            
                            if(data.price){
                                var html = '<div class="product-select-list"><ul class="d-flex flex-wrap">';
                                for(i = 0;i < data.price.length;i++){
                                    if(i == 0){
                                        $checked = "checked";
                                        $active = "active";
                                    }else{
                                        $checked = "";
                                        $active = "";
                                    }
                                var price  = parseInt(data.price[i].sort) * parseInt(data.price[i].tat_price);  
                                   html +='<li class="d-flex '+$active+'" day="'+data.price[i].day+'" price="'+price+'" price_symbol="'+data.price[i].symbol+'"><a href="javascript:void(0)">'+data.price[i].day+' Days  @ '+data.price[i].symbol+'<p class="get_tat_pr">'+price+'</p></a></li>';
                                 /*html +='<div class="custom-control custom-radio"><input type="radio" id="customRadio'+i+'" name="customRadio" class="custom-control-input" '+$checked+' ><label class="custom-control-label" for="customRadio'+i+'">'+data.price[i].day+' Days  @ '+data.price[i].symbol+price+'</label></div>';*/

                                }
                                html +="</ul></div>";
                                jQuery("body").find(".turnaround_time").html(html);
                                ////////////////////// get Dispatched order ////////
                                   var dispatch = new Date();
                                   var dispatch_current_day = jQuery("body .turnaround_time").find("ul > li.active").attr("day") - 1;
                                   
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
                                    ////////////////////// get order end ////////
                                   var order_end = new Date();
                                   var order_current_day = jQuery("body .turnaround_time").find("ul > li.active").attr("day");
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

                               
                            }
                            
                            

                    }, 3000);
                        
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });
            

            });
        });

    </script>
@endpush
@push('scripts')
    <script>

            
        jQuery(document).ready(function () {
              

             ////////////////////// ///////////////////
                jQuery(document).on('click', '.turnaround_time li', function (e) {
                    jQuery( ".turnaround_time li" ).each(function() {
                      jQuery( this ).removeClass( "active" );
                    });
                   
                    jQuery(this).addClass("active");
                                ////////////////////// get Dispatched order ////////
                                   var dispatch = new Date();
                                   var dispatch_current_day = jQuery("body .turnaround_time").find("ul > li.active").attr("day") - 1;
                                   if(dispatch_current_day == 0){
                                    dispatch_current_day = 1;
                                   }
                                   
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
                                    ////////////////////// get order end ////////
                                   var order_end = new Date();
                                   var order_current_day = jQuery("body .turnaround_time").find("ul > li.active").attr("day");
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


                });    

            /////////////////////////
            jQuery(".screenloader").show();
            
            var current_currency = localStorage.getItem("currency");
            if(current_currency == null){
                 localStorage.setItem("currency",'pound');
                 jQuery(".currency").attr("currency", "euro");
                 jQuery(".currency").text("View in €");
            }else{

                if(current_currency == "pound"){
                  jQuery(".currency").attr("currency", "euro");                  
                  jQuery(".currency").text("View in €");
                }else{
                  jQuery(".currency").attr("currency", "pound");	
                  jQuery(".currency").text("View in £");                  
                }
            }

            var currency_val = localStorage.getItem("currency");
            var product_id = jQuery("body").find(".product > li.active").attr("product_id");
                 
                var action = "{{url('get_custom_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,currency:currency_val},
                success: function(response) {
                       jQuery(".screenloader").hide();

                       var data = JSON.parse(response);
                       console.log(data);
                        if(data.product_long_description){

                            
                            jQuery(".long_description").html(data.product_long_description);
                        }
                        if(data.material){
                            if(data.material_note){
                                var material_note = "["+data.material_note+"]";
                            }else{
                                var material_note = "";
                            }   
                            $material = '<div class="select-head-name"><h4>Select Your Material '+material_note+'</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.material.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $material += '<li class="d-flex '+active+'" id="'+data.material[i].id+'"><a href="javascript:void(0)">'+data.material[i].name+'</a></li>';
                            }
                            $material += '</ul></div>';
                            jQuery(".get_material").append($material);
                        }
                        if(data.side){
                            $side = '<div class="select-head-name"><h4>Select Your Side</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.side.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $side += '<li class="d-flex '+active+'" id="'+data.side[i].id+'"><a href="javascript:void(0)">'+data.side[i].name+'</a></li>';
                            }
                            $side += '</ul></div>';
                            jQuery(".get_side").append($side);
                        }
                        if(data.orientation){
                            $orientation = '<div class="select-head-name"><h4>Select Your Orientation</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap orientation_div">';
                            for(i=0;i<data.orientation.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $orientation += '<li class="d-flex '+active+'" id="'+data.orientation[i].id+'"><img src="{{url('')}}'+data.orientation[i].image+'" width="100px" height="100px" /> <a href="javascript:void(0)">'+data.orientation[i].name+'</a></li>';
                            }
                            $orientation += '</ul></div>';
                            jQuery(".get_orientation").append($orientation);
                        }
                        if(data.printing_side){
                            $printing_side = '<div class="select-head-name"><h4>Select Your Printing side</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.printing_side.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $printing_side += '<li class="d-flex '+active+'" id="'+data.printing_side[i].id+'"><a href="javascript:void(0)">'+data.printing_side[i].name+'</a></li>';
                            }
                            $printing_side += '</ul></div>';
                            jQuery(".get_printing_side").append($printing_side);
                        }
                        if(data.finishing_type){
                            $finishing_type = '<div class="select-head-name"><h4>Select Your Finishing Type</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.finishing_type.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $finishing_type += '<li class="d-flex '+active+'" id="'+data.finishing_type[i].id+'"><a href="javascript:void(0)">'+data.finishing_type[i].name+'</a></li>';
                            }
                            $finishing_type += '</ul></div>';
                            jQuery(".get_finishing_type").append($finishing_type);
                        }
                        if(data.size){
                            $size = '<div class="select-head-name"><h4>Select Your Size </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.size.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $size += '<li class="d-flex '+active+'" id="'+data.size[i].id+'"><a href="javascript:void(0)" >'+data.size[i].name+'</a></li>';
                            }
                            $size += '</ul></div>';
                            jQuery(".get_size").append($size);
                        }
                        if(data.shape){
                            $shape = '<div class="select-head-name"><h4>Select Your Shape </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.shape.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $shape += '<li class="d-flex '+active+'" id="'+data.shape[i].id+'"><a href="javascript:void(0)">'+data.shape[i].name+'</a></li>';
                            }
                            $shape += '</ul></div>';
                            jQuery(".get_shape").append($shape);
                        }
                        if(data.sleeve_color){
                            $sleeve_color = '<div class="select-head-name"><h4>Select Your Sleeve Color </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.sleeve_color.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $sleeve_color += '<li class="d-flex '+active+'" id="'+data.sleeve_color[i].id+'"><a href="javascript:void(0)" >'+data.sleeve_color[i].name+'</a></li>';
                            }
                            $sleeve_color += '</ul></div>';
                            jQuery(".get_sleeve_color").append($sleeve_color);
                        }
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        setTimeout(function(){
			            	var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
				            if(!material_id){
				            	jQuery(".get_currency").hide();
				            }else{
				            	jQuery(".get_currency").show();
				            }
			            }, 200);
                        
                    }
                });

            //////////////////////////////////////////////////////////////

        jQuery(document).on("click",".currency",function(){
            jQuery(".order_details").hide();
        	jQuery(".screenloader").show();
               var currency = jQuery(this).attr("currency");
                if(currency == "pound"){
                  jQuery(".currency").attr("currency", "euro");
                  jQuery(".currency").text("View in €");
                  localStorage.setItem("currency",'pound');
                }else{
                  jQuery(".currency").attr("currency", "pound");	
                  jQuery(".currency").text("View in £");
                  localStorage.setItem("currency",'euro');
                }

            var current_currency = localStorage.getItem("currency");

                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
                 
                var side_id = jQuery("body .get_side").find("ul > li.active").attr("id");

                var orientation_id = jQuery("body .get_orientation").find("ul > li.active").attr("id");

                var printing_side_id = jQuery("body .get_printing_side").find("ul > li.active").attr("id");

                var finishing_type_id = jQuery("body .get_finishing_type").find("ul > li.active").attr("id");
                
                var size_id = jQuery("body .get_size").find("ul > li.active").attr("id");
                var shape_id = jQuery("body .get_shape").find("ul > li.active").attr("id");
                var sleeve_color_id = jQuery("body .get_sleeve_color").find("ul > li.active").attr("id");
                var base_id = jQuery("body .get_base").find("ul > li.active").attr("id");

                if(!side_id){
                  side_id = "null";
                }
                if(!orientation_id){
                  orientation_id = "null";
                }
                if(!printing_side_id){
                  printing_side_id = "null";
                }
                if(!finishing_type_id){
                  finishing_type_id = "null";
                }
                if(!size_id){
                  size_id = "null";
                }
                if(!shape_id){
                  shape_id = "null";
                }
                if(!sleeve_color_id){
                  sleeve_color_id = "null";
                }
                if(!base_id){
                  base_id = "null";
                }
                jQuery(".quantity_price").html("");
                var currency_val = current_currency;   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,printing_side_id:printing_side_id,finishing_type_id:finishing_type_id,size_id:size_id,shape_id:shape_id,sleeve_color_id:sleeve_color_id,base_id:base_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                        setTimeout(function(){ jQuery(".screenloader").hide(); }, 500); 

                        if(data.printing_sample_price){
                           jQuery(".printing_sample_checkbox").val(data.printing_sample_price);
                           jQuery(".printing_sample").html('Send 6 printed samples to my billing address @ '+data.printing_sample_price_symbol+' '+data.printing_sample_price+'.00'); 

                        }
                        if(data.sustainable_paper_price){
                           jQuery(".sustainable_paper_checkbox").val(data.sustainable_paper_price); 

                        }


                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });
            
                
        	});


            ///////////////////////////////////////////////////////

           

            

        });
        jQuery(document).ready(function () {
            jQuery(document).on('click', '.product li', function (e) {
            jQuery(".order_details").hide();    
            jQuery(".order_details").hide();
            jQuery(".screenloader").show();

            jQuery( ".product li" ).each(function() {
              jQuery( this ).removeClass( "active" );
            });
           
            setTimeout(function(){
            	var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
	            if(!material_id){
	            	jQuery(".get_currency").hide();
	            }else{
	            	jQuery(".get_currency").show();
	            }
            }, 200);
            
            jQuery(this).addClass("active");
            var product_id = jQuery(this).attr("product_id");
            var current_currency = localStorage.getItem("currency");
            
                jQuery(".get_material").html("");
                jQuery(".get_side").html("");
                jQuery(".get_orientation").html("");
                jQuery(".get_printing_side").html("");
                jQuery(".get_finishing_type").html("");
                jQuery(".get_size").html("");
                jQuery(".get_shape").html("");
                jQuery(".get_sleeve_color").html("");
                jQuery(".get_base").html("");
                jQuery(".quantity_price").html("");

            var currency_val = current_currency;
                   
                var action = "{{url('get_custom_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                       console.log(data);
                       setTimeout(function(){ jQuery(".screenloader").hide(); }, 500);
                        jQuery(".product_name_top").html(data.product_name);
                        jQuery(".product_description_top").html(data.product_description);
                        jQuery(".product_image").html('<img alt="'+data.product_name+'" style="max-height: 300px;" class="card-img-top img-fluid" src="{{url('')}}/storage/app/public/'+data.product_image+'">');
                        if(data.product_long_description){
                            jQuery(".long_description").html(data.product_long_description);
                        }else{
                            jQuery(".long_description").html("");
                        }
                        if(data.material){
                            if(data.material_note){
                                var material_note = "["+data.material_note+"]";
                            }else{
                                var material_note = "";
                            }   
                            $material = '<div class="select-head-name"><h4>Select Your Material '+material_note+'</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.material.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $material += '<li class="d-flex '+active+'" id="'+data.material[i].id+'"><a href="javascript:void(0)">'+data.material[i].name+'</a></li>';
                            }
                            $material += '</ul></div>';
                            jQuery(".get_material").append($material);
                        }
                        if(data.side){
                            $side = '<div class="select-head-name"><h4>Select Your Side</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.side.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $side += '<li class="d-flex '+active+'" id="'+data.side[i].id+'"><a href="javascript:void(0)">'+data.side[i].name+'</a></li>';
                            }
                            $side += '</ul></div>';
                            jQuery(".get_side").append($side);
                        }
                        if(data.orientation){
                            $orientation = '<div class="select-head-name"><h4>Select Your Orientation</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap orientation_div">';
                            for(i=0;i<data.orientation.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $orientation += '<li class="d-flex '+active+'" id="'+data.orientation[i].id+'"><img src="{{url('')}}'+data.orientation[i].image+'" width="100px" height="100px" /><a href="javascript:void(0)">'+data.orientation[i].name+'</a></li>';
                            }
                            $orientation += '</ul></div>';
                            jQuery(".get_orientation").append($orientation);
                        }
                        if(data.printing_side){
                            $printing_side = '<div class="select-head-name"><h4>Select Your Printing side</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.printing_side.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $printing_side += '<li class="d-flex '+active+'" id="'+data.printing_side[i].id+'"><a href="javascript:void(0)">'+data.printing_side[i].name+'</a></li>';
                            }
                            $printing_side += '</ul></div>';
                            jQuery(".get_printing_side").append($printing_side);
                        }
                        if(data.finishing_type){
                            $finishing_type = '<div class="select-head-name"><h4>Select Your Finishing Type</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.finishing_type.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $finishing_type += '<li class="d-flex '+active+'" id="'+data.finishing_type[i].id+'"><a href="javascript:void(0)">'+data.finishing_type[i].name+'</a></li>';
                            }
                            $finishing_type += '</ul></div>';
                            jQuery(".get_finishing_type").append($finishing_type);
                        }
                        if(data.size){
                            $size = '<div class="select-head-name"><h4>Select Your Size </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.size.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $size += '<li class="d-flex '+active+'" id="'+data.size[i].id+'"><a href="javascript:void(0)" >'+data.size[i].name+'</a></li>';
                            }
                            $size += '</ul></div>';
                            jQuery(".get_size").append($size);
                        }
                        if(data.shape){
                            $shape = '<div class="select-head-name"><h4>Select Your Shape </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.shape.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $shape += '<li class="d-flex '+active+'" id="'+data.shape[i].id+'"><a href="javascript:void(0)">'+data.shape[i].name+'</a></li>';
                            }
                            $shape += '</ul></div>';
                            jQuery(".get_shape").append($shape);
                        }
                        if(data.sleeve_color){
                            $sleeve_color = '<div class="select-head-name"><h4>Select Your Sleeve Color </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.sleeve_color.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $sleeve_color += '<li class="d-flex '+active+'" id="'+data.sleeve_color[i].id+'"><a href="javascript:void(0)" >'+data.sleeve_color[i].name+'</a></li>';
                            }
                            $sleeve_color += '</ul></div>';
                            jQuery(".get_sleeve_color").append($sleeve_color);
                        }
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });
            ////////////////////////////////////////

            jQuery(document).on('click', '.get_material li', function (e) {
              jQuery(".order_details").hide();  
              jQuery(".screenloader").show();
                jQuery( ".get_material li" ).each(function() {
                  jQuery( this ).removeClass( "active" );
                });
            jQuery(this).addClass("active");
            var product_id = jQuery("body").find(".product > li.active").attr("product_id");
            var material_id = jQuery(this).attr("id");
            var current_currency = localStorage.getItem("currency");
            var currency_val = current_currency;
                jQuery(".get_side").html("");
                jQuery(".get_orientation").html("");
                jQuery(".get_printing_side").html("");
                jQuery(".get_finishing_type").html("");
                jQuery(".get_size").html("");
                jQuery(".get_shape").html("");
                jQuery(".get_sleeve_color").html("");
                jQuery(".get_base").html("");
                jQuery(".quantity_price").html("");
                   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                       console.log(data);
                       setTimeout(function(){ jQuery(".screenloader").hide(); }, 500);
                        if(data.side){
                            $side = '<div class="select-head-name"><h4>Select Your Side</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.side.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $side += '<li class="d-flex '+active+'" id="'+data.side[i].id+'"><a href="javascript:void(0)">'+data.side[i].name+'</a></li>';
                            }
                            $side += '</ul></div>';
                            jQuery(".get_side").append($side);
                        }
                        if(data.orientation){
                            $orientation = '<div class="select-head-name"><h4>Select Your Orientation</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap orientation_div">';
                            for(i=0;i<data.orientation.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $orientation += '<li class="d-flex '+active+'" id="'+data.orientation[i].id+'"><img src="{{url('')}}'+data.orientation[i].image+'" width="100px" height="100px" /><a href="javascript:void(0)">'+data.orientation[i].name+'</a></li>';
                            }
                            $orientation += '</ul></div>';
                            jQuery(".get_orientation").append($orientation);
                        }
                        if(data.printing_side){
                            $printing_side = '<div class="select-head-name"><h4>Select Your Printing side</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.printing_side.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $printing_side += '<li class="d-flex '+active+'" id="'+data.printing_side[i].id+'"><a href="javascript:void(0)">'+data.printing_side[i].name+'</a></li>';
                            }
                            $printing_side += '</ul></div>';
                            jQuery(".get_printing_side").append($printing_side);
                        }
                        if(data.finishing_type){
                            $finishing_type = '<div class="select-head-name"><h4>Select Your Finishing Type</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.finishing_type.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $finishing_type += '<li class="d-flex '+active+'" id="'+data.finishing_type[i].id+'"><a href="javascript:void(0)">'+data.finishing_type[i].name+'</a></li>';
                            }
                            $finishing_type += '</ul></div>';
                            jQuery(".get_finishing_type").append($finishing_type);
                        }
                        if(data.size){
                            $size = '<div class="select-head-name"><h4>Select Your Size </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.size.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $size += '<li class="d-flex '+active+'" id="'+data.size[i].id+'"><a href="javascript:void(0)" >'+data.size[i].name+'</a></li>';
                            }
                            $size += '</ul></div>';
                            jQuery(".get_size").append($size);
                        }
                        if(data.shape){
                            $shape = '<div class="select-head-name"><h4>Select Your Shape </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.shape.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $shape += '<li class="d-flex '+active+'" id="'+data.shape[i].id+'"><a href="javascript:void(0)">'+data.shape[i].name+'</a></li>';
                            }
                            $shape += '</ul></div>';
                            jQuery(".get_shape").append($shape);
                        }
                        if(data.sleeve_color){
                            $sleeve_color = '<div class="select-head-name"><h4>Select Your Sleeve Color </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.sleeve_color.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $sleeve_color += '<li class="d-flex '+active+'" id="'+data.sleeve_color[i].id+'"><a href="javascript:void(0)" >'+data.sleeve_color[i].name+'</a></li>';
                            }
                            $sleeve_color += '</ul></div>';
                            jQuery(".get_sleeve_color").append($sleeve_color);
                        }
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });
            //////////////////////////////////////////////////////////////

            jQuery(document).on('click', '.get_side li', function (e) {
                jQuery(".order_details").hide();

            	jQuery(".screenloader").show();
                jQuery( ".get_side li" ).each(function() {
                  jQuery( this ).removeClass( "active" );
                });
                jQuery(this).addClass("active");
                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");

                var side_id = jQuery(this).attr("id");

                    jQuery(".get_orientation").html("");
                    jQuery(".get_printing_side").html("");
                    jQuery(".get_finishing_type").html("");
                    jQuery(".get_size").html("");
                    jQuery(".get_shape").html("");
                    jQuery(".get_sleeve_color").html("");
                    jQuery(".get_base").html("");
                    jQuery(".quantity_price").html("");
                var current_currency = localStorage.getItem("currency");
                var currency_val = current_currency;   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                       console.log(data);
                       setTimeout(function(){ jQuery(".screenloader").hide(); }, 500); 
                        if(data.orientation){
                            $orientation = '<div class="select-head-name"><h4>Select Your Orientation</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap orientation_div">';
                            for(i=0;i<data.orientation.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $orientation += '<li class="d-flex '+active+'" id="'+data.orientation[i].id+'"><img src="{{url('')}}'+data.orientation[i].image+'" width="100px" height="100px" /><a href="javascript:void(0)">'+data.orientation[i].name+'</a></li>';
                            }
                            $orientation += '</ul></div>';
                            jQuery(".get_orientation").append($orientation);
                        }
                        if(data.printing_side){
                            $printing_side = '<div class="select-head-name"><h4>Select Your Printing side</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.printing_side.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $printing_side += '<li class="d-flex '+active+'" id="'+data.printing_side[i].id+'"><a href="javascript:void(0)">'+data.printing_side[i].name+'</a></li>';
                            }
                            $printing_side += '</ul></div>';
                            jQuery(".get_printing_side").append($printing_side);
                        }
                        if(data.finishing_type){
                            $finishing_type = '<div class="select-head-name"><h4>Select Your Finishing Type</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.finishing_type.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $finishing_type += '<li class="d-flex '+active+'" id="'+data.finishing_type[i].id+'"><a href="javascript:void(0)">'+data.finishing_type[i].name+'</a></li>';
                            }
                            $finishing_type += '</ul></div>';
                            jQuery(".get_finishing_type").append($finishing_type);
                        }
                        if(data.size){
                            $size = '<div class="select-head-name"><h4>Select Your Size </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.size.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $size += '<li class="d-flex '+active+'" id="'+data.size[i].id+'"><a href="javascript:void(0)" >'+data.size[i].name+'</a></li>';
                            }
                            $size += '</ul></div>';
                            jQuery(".get_size").append($size);
                        }
                        if(data.shape){
                            $shape = '<div class="select-head-name"><h4>Select Your Shape </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.shape.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $shape += '<li class="d-flex '+active+'" id="'+data.shape[i].id+'"><a href="javascript:void(0)">'+data.shape[i].name+'</a></li>';
                            }
                            $shape += '</ul></div>';
                            jQuery(".get_shape").append($shape);
                        }
                        if(data.sleeve_color){
                            $sleeve_color = '<div class="select-head-name"><h4>Select Your Sleeve Color </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.sleeve_color.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $sleeve_color += '<li class="d-flex '+active+'" id="'+data.sleeve_color[i].id+'"><a href="javascript:void(0)" >'+data.sleeve_color[i].name+'</a></li>';
                            }
                            $sleeve_color += '</ul></div>';
                            jQuery(".get_sleeve_color").append($sleeve_color);
                        }
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });
            //////////////////////////////////////////////////////////////

            jQuery(document).on('click', '.get_orientation li', function (e) {
                jQuery(".order_details").hide();

            	jQuery(".screenloader").show();
              jQuery( ".get_orientation li" ).each(function() {
                  jQuery( this ).removeClass( "active" );
                });
                jQuery(this).addClass("active");
                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
                 
                var side_id = jQuery("body .get_side").find("ul > li.active").attr("id");

                if(!side_id){
                  side_id = "null";
                }
                var orientation_id = jQuery(this).attr("id");

                    jQuery(".get_printing_side").html("");
                    jQuery(".get_finishing_type").html("");
                    jQuery(".get_size").html("");
                    jQuery(".get_shape").html("");
                    jQuery(".get_sleeve_color").html("");
                    jQuery(".get_base").html("");
                    jQuery(".quantity_price").html("");
                var current_currency = localStorage.getItem("currency");
                var currency_val = current_currency;   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                       console.log(data);
                       setTimeout(function(){ jQuery(".screenloader").hide(); }, 500); 
                        if(data.printing_side){
                            $printing_side = '<div class="select-head-name"><h4>Select Your Printing side</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.printing_side.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $printing_side += '<li class="d-flex '+active+'" id="'+data.printing_side[i].id+'"><a href="javascript:void(0)">'+data.printing_side[i].name+'</a></li>';
                            }
                            $printing_side += '</ul></div>';
                            jQuery(".get_printing_side").append($printing_side);
                        }
                        if(data.finishing_type){
                            $finishing_type = '<div class="select-head-name"><h4>Select Your Finishing Type</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.finishing_type.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $finishing_type += '<li class="d-flex '+active+'" id="'+data.finishing_type[i].id+'"><a href="javascript:void(0)">'+data.finishing_type[i].name+'</a></li>';
                            }
                            $finishing_type += '</ul></div>';
                            jQuery(".get_finishing_type").append($finishing_type);
                        }
                        if(data.size){
                            $size = '<div class="select-head-name"><h4>Select Your Size </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.size.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $size += '<li class="d-flex '+active+'" id="'+data.size[i].id+'"><a href="javascript:void(0)" >'+data.size[i].name+'</a></li>';
                            }
                            $size += '</ul></div>';
                            jQuery(".get_size").append($size);
                        }
                        if(data.shape){
                            $shape = '<div class="select-head-name"><h4>Select Your Shape </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.shape.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $shape += '<li class="d-flex '+active+'" id="'+data.shape[i].id+'"><a href="javascript:void(0)">'+data.shape[i].name+'</a></li>';
                            }
                            $shape += '</ul></div>';
                            jQuery(".get_shape").append($shape);
                        }
                        if(data.sleeve_color){
                            $sleeve_color = '<div class="select-head-name"><h4>Select Your Sleeve Color </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.sleeve_color.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $sleeve_color += '<li class="d-flex '+active+'" id="'+data.sleeve_color[i].id+'"><a href="javascript:void(0)" >'+data.sleeve_color[i].name+'</a></li>';
                            }
                            $sleeve_color += '</ul></div>';
                            jQuery(".get_sleeve_color").append($sleeve_color);
                        }
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });

             //////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////

            jQuery(document).on('click', '.get_finishing_type li', function (e) {
                jQuery(".order_details").hide();

            	jQuery(".screenloader").show();
              jQuery( ".get_finishing_type li" ).each(function() {
                  jQuery( this ).removeClass( "active" );
                });
                jQuery(this).addClass("active");
                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
                 
                var side_id = jQuery("body .get_side").find("ul > li.active").attr("id");

                var orientation_id = jQuery("body .get_orientation").find("ul > li.active").attr("id");


                if(!side_id){
                  side_id = "null";
                }
                if(!orientation_id){
                  orientation_id = "null";
                }
                var finishing_type_id = jQuery(this).attr("id");

                    jQuery(".get_printing_side").html("");
                    jQuery(".get_size").html("");
                    jQuery(".get_shape").html("");
                    jQuery(".get_sleeve_color").html("");
                    jQuery(".get_base").html("");
                    jQuery(".quantity_price").html("");
                var current_currency = localStorage.getItem("currency");
                var currency_val = current_currency;   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,finishing_type_id:finishing_type_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                       console.log(data);
                       setTimeout(function(){ jQuery(".screenloader").hide(); }, 500);  
                        
                        if(data.printing_side){
                            $printing_side = '<div class="select-head-name"><h4>Select Your Printing side</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.printing_side.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $printing_side += '<li class="d-flex '+active+'" id="'+data.printing_side[i].id+'"><a href="javascript:void(0)">'+data.printing_side[i].name+'</a></li>';
                            }
                            $printing_side += '</ul></div>';
                            jQuery(".get_printing_side").append($printing_side);
                        }
                        if(data.size){
                            $size = '<div class="select-head-name"><h4>Select Your Size </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.size.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $size += '<li class="d-flex '+active+'" id="'+data.size[i].id+'"><a href="javascript:void(0)" >'+data.size[i].name+'</a></li>';
                            }
                            $size += '</ul></div>';
                            jQuery(".get_size").append($size);
                        }
                        if(data.shape){
                            $shape = '<div class="select-head-name"><h4>Select Your Shape </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.shape.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $shape += '<li class="d-flex '+active+'" id="'+data.shape[i].id+'"><a href="javascript:void(0)">'+data.shape[i].name+'</a></li>';
                            }
                            $shape += '</ul></div>';
                            jQuery(".get_shape").append($shape);
                        }
                        if(data.sleeve_color){
                            $sleeve_color = '<div class="select-head-name"><h4>Select Your Sleeve Color </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.sleeve_color.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $sleeve_color += '<li class="d-flex '+active+'" id="'+data.sleeve_color[i].id+'"><a href="javascript:void(0)" >'+data.sleeve_color[i].name+'</a></li>';
                            }
                            $sleeve_color += '</ul></div>';
                            jQuery(".get_sleeve_color").append($sleeve_color);
                        }
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });

             ////////////////////////////////////////////////////////////// 
             //////////////////////////////////////////////////////////////

            jQuery(document).on('click', '.get_printing_side li', function (e) {
                jQuery(".order_details").hide();

            	jQuery(".screenloader").show();
                jQuery( ".get_printing_side li" ).each(function() {
                  jQuery( this ).removeClass( "active" );
                });
                jQuery(this).addClass("active");
                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
                 
                var side_id = jQuery("body .get_side").find("ul > li.active").attr("id");

                var orientation_id = jQuery("body .get_orientation").find("ul > li.active").attr("id");
                var finishing_type_id = jQuery("body .get_finishing_type").find("ul > li.active").attr("id");

                if(!side_id){
                  side_id = "null";
                }
                if(!orientation_id){
                  orientation_id = "null";
                }
                if(!finishing_type_id){
                  finishing_type_id = "null";
                }
                var printing_side_id = jQuery(this).attr("id");

                    jQuery(".get_size").html("");
                    jQuery(".get_shape").html("");
                    jQuery(".get_sleeve_color").html("");
                    jQuery(".get_base").html("");
                    jQuery(".quantity_price").html("");
                var current_currency = localStorage.getItem("currency");
                var currency_val = current_currency;   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,finishing_type_id:finishing_type_id,printing_side_id:printing_side_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                       console.log(data);
                        setTimeout(function(){ jQuery(".screenloader").hide(); }, 500); 
                        if(data.finishing_type){
                            $finishing_type = '<div class="select-head-name"><h4>Select Your Finishing Type</h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.finishing_type.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $finishing_type += '<li class="d-flex '+active+'" id="'+data.finishing_type[i].id+'"><a href="javascript:void(0)">'+data.finishing_type[i].name+'</a></li>';
                            }
                            $finishing_type += '</ul></div>';
                            jQuery(".get_finishing_type").append($finishing_type);
                        }
                        if(data.size){
                            $size = '<div class="select-head-name"><h4>Select Your Size </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.size.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $size += '<li class="d-flex '+active+'" id="'+data.size[i].id+'"><a href="javascript:void(0)" >'+data.size[i].name+'</a></li>';
                            }
                            $size += '</ul></div>';
                            jQuery(".get_size").append($size);
                        }
                        if(data.shape){
                            $shape = '<div class="select-head-name"><h4>Select Your Shape </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.shape.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $shape += '<li class="d-flex '+active+'" id="'+data.shape[i].id+'"><a href="javascript:void(0)">'+data.shape[i].name+'</a></li>';
                            }
                            $shape += '</ul></div>';
                            jQuery(".get_shape").append($shape);
                        }
                        if(data.sleeve_color){
                            $sleeve_color = '<div class="select-head-name"><h4>Select Your Sleeve Color </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.sleeve_color.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $sleeve_color += '<li class="d-flex '+active+'" id="'+data.sleeve_color[i].id+'"><a href="javascript:void(0)" >'+data.sleeve_color[i].name+'</a></li>';
                            }
                            $sleeve_color += '</ul></div>';
                            jQuery(".get_sleeve_color").append($sleeve_color);
                        }
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });

             //////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////

            jQuery(document).on('click', '.get_shape li', function (e) {
              jQuery(".order_details").hide();
            	jQuery(".screenloader").show();
              jQuery( ".get_shape li" ).each(function() {
                  jQuery( this ).removeClass( "active" );
                });
                jQuery(this).addClass("active");
                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
                 
                var side_id = jQuery("body .get_side").find("ul > li.active").attr("id");

                var orientation_id = jQuery("body .get_orientation").find("ul > li.active").attr("id");

                var printing_side_id = jQuery("body .get_printing_side").find("ul > li.active").attr("id");

                var finishing_type_id = jQuery("body .get_finishing_type").find("ul > li.active").attr("id");
                
               
                if(!side_id){
                  side_id = "null";
                }
                if(!orientation_id){
                  orientation_id = "null";
                }
                if(!printing_side_id){
                  printing_side_id = "null";
                }
                if(!finishing_type_id){
                  finishing_type_id = "null";
                }

                var shape_id = jQuery(this).attr("id");

                    jQuery(".get_size").html("");
                    jQuery(".get_sleeve_color").html("");
                    jQuery(".get_base").html("");
                var current_currency = localStorage.getItem("currency");
                var currency_val = current_currency;   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,printing_side_id:printing_side_id,finishing_type_id:finishing_type_id,shape_id:shape_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                        setTimeout(function(){ jQuery(".screenloader").hide(); }, 500); 
                        
                        if(data.size){
                            $size = '<div class="select-head-name"><h4>Select Your Size </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.size.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $size += '<li class="d-flex '+active+'" id="'+data.size[i].id+'"><a href="javascript:void(0)" >'+data.size[i].name+'</a></li>';
                            }
                            $size += '</ul></div>';
                            jQuery(".get_size").append($size);
                        }
                        if(data.sleeve_color){
                            $sleeve_color = '<div class="select-head-name"><h4>Select Your Sleeve Color </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.sleeve_color.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $sleeve_color += '<li class="d-flex '+active+'" id="'+data.sleeve_color[i].id+'"><a href="javascript:void(0)" >'+data.sleeve_color[i].name+'</a></li>';
                            }
                            $sleeve_color += '</ul></div>';
                            jQuery(".get_sleeve_color").append($sleeve_color);
                        }
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });

             //////////////////////////////////////////////////////////////  

            ////////////////////////////////////////////////////////////// 

            //////////////////////////////////////////////////////////////

            jQuery(document).on('click', '.get_sleeve_color li', function (e) {
                jQuery(".order_details").hide();
            	jQuery(".screenloader").show();
              jQuery( ".get_sleeve_color li" ).each(function() {
                  jQuery( this ).removeClass( "active" );
                });
                jQuery(this).addClass("active");
                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
                 
                var side_id = jQuery("body .get_side").find("ul > li.active").attr("id");

                var orientation_id = jQuery("body .get_orientation").find("ul > li.active").attr("id");

                var printing_side_id = jQuery("body .get_printing_side").find("ul > li.active").attr("id");

                var finishing_type_id = jQuery("body .get_finishing_type").find("ul > li.active").attr("id");

                var shape_id = jQuery("body .get_shape").find("ul > li.active").attr("id");

                if(!side_id){
                  side_id = "null";
                }
                if(!orientation_id){
                  orientation_id = "null";
                }
                if(!printing_side_id){
                  printing_side_id = "null";
                }
                if(!finishing_type_id){
                  finishing_type_id = "null";
                }

                if(!shape_id){
                  shape_id = "null";
                }
                var sleeve_color_id = jQuery(this).attr("id");
                    jQuery(".get_size").html("");
                    jQuery(".get_base").html("");
                    jQuery(".quantity_price").html("");
                var current_currency = localStorage.getItem("currency");
                var currency_val = current_currency;   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,printing_side_id:printing_side_id,finishing_type_id:finishing_type_id,shape_id:shape_id,sleeve_color_id:sleeve_color_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                       setTimeout(function(){ jQuery(".screenloader").hide(); }, 500); 
                        if(data.size){
                            $size = '<div class="select-head-name"><h4>Select Your Size </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.size.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $size += '<li class="d-flex '+active+'" id="'+data.size[i].id+'"><a href="javascript:void(0)" >'+data.size[i].name+'</a></li>';
                            }
                            $size += '</ul></div>';
                            jQuery(".get_size").append($size);
                        }
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });

             //////////////////////////////////////////////////////////////  

               

            //////////////////////////////////////////////////////////////

            jQuery(document).on('click', '.get_size li', function (e) {
                jQuery(".order_details").hide();

            	jQuery(".screenloader").show();
              jQuery( ".get_size li" ).each(function() {
                  jQuery( this ).removeClass( "active" );
                });
                jQuery(this).addClass("active");
                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
                 
                
                var side_id = jQuery("body .get_side").find("ul > li.active").attr("id");

                var orientation_id = jQuery("body .get_orientation").find("ul > li.active").attr("id");

                var printing_side_id = jQuery("body .get_printing_side").find("ul > li.active").attr("id");

                var finishing_type_id = jQuery("body .get_finishing_type").find("ul > li.active").attr("id");
                
                var shape_id = jQuery("body .get_shape").find("ul > li.active").attr("id");

                var sleeve_color_id = jQuery("body .get_sleeve_color").find("ul > li.active").attr("id");

                if(!side_id){
                  side_id = "null";
                }
                if(!orientation_id){
                  orientation_id = "null";
                }
                if(!printing_side_id){
                  printing_side_id = "null";
                }
                if(!finishing_type_id){
                  finishing_type_id = "null";
                }
                if(!shape_id){
                  shape_id = "null";
                }
                if(!sleeve_color_id){
                  sleeve_color_id = "null";
                }
                var size_id = jQuery(this).attr("id");

                    jQuery(".get_base").html("");
                    jQuery(".quantity_price").html("");
                var current_currency = localStorage.getItem("currency");
                var currency_val = current_currency;   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,printing_side_id:printing_side_id,finishing_type_id:finishing_type_id,size_id:size_id,shape_id:shape_id,sleeve_color_id:sleeve_color_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                       setTimeout(function(){ jQuery(".screenloader").hide(); }, 500); 
                        
                        if(data.base){
                            $base = '<div class="select-head-name"><h4>Select Your Base </h4></div><div class="product-select-list"><ul class="d-flex flex-wrap">';
                            for(i=0;i<data.base.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $base += '<li class="d-flex '+active+'" id="'+data.base[i].id+'"><a href="javascript:void(0)">'+data.base[i].name+'</a></li>';
                            }
                            $base += '</ul></div>';
                            jQuery(".get_base").append($base);
                        }
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });

             ////////////////////////////////////////////////////////////// 

         
             
            //////////////////////////////////////////////////////////////

            jQuery(document).on('click', '.get_base li', function (e) {
                jQuery(".order_details").hide();

            	jQuery(".screenloader").show();
                jQuery( ".get_base li" ).each(function() {
                  jQuery( this ).removeClass( "active" );
                });
                jQuery(this).addClass("active");
                var product_id = jQuery("body").find(".product > li.active").attr("product_id");

                var material_id = jQuery("body .get_material").find("ul > li.active").attr("id");
                 
                var side_id = jQuery("body .get_side").find("ul > li.active").attr("id");

                var orientation_id = jQuery("body .get_orientation").find("ul > li.active").attr("id");

                var printing_side_id = jQuery("body .get_printing_side").find("ul > li.active").attr("id");

                var finishing_type_id = jQuery("body .get_finishing_type").find("ul > li.active").attr("id");
                
                var size_id = jQuery("body .get_size").find("ul > li.active").attr("id");
                var shape_id = jQuery("body .get_shape").find("ul > li.active").attr("id");
                var sleeve_color_id = jQuery("body .get_sleeve_color").find("ul > li.active").attr("id");

                if(!side_id){
                  side_id = "null";
                }
                if(!orientation_id){
                  orientation_id = "null";
                }
                if(!printing_side_id){
                  printing_side_id = "null";
                }
                if(!finishing_type_id){
                  finishing_type_id = "null";
                }
                if(!size_id){
                  size_id = "null";
                }
                if(!shape_id){
                  shape_id = "null";
                }
                if(!sleeve_color_id){
                  sleeve_color_id = "null";
                }
                var base_id = jQuery(this).attr("id");

                    jQuery(".quantity_price").html("");
                var current_currency = localStorage.getItem("currency");
                var currency_val = current_currency;   
                var action = "{{url('get_custom_change_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{product_id:product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,printing_side_id:printing_side_id,finishing_type_id:finishing_type_id,size_id:size_id,shape_id:shape_id,sleeve_color_id:sleeve_color_id,base_id:base_id,currency:currency_val},
                success: function(response) {
                       var data = JSON.parse(response);
                        setTimeout(function(){ jQuery(".screenloader").hide(); }, 500); 
                        if(data.quantity){
                            $quantity_price = '<div class="select-head-name"><h4>Select Your Quantity</h4></div><div class="product-select-price"><ul class=""><li class="active quantity_price_li"><span class="quantity-text">Quantity</span> <span class="price-text">Price</span></li>';

                            for(i=0;i<data.quantity.length;i++){
                                if(i == 0){
                                   active = "active";
                                }else{
                                   active = ""; 
                                }
                                $quantity_price += '<li class="active" quantity_id="'+data.quantity_id[i]+'"> <a href="javascript:void(0)"><span class="quantity-text">'+data.quantity[i]+'</span> <span class="price-text">'+data.symbol[i]+data.price[i]+'</span></a></li>';
                            }
                            $quantity_price += '</ul></div>';
                            jQuery(".quantity_price").append($quantity_price);
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });

             //////////////////////////////////////////////////////////////   

            jQuery(document).on('change', '.get_quantity', function (e) {
              var get_product_id = jQuery(".get_products").val();
              var material_id = jQuery(".get_material").val();
              var side_id = jQuery(".get_side").val();
              var orientation_id = jQuery(".get_orientation").val();
              var quantity_id = jQuery(this).val();
                jQuery(".get_price").html("");
                   
                var action = "{{url('get_custom_data')}}"
                jQuery.ajax({
                headers: { 'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
                              },
                type: 'get',
                url: action,
                data:{get_product_id:get_product_id,material_id:material_id,side_id:side_id,orientation_id:orientation_id,quantity_id:quantity_id},
                success: function(response) {
                       var data = JSON.parse(response);
                       console.log(data);
                        jQuery(".show_price").show();
                        for(i=0;i<data.price.length;i++){
                            console.log(data.price[i]);
                            jQuery(".get_price").append("<option value='"+data.price[i]+"'>£"+data.price[i]+"</option>")
                        }
                        /*get_quantity_price(get_product_id,data.material[0].id,data.side[0].id,data.orientation[0].id);*/
                    }
                });

            });


        });
        /*function get_quantity_price(product_id,material,side,orientation){
            alert(product_id+"_"+material+"_"+side+"_"+orientation)
        }*/


    </script>
@endpush
