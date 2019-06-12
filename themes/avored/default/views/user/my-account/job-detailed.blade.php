@extends('layouts.job-detail')

@section('meta_title','Jobs Detail')
@section('meta_description','Jobs Detail')

@section('job-content')
        <section class="customer-address-sec">
            <div class="container">                
                <div class="pagination-block">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="showing-text">
                                <!-- <h4>Showing 0 to 0 of 0 entries</h4> -->
                            </div>
                        </div>
                        <!-- <div class="col-sm-7">
                            <div class="d-flex flex-row-reverse">
                                
                                <select class="pagination-select">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                    <option>250</option>
                                    <option>All</option>
                                </select>

                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link arrow-left" href="#"></a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link arrow-right" href="#"></a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>
                
                
                <div class="table-responsive order-table customer-address-table">
                    <table class="table">
                        <thead>
                               <tr>
                                    <th>Job Id</th>
                                    <th>Product</th>
                                    <th>TAT</th>
                                    <th>Qty</th>
                                    <th>Vat(%)</th> 
                                    <th>Price</th>                               
                                    <th>Total Price</th>
                                    <th>Action</th>
                               </tr>
                           </thead>
                           <tbody>
                            @if($order->request_type == "quote")

                               <?php //echo "<pre>"; print_r($order->orderprocess_data); die; ?>
                               <tr>
                                      <td style="width: 140px">{{strtoupper($order->orderprocess_data->job_id)}}</td>
                                       <td>{{$order->orderprocess_data->product->name}}({{$order->orderprocess_data->category->name}}),{{$order->orderprocess_data->order_data->size}},{{$order->orderprocess_data->order_data->colors}},{{$order->orderprocess_data->order_data->pages}},{{$order->orderprocess_data->order_data->finishing_req}},{{$order->orderprocess_data->order_data->papertype}},({{$order->orderprocess_data->quotesinfo->quote_info->quote_tat}}Days TAT),x{{$order->orderprocess_data->quotesinfo->quote_info->quote_quantity}}</td>
                                       <td>{{$order->orderprocess_data->quotesinfo->quote_info->quote_tat}} Days</td> 
                                       <td>{{$order->orderprocess_data->quotesinfo->quote_info->quote_quantity}}</td> 
                                      
                                        <td>N/A</td>
                                       <td>@if($order->orderprocess_data->quotesinfo->quote_info->quote_currency == 'GBP')£@else€@endif{{$order->orderprocess_data->quotesinfo->quote_info->quote_price}}</td>                                
                                       <td class="price-td"> @if($order->orderprocess_data->quotesinfo->quote_info->quote_currency == 'GBP')£@else€@endif{{$order->orderprocess_data->quotesinfo->quote_info->quote_price}}</td>
                                       <td>
                                       <a href="javascript:void(0)" class="" data-toggle="modal" data-target="#view_order_model{{$order->orderprocess_data->id}}">View</a>
                                   </td>
                                   </tr>
                                       <tr>
                                           <td colspan="5" class="black-td"></td>
                                           <td  class="grand-total"><strong>GRAND TOTAL:</strong></td>
                                           <td class="grand-total-price"><strong>@if($order->orderprocess_data->quotesinfo->quote_info->quote_currency == 'GBP')£@else€@endif{{$order->orderprocess_data->quotesinfo->quote_info->quote_price}}</strong></td> 
                                           <td class="black-td"></td>                                 
                                       </tr>

                            @else
                            <?php //echo "<pre>"; print_r($order->orderprocess_data); die; ?>
                                @php $cnt=1; $total=0; @endphp
                                @foreach($order->orderprocess_data as $value)
                               <tr>
                                   <td>{{strtoupper($value->job_id)}}</td>
                                   <td>{{$value->product->name}} @if($value->material) ({{$value->material}})@endif
                                   @if(isset($value->side)) ({{$value->side}})@endif @if(isset($value->orientation)) ({{$value->orientation}})@endif @if(isset($value->printing_side)) ({{$value->printing_side}}) @endif @if(isset($value->finishing_type)) ({{$value->finishing_type}}) @endif @if(isset($value->size)) ({{$value->size}})@endif @if(isset($value->shape)) ({{$value->shape}})@endif @if(isset($value->sleeve_color)) ({{$value->sleeve_color}})@endif @if(isset($value->base)) ({{$value->base}})@endif

                                    @if($value->orderdata->printing_sample)<br> +6 printed samples @endif  @if($value->orderdata->sustainable_paper)<br> +printed on sustainable paper @endif</td>
                                   <td>{{$value->orderdata->order_day}} Days</td> 
                                   <td>{{$value->orderdata->quantity}}</td> 
                                   <?php 
                                      $org_price = $value->org_price; 
                                      $price = $value->product_price;
                                     
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
                                   <a href="javascript:void(0)" class="" data-toggle="modal" data-target="#view_order_model{{$value->id}}">View</a>
                               </td>
                                   @php $total += $org_price; $symbol = $value->symbol; @endphp
                               </tr>
                           @endforeach
                                   <tr>
                                       <td colspan="5" class="black-td"></td>
                                       <td  class="grand-total"><strong>GRAND TOTAL:</strong></td>
                                       <td class="grand-total-price"><strong>{{$symbol}}{{ $total }}</strong></td> 
                                       <td class="black-td"></td>                                 
                                   </tr>
                             @endif      
                           </tbody>

                    </table>
                </div>
                
               <!--  <div class="pagination-block mt-3">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="showing-text">
                                <h4>Showing 0 to 0 of 0 entries</h4>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="d-flex flex-row-reverse">
                                
                                <select class="pagination-select">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                    <option>250</option>
                                    <option>All</option>
                                </select>


                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link arrow-left" href="#"></a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link arrow-right" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                
            </div>
        </section>
