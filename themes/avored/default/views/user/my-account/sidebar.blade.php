<section class="customet-sec">
            <div class="container">
                <div class="popular-heading">
                    <h2> WELCOME <a href="#">{{Auth::user()->username}}</a> TO YOUR<br> CUSTOMER AREA!</h2>
                </div>
                <?php $order_job =  \App\Helpers\AppHelper::instance()->all_jobs_status(); ?>
                <div class="menu-customer-block">
                    <div class="row">
                        <div class="col">
                            <a href="{{url('my-account')}}" class="menu-customer-box @if(isset($myaccount)) active @endif">
                                <i class="menu-customer-icon account-icon"></i>
                                <h4>Account</h4>
                                <h6>View</h6>
                            </a>
                        </div>
                        
                        <div class="col">
                            <a href="{{url('my-account/jobs/list')}}" class="menu-customer-box @if(isset($jobdata)) active @endif">
                                <i class="menu-customer-icon cust-info-icon"></i>
                                <h4>Job Status</h4>
                                <h6>View</h6>
                            </a>
                        </div>
                        
                        <div class="col">
                            <a href="{{url('my-account/invoice/list')}}" class="menu-customer-box @if(isset($invoice)) active @endif">
                                <i class="menu-customer-icon invoices-icon"></i>
                                <h4>Invoices</h4>
                                <h6>View</h6>
                            </a>
                        </div>                    
                                                
                        <div class="col">
                            <a href="{{url('quotes')}}" class="menu-customer-box @if(isset($quote)) active @endif">
                                <i class="menu-customer-icon cust-quotes-icon"></i>
                                <h4>Quotes</h4>
                                <h6>View</h6>
                            </a>
                        </div>
                        
                        <!-- <div class="col">
                            <a href="{{url('addresses')}}" class="menu-customer-box">
                                <i class="menu-customer-icon customer-location"></i>
                                <h4>Addresses</h4>
                                <h6>View</h6>
                            </a>
                        </div> -->
                    </div>
                </div>
                
                <div class="customerInfo">
                    <!-- <h4 class="customer-area-head">YOUR PRODUCTION OVERVIEW FOR 
                        <span>
                            <select name="month">
                                <option value="may">May</option>
                            </select>
                        </span>
                        <span>
                            <select>
                                <option>2017</option>
                                <option>2018</option>
                                <option value="2019" selected>2019</option>
                            </select>
                        </span>
                    </h4> -->
                    
                    <div class="menu-customer-block">
                        <div class="row">
                            <div class="col">
                                <a href="#" class="order-customer-box">
                                    <div class="row align-items-center">
                                        <div class="col customer-order-number">
                                            <span>{{$order_job["orders"]}}</span>
                                        </div>
                                        <div class="col menu-customer-name">
                                            <h6>ORDERED JOBS</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col">
                                <a href="#" class="order-customer-box">
                                    <div class="row align-items-center">
                                        <div class="col customer-order-number bg-orange">
                                            <span>{{$order_job["completed_orders"]}}</span>
                                        </div>
                                        <div class="col menu-customer-name bg-orange">
                                            <h6>COMPLETED  JOBS</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col">
                                <a href="#" class="order-customer-box">
                                    <div class="row align-items-center">
                                        <div class="col customer-order-number">
                                            <span>{{$order_job["dispatch_orders"]}}</span>
                                        </div>
                                        <div class="col menu-customer-name">
                                            <h6>DUE TO DISPATCH TODAY</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- <div class="col">
                                <a href="#" class="order-customer-box">
                                    <div class="row align-items-center">
                                        <div class="col customer-order-number bg-orange">
                                            <span>0</span>
                                        </div>
                                        <div class="col menu-customer-name bg-orange">
                                            <h6>SPENT THIS MONTH</h6>
                                        </div>
                                    </div>
                                </a>
                            </div> -->
                            
                        </div>
                    </div>
                </div>
            </div>
 </section>