@extends('layouts.app_new')

@section('meta_title', 'Quotation Payment Process: WhitePixels')
@section('meta_description', 'Quotation Payment Process')

@section('breadcums')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quote Payement Process</li>
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
                <li class="check-icon">
                    <h6>Details</h6>
                    <span class="timeline-number">2</span>
                </li> 
                <li class="active">
                    <h6>Confirm</h6>
                    <span class="timeline-number">3</span>
                </li> 
            </ol>
        </div>
    </div>
    <div class="container">
            <div class="row">
                @if(Session::has('success_order'))
                      <div class="alert alert-success" style="width:99%">{{ Session::get('success_order') }}</div>
                @endif
                @if(Session::has('error_order'))
                  <div class="alert alert-danger" style="width:99%">{{ Session::get('error_order') }}</div>
                @endif                
            </div>
    </div>
        
        <form action="{{url('quote_place')}}" method="post" id="payment-form">
          {{ csrf_field()}}
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="qid" value="{{$qid}}">

          <section class="proceed-payment-sec">
                <div class="container">  
                                                        
                      <div class="proceed-payment-box">
                         <h2 style="">Proceed To Payment</h2>
                          <div class="dodirect-proceed-block">
                              <span>Amount :</span>
                              <span><b>@if($quotesinfo->quotesdata->quote_currency == 'GBP')£@else€@endif{{$quotesinfo->quotesdata->quote_price}}</b></span>                              
                              <button type="submit" class="ct-btn order_btn"  id="placeorder-btn"> Proceed To Payment</button>
                          </div>
                      </div>
                   
                
                     <div class="proceed-payment-note">
                       <h3>Note:</h3>
                       <ol>
                        <li>
                          Please only click PROCEED TO PAYMENT <b>once</b> to avoid duplicate payments.
                        </li>
                        <li>Please <b>do not</b> refresh / or go back on any payment pages, as this may cause duplicate payments.
                        </li>
                        <li>
                           <p>If you repeatedly face any technical problems with processing any of our payment options, please contact <span class="under-line-span">
                           <a href="#" class="green-underline">accounts@quinnstheprinters.com</a></span> before attempting to pay again.</p>
                        </li>
                        <li>
                           <p>For any payment related issues, please contact <a href="#" class="green-underline">accounts@quinnstheprinters.com</a></span></p>
                        </li>
                       </ol>                       
                     </div>
                   
                

                </div>
          </section>


        
                <!-- Modal -->
                <div id="paymentModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <!-- stripe payment form -->
                        
                           
                              <div class="form-row">
                                <label for="card-element">
                                  Credit or debit card
                                </label>
                                <div id="card-element">
                                  <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                              </div>
                            
                        
                        <style type="text/css">
                                                      /**
                             * The CSS shown here will not be introduced in the Quickstart guide, but shows
                             * how you can use CSS to style your Element's container.
                             */
                            .StripeElement {
                              box-sizing: border-box;

                              height: 40px;

                              padding: 10px 12px;

                              border: 1px solid transparent;
                              border-radius: 4px;
                              background-color: white;

                              box-shadow: 0 1px 3px 0 #e6ebf1;
                              -webkit-transition: box-shadow 150ms ease;
                              transition: box-shadow 150ms ease;
                            }

                            .StripeElement--focus {
                              box-shadow: 0 1px 3px 0 #cfd7df;
                            }

                            .StripeElement--invalid {
                              border-color: #fa755a;
                            }

                            .StripeElement--webkit-autofill {
                              background-color: #fefde5 !important;
                            }
                      </style>
                    @push('scripts')
                        <script src="https://js.stripe.com/v3/"></script>
                       <script type="text/javascript">
                        $(document).on("click","#placeorder-btn",function(){
                          $('#paymentModal').modal('show');                           
                        });
                            // Create a Stripe client.
                        var stripe = Stripe('{{$token}}');

                        // Create an instance of Elements.
                        var elements = stripe.elements();

                        // Custom styling can be passed to options when creating an Element.
                        // (Note that this demo uses a wider set of styles than the guide below.)
                        var style = {
                          base: {
                            color: '#32325d',
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                              color: '#aab7c4'
                            }
                          },
                          invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                          }
                        };

                        // Create an instance of the card Element.
                        var card = elements.create('card', {style: style});

                        // Add an instance of the card Element into the `card-element` <div>.
                        card.mount('#card-element');

                        // Handle real-time validation errors from the card Element.
                        card.addEventListener('change', function(event) {
                          var displayError = document.getElementById('card-errors');
                          if (event.error) {
                            displayError.textContent = event.error.message;
                          } else {
                            displayError.textContent = '';
                          }
                        });

                        // Handle form submission.
                        var form = document.getElementById('payment-form');
                        form.addEventListener('submit', function(event) {
                          event.preventDefault();
                          $(".pay_now_order").prop('disabled', true);
                          stripe.createToken(card).then(function(result) {
                            if (result.error) {
                              // Inform the user if there was an error.
                              var errorElement = document.getElementById('card-errors');
                              errorElement.textContent = result.error.message;
                               $(".pay_now_order").prop('disabled', false);
                            } else {
                              // Send the token to your server.
                              stripeTokenHandler(result.token);
                            }
                          });
                        });

                        // Submit the form with the token ID.
                        function stripeTokenHandler(token) {
                          // Insert the token ID into the form so it gets submitted to the server
                          var form = document.getElementById('payment-form');
                          var hiddenInput = document.createElement('input');
                          hiddenInput.setAttribute('type', 'hidden');
                          hiddenInput.setAttribute('name', 'stripeToken');
                          hiddenInput.setAttribute('value', token.id);
                          form.appendChild(hiddenInput);

                          // Submit the form
                          form.submit();
                          jQuery(".screenloader").show();
                          $('#paymentModal').modal('hide');
                        }
                            </script>
                        @endpush    
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn ct-btn pay_now_order">Pay Now</button>
                      </div>
                    </div>

                  </div>
                </div>
        </form>
     
<div class="screenloader" style="display: none">
<!-- show loader while fetching the price. -->
   <img src="{{url('public/vendor/avored-default/images/loader.gif')}}">
</div>           
@endsection
