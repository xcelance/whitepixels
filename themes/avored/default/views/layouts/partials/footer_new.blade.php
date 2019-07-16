<section class="logo-sec">
            <div class="container">
                <ul class="clearfix">
                    <li class="stripe"><img src="{{url('public/vendor/avored-default/images/stripe.png')}}"></li>                
                    <li class="mt-3"><img src="{{url('public/vendor/avored-default/images/logo-img-1.png')}}"></li>
                    <li><img src="{{url('public/vendor/avored-default/images/logo-img-3.png')}}"></li>
                    <li><img src="{{url('public/vendor/avored-default/images/logo-img-4.png')}}"></li>
                </ul>
            </div>
        </section>
        
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <div class="f-inner border-0">
                            <h4>MENU</h4>
                            <ul class="">
                                <li><a href="{{url('products')}}">Products</a></li>
                                <li><a href="{{url('aboutus')}}">About Us</a></li>
                                @if(Auth::check())<li><a href="{{url('my-account')}}">Customer Area</a></li>@endif
                                <li><a href="{{url('artwork-guide')}}">Artwork Guide</a></li>
                                <li><a href="{{url('cutting-forme')}}">Cutting Formes</a></li>                                
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-6">
                        <div class="f-inner">
                            <h4>QUICK LINKS</h4>
                            <ul class="">
                                <li><a href="{{url('request_quote')}}">Quotation</a></li>
                                <li><a href="{{url('faq')}}">FAQ</a></li>
                                <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                                <li><a href="{{url('legal')}}">Legal</a></li>
                                <li><a href="{{url('blog')}}">Blog</a></li>                                
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4 col-sm-4 col-12">
                        <div class="f-inner contact-us">
                            <h4>CONTACT US</h4>
                            <ul class="">
                                <li><a href="#">+44 28 9094 4444</a></li>
                                <li><a href="#">quotes@whitepixels.net</a></li>
                                <li>White Pixels, Owen O’Cork Mill, Unit 9B, 288 Beersbridge Rd, Belfast, BT5 5DX, County Antrim, Northern Ireland</li>
                            </ul>
                        </div>
                    </div> 
                    
                   <!-- <div class="col-md-2 col-sm-6">
                        <div class="f-inner">
                            <h4>SOCIAL</h4>
                            <ul class="">
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Twitter</a></li>
                                <li><a href="#">LinkedIn</a></li>
                                <li><a href="#">YouTube</a></li>
                                <li><a href="#">Instagram</a></li>
                            </ul>
                        </div>
                    </div>-->
                    <div class="col-md-12 col-sm-12">
                        <div class="social-block">
                            <ul class="">
                                <li><a href="https://www.facebook.com/"><img src="{{url('public/vendor/avored-default/images/fb-icon.png')}}"></a></li>
                                <li><a href="https://twitter.com/"><img src="{{url('public/vendor/avored-default/images/twitter-icon.png')}}"></a></li>
                                <li><a href="https://in.linkedin.com/"><img src="{{url('public/vendor/avored-default/images/linkedin-icon.png')}}"></a></li>
                                <li><a href="https://www.instagram.com"><img src="{{url('public/vendor/avored-default/images/instagram-icon.png')}}"></a></li>
                                <li><a href="https://www.youtube.com/"><img src="{{url('public/vendor/avored-default/images/youtube-icon.png')}}"></a></li>
                                
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="copy-right">
                <p>COPYRIGHT2019. ALL RIGHTS RESEVED.</p>
            </div>
        </footer>
        
        <div class="need-help-block">
            <div class="container">
                <div class="needhelp-btn">
                    <a href="javascript:void(0)" class="ct-btn">Need Help?</a>
                </div>
                <div class="need-help-box">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="need-help-content">
                                <h4><i class="help-icon"></i>Need help ordering?</h4>
                                <p>Call us or chat online with one of our support agents:</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="need-help-content">
                                <h4>
                                    <i class="phone-icon"></i>
                                    <a href="tel:028 9032 3552">028 9032 3552</a>
                                </h4>
                            </div>
                        </div> 
                        
                        <div class="col-md-3">
                            <div class="need-help-content">
                                <h4>
                                    <i class="chat-icon"></i>
                                    <a href="javascript:void(Tawk_API.toggle())">CHAT NOW</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
       
        
        
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
         <script src="https://www.google.com/recaptcha/api.js"></script>
         <script>        
            $(".login-dropdown a").click(function(){
                $(".login-popup").toggleClass("show");
            });
            $(".profile-btn").click(function(){
                $(".profile-popup").toggleClass("show");
            });
            
            $(".needhelp-btn a").click(function(){
                $(".need-help-box").slideToggle("500");
            });
            if ($(window).width() > 991) {  
                $(".product-dropdown").click(function(){

                    $(".product-popup").fadeIn(10);
                });
                $(".cart-block").click(function(){
                    $(".cart-menu").fadeIn(10);
                });
                $(".browse-menu").show();

            }else{
                $(".navbar-toggler-icon").click(function(){
                    var hascl = $(".navbar-collapse").hasClass("show");
                    if(hascl == false){
                        $("body").addClass("body_scroll");
                    }else{
                        $("body").removeClass("body_scroll");
                    }
                });

            } 
            
            $(".w_currency").change(function(){
                var cur = $(this).val();
                localStorage.setItem("currency",cur);
                var action="{{url('change_currency')}}";
                $.ajax({
                    type: 'GET',
                    url: action,
                    async: false,
                    data: {currency:cur},
                    success: function(response) { 

                      window.location.reload(); 

                    }
                });
            });
        </script> 
      @if(Auth::user())
         @if(Auth::user()->role !="guest")
            <?php  $currency =  Auth::user()->currency;?>
            @if($currency == "GBP")
              <?php $_SESSION['currency'] =  "pound"; ?>
             <script type="text/javascript">
               localStorage.setItem("currency",'pound');
             </script>
            @else
              <?php  $_SESSION['currency'] =  "euro"; ?>
              <script type="text/javascript">
               localStorage.setItem("currency",'euro');
             </script>
            @endif
         @endif

      @endif  
       <!-- <script>     
            $(".product-dropdown a").click(function(){
                $(".product-popup").toggleClass("show");
            });
        </script>-->
        <script type="text/javascript">
            $(document).ready(function(){

            $(".login_form").submit(function(e){
                    e.preventDefault();
                    $(".loader_reg").show();
                    var action=$(this).attr("action");
                    var formdata=$(this).serialize();
                    setTimeout(function(){ 
                                $.ajax({
                                type: 'POST',
                                url: action,
                                async: false,
                                data: formdata,
                                success: function(response) {
                                    console.log(response);
                                    $(".loader_reg").hide();
                                    var obj = JSON.parse(response);
                                        setTimeout(function(){ 
                                              $(".login_msg").html("");
                                         }, 5000);
                                    if(obj.action == "reg_error"){
                                       $(".login_msg").html('<div class="alert alert-danger">'+obj.errors+'</div>');
                                    }else if(obj.action == "success"){
                                        $(".loader").hide();
                                        $(".register_message").hide();
                                        $(".register_success").show()
                                        $(".login_msg").html('<div class="alert alert-success">'+obj.success_message+'</div>');
                                        // var redirect="{{url('my-account')}}";
                                        
                                         setTimeout(function(){ 
                                              window.location.href=obj.redirect;
                                         }, 4000);
                                    }else{
                                       $(".login_msg").html("Something went wrong");
                                    }
                                }
                              });
                    }, 2000);        
                    
                });
                /////////////////////////////////////////////////////

                /////////////////////////////////////////////////////
                if(localStorage.getItem("currency") != null){
                    if(localStorage.getItem("currency") == "pound"){
                        $(".w_currency option").each(function(){
                            if($(this).val() == "pound"){
                                $(this).prop("selected",true);
                            }
                        });
                    }else{
                        $(".w_currency option").each(function(){
                            if($(this).val() == "euro"){
                                $(this).prop("selected",true);
                            }
                        });

                    }
                }else{
                       $.ajax({
                            type: 'GET',
                            url: "{{url('change_currency')}}",
                            async: false,
                            data: {currency:"pound",set_cur:"set_cur"},
                            success: function(response) { 
                               localStorage.setItem("currency","pound");
                            }
                        });
                    
                }   
                ///////////////////////////////////////////////////
            });
        </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5cc828d72846b90c57ac2d49/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>

<script type="text/javascript">

    $(window).scroll(function(){
      var sticky = $('.header'),
          scroll = $(window).scrollTop();

      if (scroll >= 100) sticky.addClass('fixed');
      else sticky.removeClass('fixed');
    });

</script>

<!-- <script type="text/javascript">
    $(window).resize(function() {
        $('.carousel-item').height($(window).height() - 180);
    });

    $(window).trigger('resize');
</script>
 -->
<!--End of Tawk.to Script-->