@if($order->request_type == "quote")
                    <div class="modal view_order_model" id="view_order_model{{$order->orderprocess_data->id}}">
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
                                              <span class="order-desc">{{$order->orderprocess_data->product->name}}({{$order->orderprocess_data->category->name}}),{{$order->orderprocess_data->order_data->size}},{{$order->orderprocess_data->order_data->colors}},{{$order->orderprocess_data->order_data->pages}},{{$order->orderprocess_data->order_data->finishing_req}},{{$order->orderprocess_data->order_data->papertype}},({{$order->orderprocess_data->quotesinfo->quote_info->quote_tat}}Days TAT),x{{$order->orderprocess_data->quotesinfo->quote_info->quote_quantity}}</span>
                                            </li>

                                            <li>
                                              <span class="order-left-heading">PO#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->orderprocess_data->printing_data->po}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Reference</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->orderprocess_data->printing_data->reference}}</span>
                                            </li>                                                                           
                                            <li>
                                              <span class="order-left-heading">Proof</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->orderprocess_data->printing_data->proof}}</span>
                                            </li> 
                                            <li>
                                              <span class="order-left-heading">Sort</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">1</span>
                                            </li> 
                                            <li>
                                              <span class="order-left-heading">TAT</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->orderprocess_data->quotesinfo->quote_info->quote_tat}} Days</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Quantity</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->orderprocess_data->quotesinfo->quote_info->quote_quantity}}</span>
                                            </li> 
                                           
                                                                                
                                          </ul>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="view-order-div delivery-add-div">
                                          <ul>
                                            <li>
                                              <h4 class="order-main-heading">Shipping Address</h4>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Contact Person#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_contact_person}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Contact Number#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_contact_number}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Email#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_email}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Company name#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_business}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Address 1#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_address1}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Address 2#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_address2}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">City#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_city}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Country#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_country}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">County#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_state}}</span>
                                            </li>
                                            <li>
                                              <span class="order-left-heading">Postal Code#</span>
                                              <span class="dot">:</span>
                                              <span class="order-desc">{{$order->address->delivery_postalcode}}</span>
                                            </li>
                                                                                                                           
                                          </ul>
                                        </div>                                    
                                      </div>
                                    </div>
                                  </div>
 <?php //echo "<pre>"; print_r($order); die; ?> 
                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  </div>

                                </div>
                              </div>
                            </div>
                        <!-- end Modal -->


@else
       @foreach($order->orderprocess_data as $value)
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
                                          <h4 class="order-main-heading">Order Details(<?php echo base64_encode($order->id)?>){{$order->status}}</h4>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Product details</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">{{$value->product->name}} @if($value->material) ({{$value->material}})@endif
                                @if(isset($value->side)) ({{$value->side}})@endif @if(isset($value->orientation)) ({{$value->orientation}})@endif @if(isset($value->printing_side)) ({{$value->printing_side}}) @endif @if(isset($value->finishing_type)) ({{$value->finishing_type}}) @endif @if(isset($value->size)) ({{$value->size}})@endif @if(isset($value->shape)) ({{$value->shape}})@endif @if(isset($value->sleeve_color)) ({{$value->sleeve_color}})@endif @if(isset($value->base)) ({{$value->base}})@endif

                                    @if($value->orderdata->printing_sample)<br> +6 printed samples @endif  @if($value->orderdata->sustainable_paper)<br> +printed on sustainable paper @endif</span>
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
                                        <li>
                                          <span class="order-left-heading">Dispatch Date</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">
                                          @php
                                           echo $newDate = date("d M,Y",strtotime($value->orderdata->dispatch_date));


                                          @endphp
                                          </span>
                                        </li>
                                        <li>
                                          <span class="order-left-heading">Order completed Date</span>
                                          <span class="dot">:</span>
                                          <span class="order-desc">
                                          @php
                                           echo $newDate = date("d M,Y",strtotime($value->orderdata->order_date));


                                          @endphp</span>
                                        </li>                                                                                    
                                      </ul>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="view-order-div delivery-add-div">
                                      <ul>
                                        <li>
                                          <h4 class="order-main-heading">Shipping Address</h4>
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
@endif                       
@endsection
