
<header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-8 col-sm-7">
                            <div class="header-left-content">
                                <ul class="">
                                    <li class="tel-box"><a href="tel:02890323552"> 028 9032 3552</a></li>
                                    <li class="mail-box"><a href="mailto:quotes@whitepixels.net"> quotes@whitepixels.net</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-5">
                            <div class="header-right-content">
                                @if(!Auth::check()) 
                                <ul class="">
                                
                                    
                                    <li class="nav-item login-dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button">
                                        login
                                        </a>
                                    <div class="login-popup login-block">
                                        <h2 class="signup-heading">Login</h2>
                                    
                                        <form method="POST" class="form ng-untouched ng-pristine ng-invalid login_form" action="{{ url('login_ajax') }}"> 
                                         {{ csrf_field() }}  
                                        <div class="login_msg"></div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group input-block">
                                                    <!--<label class="input-label" for="email">username</label>-->
                                                    <input class="form-control" id="username" name="username" placeholder="Username" required="" type="text">

                                                </div>
                                            </div>
                                        <div class="col-sm-12">
                                            <div class="form-group input-block">
                                                <!--<label class="input-label" for="password">Password</label>-->
                                                <input class="form-control" id="password" name="password" placeholder="Password" required="" type="password">
                                            </div>
                                        </div>
                                            
                                        <div class="clearfix"></div>
                                        <div class="col-sm-12">
                                            <div class="signup-btn">
                                                <button type="submit" class="ct-btn">Log in</button>
                                                <div class="spinner-border loader_reg" role="status" style="display: none">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                            
                                        <div class="col-xs-8">
                                            <div class="signin-block signup_block">
                                                <a href="{{url('register')}}">Registration</a>
                                            </div>
                                        </div>
                                            <div class="col-xs-4">
                                                <div class="signin-block forgot-block">
                                                    <a href="{{url('password/reset')}}">Forgot password</a>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    </li>
                                    
                                    <li class="">
                                        <a href="{{url('register')}}" class="register-btn">register</a>
                                    </li>
                                    <!-- currency -->
                                    <li class="nav-item">  
	                                         <select name="w_currency" class="w_currency">
	                                         	<option value="pound">GBP(£)</option>
	                                         	<option value="euro">EUR(€)</option>
	                                         </select>
                                    </li>

                                    <!-- end -->
                                </ul>
                                @else
                                    @if(Auth::user()->role == "guest")
                                       <div class="header-right-content">
                                            <ul class="">
                                                <li class="">
                                                    <span>Guest</span>
                                                </li>
                                                <li><a href="{{url('logout')}}" class="logout_text"><i class="logout-icon"></i>Logout</a></li>
                                            </ul>
                                        </div>

                                    @else
                                        <div class="header-right-content">
                                            <ul class="">
                                                <li class="">
                                                    <a href="#" class="register-btn profile-btn">My Profile</a>
                                                    <div class="profile-popup">
                                                        <h4 class="user-name">{{Auth::user()->username}}</h4>
                                                        <ul class="">
                                                            <li>
                                                                <a href="{{url('my-account')}}"><i class="account-icon"></i>Account</a>
                                                            </li>
                                                             <li><a href="{{url('my-account/jobs/list')}}"><i class="info-icon"></i>Job Status</a></li>

                                                            <li><a href="{{url('my-account/invoice/list')}}"><i class="invoices-icon"></i>Invoices</a></li>
                                                           
                                                            <li><a href="{{url('quotes')}}"><i class="customer-location"></i>My Quotes</a></li>
                                                            <li><a href="{{url('logout')}}" class="logout_text"><i class="logout-icon"></i>Logout</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif    

                                @endif
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            
            
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('public/vendor/avored-default/images/site-logo.png')}}"></a>
                    <div class="nav-item mobile_cart">
                        <?php $tree =  \App\Helpers\AppHelper::instance()->cart_count(); ?>
                        <?php if($tree > 0){  ?>
                        <a href="{{ url('cart/view') }}" class="cart-block"><span class="noti-icon"><?php echo $tree ; ?></span></a>
                        <?php }else{  ?>
                            <a class="nav-link dropdown-toggle cart-block" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <span class="noti-icon"><?php echo $tree ; ?></span>
                            </a>
                            <div class="dropdown-menu cart-menu">
                                <ul class="dropdown-list">
                                    <li>Cart Empty!</li>
                                    
                                </ul>
                            </div>
                        <?php } ?>
                    </div>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto ml-auto">
                            <li class="nav-item active product-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                OUR PRODUCTS</a>
                                
                                <div class="dropdown-menu product-popup">
                                    <div class="condtainer">
                                         <div class="request-quote-block">
                                                <h3>Litho Print Section</h3>
                                                <p>A selection of products offered at unbeatable value</p>
                                            </div>
                                        <div class="row">                                           
                                            <?php $custmenu1 = '';$custmenu2 = '';$custmenu3 = '';
                                                $tree =  \App\Helpers\AppHelper::instance()->show_categories(); ?>
                                            @foreach($tree as $category)
                                                <?php
                                                    if($category->name !== 'Foamex Boards' && $category->name !== 'Mesh Banner' && $category->name !== 'Posters' && $category->name !== 'PVC Banner' && $category->name !== 'Roller Banner'){
                                                     if($category->name == 'Flags' || $category->name == 'Flyers & Leaflets' || $category->name == 'Unfinished Sheets'){
                                                        $custmenu1 .= '<h4>'.$category->name.'</h4><ul class="">';
                                                        if(isset($category->childs)){
                                                        foreach($category->childs as $child_category){
                                                         $custmenu1 .= "<li><a href=\"".URL::to('/')."/category/litho/$child_category->slug\">".$child_category->name.'</a></li>';
                                                        }
                                                      }
                                                        
                                                    }elseif($category->name == 'Folders' || $category->name == 'Wide Format'){
                                                        $custmenu2 .= '<h4>'.$category->name.'</h4><ul class="">';
                                                        if(isset($category->childs)){
                                                        foreach($category->childs as $child_category){
                                                         $custmenu2 .= "<li><a href=\"".URL::to('/')."/category/litho/$child_category->slug\">".$child_category->name.'</a></li>';
                                                        }
                                                      }
                                                        
                                                    }else{ ?>
                                            <div class="col">
                                                <div class="product-list dropdown-list">
                                                    
                                                    <h4>{{$category->name}}</h4>
                                                    <ul class="">
                                                        @if(isset($category->childs))
                                                        @foreach($category->childs as $child_category)
                                                         <li><a href="{{url('category')}}/litho/{{$child_category->slug}}">{{$child_category->name}}</a></li>
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php } } ?>
                                            @endforeach 
                                            <div class="col">
                                                <div class="product-list dropdown-list">
                                                    <?php echo $custmenu1.'</ul>'; ?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="product-list dropdown-list">
                                                    <?php echo $custmenu2.'</ul>'; ?>
                                                </div>
                                            </div>
                                        </div>                                       
                                    </div>
                                     <div class="condtainer">
                                            <div class="request-quote-block">
                                                <h3>Digital Print Section</h3>
                                                <p>A selection of products offered at unbeatable value</p>
                                            </div>
                                        <div class="row">
                                            
                                            <?php $custmenu1 = '';$custmenu2 = '';$custmenu3 = '';
                                                $tree =  \App\Helpers\AppHelper::instance()->show_categories(); ?>
                                            @foreach($tree as $category)
                                                <?php 
                                                    if($category->name !== 'Foamex Boards' && $category->name !== 'Mesh Banner' && $category->name !== 'Posters' && $category->name !== 'PVC Banner' && $category->name !== 'Roller Banner'){
                                                     if($category->name == 'Flags' || $category->name == 'Flyers & Leaflets' || $category->name == 'Unfinished Sheets'){
                                                        $custmenu1 .= '<h4>'.$category->name.'</h4><ul class="">';
                                                        if(isset($category->childs)){
                                                        foreach($category->childs as $child_category){
                                                         $custmenu1 .= "<li><a href=\"".URL::to('/')."/category/digital/$child_category->slug\">".$child_category->name.'</a></li>';
                                                        }
                                                      }
                                                        
                                                    }elseif($category->name == 'Folders' || $category->name == 'Wide Format'){
                                                        $custmenu2 .= '<h4>'.$category->name.'</h4><ul class="">';
                                                        if(isset($category->childs)){
                                                        foreach($category->childs as $child_category){
                                                         $custmenu2 .= "<li><a href=\"".URL::to('/')."/category/digital/$child_category->slug\">".$child_category->name.'</a></li>';
                                                        }
                                                      }
                                                        
                                                    }else{ ?>
                                            <div class="col">
                                                <div class="product-list dropdown-list">
                                                    
                                                    <h4>{{$category->name}}</h4>
                                                    <ul class="">
                                                        @if(isset($category->childs))
                                                        @foreach($category->childs as $child_category)
                                                         <li><a href="{{url('category')}}/digital/{{$child_category->slug}}">{{$child_category->name}}</a></li>
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php }} ?>
                                            @endforeach 
                                            <div class="col">
                                                <div class="product-list dropdown-list">
                                                    <?php echo $custmenu1.'</ul>'; ?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="product-list dropdown-list">
                                                    <?php echo $custmenu2.'</ul>'; ?>
                                                </div>
                                            </div>                                         
                                        </div>                                     
                                    </div>
                                    <div class="condtainer">
                                         <div class="request-quote-block">
                                                <h3>Large FormatPrint Section</h3>
                                                <p>A selection of products offered at unbeatable value</p>
                                            </div>
                                        <div class="row"> 
                                        <?php $custmenu1 = '';$custmenu2 = '';$custmenu3 = '';
                                                $tree =  \App\Helpers\AppHelper::instance()->show_categories(); ?>
                                            @foreach($tree as $category)
                                                 <?php 
                                                    if($category->name == 'Foamex Boards' || $category->name == 'Mesh Banner'|| $category->name == 'Posters' || $category->name == 'PVC Banner' || $category->name == 'Roller Banner'){ ?>
                                                <div class="col">
                                                    <div class="product-list dropdown-list">                                                        
                                                        <h4><a href="{{url('category')}}/large/{{$child_category->slug}}">{{$category->name}}</a></h4>
                                                    </div>
                                                </div>
                                                <? } ?>
                                            @endforeach

                                                                                      
                                        </div>  
                                         <div class="request-quote-block">
                                            <p>Can't find what you need or have a bespoke requirement?</p>
                                            <a href="{{url('request_quote')}}">Request a quote</a>
                                        </div>                                     
                                    </div>

                                </div>
                            </li>                           
                         
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                BROWSE</a>
                                <div class="dropdown-menu browse-menu">
                                    <ul class="dropdown-list">
                                        <li><a href="{{url('request_quote')}}"><img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/request-icon.png">Request A Quote</a></li>
                                        <!-- <li><a href="#">Estimate Job Price</a></li> -->
                                        <li><a href="{{url('cutting-forme')}}"><img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/cutting-formes-icon.png">View Cutting Formes</a></li>
                                        <li><a href="{{url('artwork-guide')}}"><img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/artwork-icon.png">View Artwork Guide</a></li>
                                        <!-- <li><a href="#">Quick Re-Order</a></li>
                                        <li><a href="#">Make Top-up Payment</a></li>
                                        <li><a href="#">Track Your Job/Order</a></li> -->
                                        @if(Auth::check())
                                            @if(Auth::user()->role == "siteuser")
                                              <li><a href="{{url('my-account')}}"><img src="http://122.160.12.75:3044/quinnstheprinters/public/vendor/avored-default/images/customer-support-icon.png">Customer Area</a></li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{url('aboutus')}}">
                                About Us</a>
                            
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('faq')}}">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('legal')}}">LEGAL</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('contact-us')}}">CONTACT US</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="{{url('blog')}}">BLOG</a>
                            </li>
                        </ul>
                        <div class="form-inline my-2 my-lg-0">
                            <ul class="navbar-nav nav-right-block">
                                <li class="nav-item upload"><a href="{{url('uploadartwork')}}" class="artwork-menu-link">
                                	<span class="upload-menu-icon"></span>Upload Artwork</a></li>


                                <li class="nav-item desktop_cart">
                                    <?php $tree =  \App\Helpers\AppHelper::instance()->cart_count(); ?>
                                    <?php if($tree > 0){  ?>
                                    <a href="{{ url('cart/view') }}" class="cart-block"><span class="noti-icon"><?php echo $tree ; ?></span></a>
                                    <?php }else{  ?>
                                        <a class="nav-link dropdown-toggle cart-block" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <span class="noti-icon"><?php echo $tree ; ?></span>
                                        </a>
                                        <div class="dropdown-menu cart-menu">
                                            <ul class="dropdown-list">
                                                <li>Cart Empty!</li>
                                                
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
</header>        