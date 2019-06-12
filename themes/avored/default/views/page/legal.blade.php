@extends('layouts.app_new')

@section('slider')
<div class="legal-banner inner-banner">
            <div class="container">
                <div class="banner-heading">
                    <h2>Legal</h2>
                </div>
            </div>
        </div>
@endsection
@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('legal') }}
        </nav>
    </div>
</div>
@endsection

@section('content')	  
        
        <section class="faq-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="faq-list">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item faq-list-heading">
                                    <h4 class="">Legal Information</h4>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="true">
                                        <i class="faq-list-icon legal-truck-icon"></i>Delivery Information</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">
                                        <i class="faq-list-icon legal-card-icon"></i>Payment Information</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="privacy-tab" data-toggle="tab" href="#privacy" role="tab" aria-controls="privacy" aria-selected="false">
                                        <i class="faq-list-icon legal-privacy-icon"></i>Privacy Policy</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="cancellation-tab" data-toggle="tab" href="#cancellation" role="tab" aria-controls="cancellation" aria-selected="false">
                                        <i class="faq-list-icon legal-cancellation-icon"></i>Cancellation Policy</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="proof-tab" data-toggle="tab" href="#proof" role="tab" aria-controls="proof" aria-selected="false">
                                        <i class="faq-list-icon legal-proof-icon"></i>Proof Approval and Return Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cookies-tab" data-toggle="tab" href="#cookies" role="tab" aria-controls="cookies" aria-selected="false">
                                        <i class="faq-list-icon legal-cookies-icon"></i>Use of Cookies</a>
                                </li>

                            </ul>
                        </div>

                    </div>
                    
                    <div class="col-lg-9">
                        <div class="tab-content faq-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                                <div class="faq-content-box">
                                    <h4>DELIVERY INFORMATION</h4>
                                    <ul class="">
                                        <li>All prices INCLUDE delivery in Ireland and U.K. We use reputable carriers to deliver all our goods on a next working day basis.</li>
                                        <li>If you require special delivery instructions, or need to ship to anywhere outside Ireland, please contact us to make the appropriate arrangements.</li>
                                        <li>Our carriers aim to deliver on time, however, we cannot be held responsible for failed deliveries or any losses incurred, after goods have left our premises for delivery by a third party. The carriers are fully insured to cover losses but this issue must be addressed with the  carrier directly</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                                <div class="faq-content-box">
                                    <h4>PAYMENT INFORMATION</h4>
                                    <ul class="">
                                        <li>When ordering via our website, payment may be made via credit card, debit card or PayPal. <a href="#"> Payment Policy</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="artwork" role="tabpanel" aria-labelledby="artwork-tab">
                                 <div class="faq-content-box">
                                    <h4>PAYMENT INFORMATION</h4>
                                    <ul class="">
                                        <li>When ordering via our website, payment may be made via credit card, debit card or PayPal. <a href="#"> Payment Policy</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            
                             <div class="tab-pane fade" id="privacy" role="tabpanel" aria-labelledby="privacy-tab">
                                <div class="faq-content-box">
                                    <h4>PRIVACY POLICY</h4>
                                    <p>In order to operate the online payment service and to reduce the risk of fraud, we, Quinns Belfast (2009) Ltd, the data controller, must ask you to provide us information regarding your name and address and your credit or debit card. By consenting to, and agreeing the terms of, the Privacy Policy, you also expressly consent and agree to us processing your data in order to collect payment. Quinns Belfast (2009) Ltd takes the privacy of your personal information very seriously. We will NOT retain any of your credit or debit card information. We retain your name and address on our database for our internal use, however, we will NOT sell or rent your personally identifiable information or a list of our customers to third parties.</p>
                                    <a href="#"> Privacy Policy</a>
                                </div>   
                            </div>
                            
                             <div class="tab-pane fade" id="cancellation" role="tabpanel" aria-labelledby="cancellation-tab">
                            
                                <div class="faq-content-box">
                                    <h4>CANCELLATION POLICY</h4>
                                    <p>If you wish to cancel a job, please email <a href="#">orders@whitepixels.com</a> immediately. As all our orders are customised jobs and cannot be resold, please note, there will be a cancellation fee if the order has been plated and or printed. If the order has been printed, it will be billed in full. If the job has been plated, a fee of £50 per plate will apply. If you believe you have been invoiced in error, please email <a href="#">accounts@whitepixels.com</a> within 7 days of receipt of invoice.</p>
                                </div>   
                            </div>
                            
                            <div class="tab-pane fade" id="proof" role="tabpanel" aria-labelledby="proof-tab">
                                <div class="faq-content-box">
                                    <h4>PROOF APPROVAL AND RETURN POLICY</h4>
                                    <p>All jobs MUST be 'proof approved' before printing, with the exception of business cards. We, Quinn's Belfast (2009) Ltd, do NOT offer returns because all jobs are printed to customer specifications, have been 'proof approved', and cannot be resold. We do not offer exchanges or refunds. By placing a business card order, you are accepting that the artwork has been approved by you, and we, Quinns Belfast (2009) Ltd, do not accept responsibility for incorrect business cards. If your job is damaged, please advise us within 7 days of receipt, by emailing your sales representative. The job MUST be returned to receive a credit. PLEASE NOTE: We do not accept responsibility for any courier issues, once the job has left our premises. We will not accept LIABILITY for any consequential loss due to late delivery. Short shipments will receive a prorated credit and will not be reprinted.</p>
                                </div>  
                            </div> 
                            
                            <div class="tab-pane fade" id="cookies" role="tabpanel" aria-labelledby="cookies-tab">
                                <div class="faq-content-box">
                                    <h4>USE OF COOKIES</h4>
                                    <p>To enable you to place orders in our Online Shop, a long-term cookie will be set when you access specific pages. These are small text files which remain on your computer. The file is only used to enable you to use certain applications, for example our shopping cart system.</p>
                                    <p>Most browsers will accept cookies by default. You can allow or prohibit temporary and stored cookies separately in your security settings. If you deactivate cookies you may lose access to some features on our site and some web pages may not be displayed correctly.</p>
                                    <p>The information stored in our cookies will never be linked to your personal information (name, address etc.) without your express consent.</p>
                                </div>  
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        
      
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
@endpush


