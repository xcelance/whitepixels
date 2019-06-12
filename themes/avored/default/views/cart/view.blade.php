@extends('layouts.app_new')

@section('meta_title', 'Register: AvoRed E commerce')
@section('meta_description', 'Register to Manage your Account for AvoRed E Commerce')

@section('breadcums')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Review Basket</li>
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
        @if($cartProducts !== null && count($cartProducts) > 0)
        <form action="{{url('order_product')}}" method="post" id="payment-form">
          {{ csrf_field()}}
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <section class="order-details-sec">
            <div class="container">        
                <div class="table-responsive order-table basket-table">                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SI.</th>
                                <th scope="col">Product</th>
                                <th scope="col">TAT</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Vat(%)</th> 
                                <th scope="col">Price</th>                               
                                <th scope="col">Total Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php //echo "<pre>"; print_r($cartProducts); die; ?>
                        @php $cnt=1; $total=0; @endphp
                        @foreach($cartProducts as $value)
                            <tr>
                                <td>{{$cnt++}}</td>
                                <td>{{$value->product->name}} @if(isset($value->material)) ({{$value->material}})@endif
                                @if(isset($value->side)) ({{$value->side}})@endif @if(isset($value->orientation)) ({{$value->orientation}})@endif @if(isset($value->printing_side)) ({{$value->printing_side}}) @endif @if(isset($value->finishing_type)) ({{$value->finishing_type}}) @endif @if(isset($value->size)) ({{$value->size}})@endif @if(isset($value->shape)) ({{$value->shape}})@endif @if(isset($value->sleeve_color)) ({{$value->sleeve_color}})@endif @if(isset($value->base)) ({{$value->base}})@endif 

                                @if($value->orderdata->printing_sample)<br> +6 printed samples @endif  @if($value->orderdata->sustainable_paper)<br> +printed on sustainable paper @endif</td>
                                <td>{{$value->orderdata->order_day}} Days</td> 
                                <td>{{$value->orderdata->quantity}}</td> 
                                <?php 
                                  $org_price = $value->org_price; 
                                  $price = $value->org_price;
                                  if($value->orderdata->printing_sample) {
                                       $org_price =  $org_price + $value->orderdata->printing_sample;
                                       $price =  $price + $value->orderdata->printing_sample;
                                  } 
                                  if($value->orderdata->sustainable_paper) {
                                       $org_price =  $org_price + $value->orderdata->sustainable_paper;
                                       $price =  $price + $value->orderdata->sustainable_paper;
                                  }
                                  if($value->orderdata->vat) {

                                       $vat_price =  (int) $org_price * (int) $value->orderdata->vat;
                                       $vat_price =  $vat_price / 100;
                                       $org_price =  $org_price + $vat_price;
                                       /*$price = $price + $vat_price;*/
                                  }
                                ?> 
                                <td>
                                  <?php if($value->orderdata->vat) {
                                       echo $value->orderdata->vat."%";
                                  }else{
                                       echo "N/A";
                                  }  
                                  ?>
                                    
                                </td>
                                <td>{{$value->symbol}}{{$price}}</td>                                
                                <td class="price-td">{{$value->symbol}}{{$org_price}}</td>
                                <td>
                                    <a href="javascript:void(0)" class="action-icon info-icon" data-toggle="modal" data-target="#view_order_model{{$value->id}}"></a>
                                    <a href="{{ route('cart.destroy', $value->id)}}" class="action-icon delete-icon"></a>

                                </td>
                                @php $total += $org_price; $symbol = $value->symbol; @endphp
                            </tr>
                        @endforeach                         
                            <tr>
                                <td colspan="5" class="black-td"></td>
                                <td colspan="" class="grand-total">GRAND TOTAL:</td>
                                <td class="grand-total-price">{{$symbol}}{{ $total }}</td> 
                                <td class="black-td"></td>                                 
                            </tr>
                        </tbody>                      
                    </table>
                    @foreach($cartProducts as $value)
                    <!-- The Modal -->
                        <div class="modal view_order_model" id="view_order_model{{$value->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->

                              <!-- Modal body -->
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="view-order-div">
                                      <ul>
                                        <li>
                                          <h4 class="order-main-heading">Order Details</h4>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Product details</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->product->name}}@if(isset($value->material)), {{$value->material}}@endif @if(isset($value->side)), {{$value->side}}@endif @if(isset($value->orientation)), {{$value->orientation}}@endif @if(isset($value->printing_side)), {{$value->printing_side}} @endif @if(isset($value->finishing_type)), {{$value->finishing_type}} @endif @if(isset($value->size)), {{$value->size}}@endif @if(isset($value->shape)), {{$value->shape}}@endif @if(isset($value->sleeve_color)), {{$value->sleeve_color}}@endif @if(isset($value->base)), {{$value->base}} @endif, x{{$value->orderdata->quantity}}
                                @if($value->orderdata->printing_sample)<br> +6 printed samples @endif  @if($value->orderdata->sustainable_paper)<br> +printed on sustainable paper @endif </span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">PO#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->printing_data->po}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Reference</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->printing_data->reference}}</span>
                                        </li>                                                                           
                                        <li>
                                          <span class="order-left-heading">Proof</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->printing_data->proof}}</span>
                                        </li> 
                                        <li>
                                          <span class="order-left-heading">Sort</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->orderdata->select_sort}}</span>
                                        </li> 
                                        <li>
                                          <span class="order-left-heading">TAT</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->orderdata->order_day}} Days</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Quantity</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->orderdata->quantity}}</span>
                                        </li>                                                                                      
                                      </ul>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="view-order-div delivery-add-div">
                                      <ul>
                                        <li>
                                          <h4 class="order-main-heading">Delivery Address</h4>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Contact Person#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_contact_person}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Contact Number#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_contact_number}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Email#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_email}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Company name#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_business}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Address 1#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_address1}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Address 2#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_address2}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">City#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_city}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Country#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_country}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">County#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_state}}</span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Postal Code#</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->address->delivery_postalcode}}</span>
                                        </li>
                                                                                                                       
                                      </ul>
                                    </div>                                    
                                  </div>
                                </div>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        </div>
                    <!-- end Modal -->
                    @endforeach  
                </div>
            </div>
        </section>
        
        <div class="place-order-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                      <div class="alert alert-danger" style="width:99%;display: none;">Please check terms and conditions.</div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">                            
                                <input type="checkbox" id="customRadio1" name="terms" class="custom-control-input" required="">
                                <label class="custom-control-label" for="customRadio1">I have read and accept the <a href="#">Terms & Conditions</a> of whitepixels.com</label>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label>Plese enter your Promo Code</label>
                            <input class="form-control" placeholder="Promo Code...">
                            <button class="ct-btn apply-btn">Apply Discount</button>
                        </div>
                    </div> -->
                    
                    <div class="col-md-12">
                        <div class="place-btn">
                            <a href="{{url('/')}}" class="ct-btn">Continue Shopping</a>
                            <button type="button" class="ct-btn"  id="placeorder-btn"> Place Order</button>
                        </div>
                    </div>
                </div>
                 
               
            </div>
        </div>
        

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

                            var terms = $("body").find("input[name=terms]");
                            if(terms.prop('checked') == true){
                                $(".alert-danger").hide();
                                $('#paymentModal').modal('show');
                            }else{
                               terms.focus();
                               $(".alert-danger").show();
                            }
                            //$('#paymentModal').modal('show'); 
                        })
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
        @else
         <section class="emptycart-sec">
            <div class="container"> 
                <div class="emptycart-outer">
                    <div class="emptycart">Your cart is empty.</div>
      
                    <div class="place-btn">
                        <a href="{{url('/')}}" class="ct-btn">Continue Shopping</a>                        
                    </div>
                </div>
            </div>
        </section>
        @endif
<div class="screenloader" style="display: none">
<!-- show loader while fetching the price. -->
   <img src="{{url('public/vendor/avored-default/images/loader.gif')}}">
</div>           
@endsection
