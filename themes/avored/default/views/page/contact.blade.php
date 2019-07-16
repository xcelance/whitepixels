@extends('layouts.app_new')
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 70%;
      }     
    </style>
@section('slider')
<div class="contact-banner inner-banner">
            <div class="container">
                <div class="banner-heading">
                    <h2>Contact us</h2>
                </div>
            </div>
        </div>
@endsection
@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('contact') }}
        </nav>
    </div>
</div>
@endsection

@section('content')	  

        <section class="contact-sec">
            <div class="container">
                <div class="row">
                	<h3 class="site-heading">whitepixels.com</h3>
                     <div class="col-md-4">
                        <p class="contact-icon-div">
                            <span class="outer"><i class="fas fa-map-marker-alt"></i></span>
                        </p>
                    <h3 class="c-detail-heading">Contact Address:</h3>                        
                     	<div class="c-detail-box">
                     		<div class="contact-det">
                                <p>White Pixels</p>
                                 <p>Owen O’Cork Mill, Unit 9B, <br>288 Beersbridge Rd, Belfast,<br> BT5 5DX, County Antrim,<br> Northern Ireland</p>
                     	    </div>
                     	</div>
                     </div>
                     <div class="col-md-4">
                       <p class="contact-icon-div">
                          <span class="outer"><i class="fa fa-phone" aria-hidden="true"></i></span>
                       </p>    
                    <h3 class="c-detail-heading">Telephone:</h3>                        
                        <div class="c-detail-box">
                            <div class="contact-det">
                                <p>+44 28 9094 4444</p>
                            </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                       <p class="contact-icon-div">
                          <span class="outer"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                       </p>            
                    <h3 class="c-detail-heading">Email Address:</h3>                        
                        <div class="c-detail-box">
                            <div class="contact-det">
                                 <p>quotes@whitepixel.net</p>
                            </div>
                        </div>
                     </div>                                         
                </div>
           
            </div>
        </section>

<!--         <section class="contact-sec">
            <div class="container">
                <div class="row">
                    <h3 class="site-heading">whitepixels.com</h3>
                    <h3 class="c-detail-heading">Contact Numbers:</h3>
                     <div class="col-md-4">
                        <div class="c-detail-box">
                            <div class="c-grey-header">Republic of Ireland</div>
                            <div class="contact-det">
                                <p>0044 28 9032 3552</p>
                                <p>048 9032 3552</p>
                            </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="c-detail-box">
                            <div class="c-grey-header">Northern Ireland</div>
                            <div class="contact-det">
                                <p>0044 28 9032 3552</p>
                                <p>048 9032 3552</p>
                            </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="c-detail-box">
                            <div class="c-grey-header">Republic of Ireland</div>
                            <div class="contact-det">
                                <p>0044 28 9032 3552</p>
                            </div>
                        </div>
                     </div>                                          
                </div>
                <div class="row">
                    <h3 class="c-detail-heading">Contact Addresses:</h3>
                     <div class="col-md-4">
                        <div class="c-detail-box">
                            <div class="c-grey-header">Belfast Factory Address</div>
                            <div class="contact-det">
                                <p>3 Nicholson Drive,</p>
                                <p>Michelin Road, Mallusk, BT36 4FB</p>
                            </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="c-detail-box">
                            <div class="c-grey-header">Liverpool Factory Address</div>
                            <div class="contact-det">
                                <p>Unit 16, Compass West Industrial Estate,</p>
                                <p>Speke, Liverpool, L24 1YA</p>
                            </div>
                        </div>
                     </div>
                                          
                </div>                
            </div>
        </section> -->        
<!--         <section class="contact-sec">
            <div class="container">
                <div class="popular-heading">
                    <h2>Get In Touch</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices blandit odio nec mollis. </p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="contact-info">
                            <h4>Contact info</h4>
                            
                            <div class="contact-box">
                                <h5>Address</h5>
                                <address>3 Nicholson Drive,
                                    Michelin Road, Mallusk, BT36 4FB
                                </address>
                            </div>
                            
                            <div class="contact-box">
                                <h5>Mail</h5>
                                <a href="mailto:quotes@whitepixels.com">quotes@whitepixels.com</a>
                            </div>
                            
                            <div class="contact-box">
                                <h5>Phone</h5>
                                <a href="tel:028 9032 3552">028 9032 3552</a>
                            </div>
                            
                            <div class="contact-social-link">
                                <ul class="">
                                    <li><a href="#"><i class="fb-icon"></i></a></li>
                                    <li><a href="#"><i class="twitter-icon"></i></a></li>
                                    <li><a href="#"><i class="linkedin-icon"></i></a></li>
                                    <li><a href="#"><i class="insta-icon"></i></a></li>
                                    <li><a href="#"><i class="youtube-icon"></i></a></li>
                                </ul>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                     <div class="col-lg-8 col-md-7">
                        <div class="reg-form contact-form">
                        <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your name..">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Your Email..">
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Subject..">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea type="text" class="form-control" id="exampleInputPassword1" placeholder="Message.."></textarea>
                                </div>
                            </div>
                           
                        </div>
                        
                        <div class="submit-btn">
                            <button type="submit" class="ct-btn">Send Message</button>
                        </div>
                        
                    </form>
                </div>
                    </div>
                </div>
            </div>
        </section> -->

        
        <div class="map-block">
<div id="map"></div>
        </div>
        
      
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
<script>

      // The following example creates a marker in Stockholm, Sweden using a DROP
      // animation. Clicking on the marker will toggle the animation between a BOUNCE
      // animation and no animation.

      var marker;

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 54.592422, lng: -5.901465}
        });

        marker = new google.maps.Marker({
          map: map,
          icon: 'http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/map-icon.svg',
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: {lat: 54.592422, lng: -5.901465}
        });

        marker.setAnimation(google.maps.Animation.BOUNCE);
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUSxUNk6tu3q6Yg8PxdTIzrOuK96sM5Bs&callback=initMap">
    </script>
@endpush


