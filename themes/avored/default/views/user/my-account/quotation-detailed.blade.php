@extends('layouts.quote-detail')

@section('meta_title','Quote Detail')
@section('meta_description','Quote Detail')

@section('quote-content')
    <section class="quote-detail-sec">
      <div class="container">
      	<div class="table-responsive">
         <table class="table table-vertical-middle table-striped quote-table">
            <tbody>
            <?php //echo '<pre>';print_r($quotes);die;?>
                       <tr>
                            <th>Quote Id</th>
                            <td><b>{{$quotes->order_id}}</b></td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{$quotes->product->name}}: {{$quotes->orderdata->size}} {{$quotes->product->name}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{$quotes->product->name}}({{$quotes->category->name}}),{{$quotes->orderdata->size}},{{$quotes->orderdata->colors}},{{$quotes->orderdata->pages}},{{$quotes->orderdata->finishing_req}},{{$quotes->orderdata->papertype}},({{$quotesinfo->quotesdata->quote_tat}}Days TAT),x{{$quotesinfo->quotesdata->quote_quantity}}</td>
                        </tr>
                        <tr>
                            <th>Sorts</th>
                            <td>1</td>
                        </tr>
                        <tr>
                            <th>Flat Size</th>
                            <td>{{$quotes->orderdata->size}}</td>
                        </tr>
                        <tr>
                            <th>Finished Size</th>
                            <td>{{$quotes->orderdata->finishing_req}}</td>
                        </tr>
                        <tr>
                            <th>Orientation</th>
                            <td>Portrait</td>
                        </tr>
                        <tr>
                            <th>Full Colour</th>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <th>Proof Type</th>
                            <td>None</td>
                        </tr>
                        <tr>
                            <th>Paper Stock</th>
                            <td>{{$quotes->orderdata->papertype}}</td>
                        </tr>
                        <tr>
                            <th>Quoted Date</th>
                            <td><?php echo explode(" ", $quotes->order_at)[0]; ?></td>
                        </tr>
                        <tr>
                            <th>Quote Expiry Date</th>
                            <td>@if(isset($quotes->orderdata->expire_date)){{$quotes->orderdata->expire_date}}@endif</td>
                        </tr>
                        <tr>
                            <th>Vat Include</th>
                            <td>No</td>
                        </tr>
            </tbody>
        </table>
      </div>
     <?php //echo "<pre>"; print_r($quate_status); die; ?>
      @if(isset($quate_status["status"]))
              <div class="quote-quantity table-responsive">
                        <table class="table table-vertical-middle">
                            <tbody>
                                <tr>
                                    <th class="center-align">Your Order has been {{$quate_status["status"]}}</th>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

      @else
            <div class="quote-quantity table-responsive">
                <table class="table table-vertical-middle">
                   <thead>
                        <tr>
                            <th class="center-align">Quantity</th>
                            <th class="center-align">Prepaid Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="center-align">{{$quotesinfo->quotesdata->quote_quantity}}</th>
                            <td class="center-align">@if($quotesinfo->quotesdata->quote_currency == 'GBP')£@else€@endif{{$quotesinfo->quotesdata->quote_price}} </td>
                            <td class="center-align">
	                              <!-- Cancelled quote-->
	                              <!-- Completed and Estimated quotes-->
	                            <div class="place-order-btn">
	                                <a href="{{url('/my-account/quote/payment')}}/{{$quotes->id}}" class="btn">  
	                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Place Order
	                                </a>
	                            </div>
                            </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        @endif    
      </div>
    </section>
@endsection
