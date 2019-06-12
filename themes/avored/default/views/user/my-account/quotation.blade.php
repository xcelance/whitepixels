@extends('layouts.quotes')

@section('meta_title','My Quotes')
@section('meta_description','My Quotes')

@section('quote-content')
        <section class="customer-address-sec">
            <div class="container">
                    <div class="row">
                        @if(Session::has('success_order'))
                              <div class="alert alert-success" style="width:99%">{{ Session::get('success_order') }}</div>
                        @endif
                        @if(Session::has('error_order'))
                          <div class="alert alert-danger" style="width:99%">{{ Session::get('error_order') }}</div>
                        @endif                
                    </div>                
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
                                <th scope="col">#</th>
                                <th scope="col">Quote-ID</th>                                
                                <th scope="col">Description</th>                                                                
                                <th scope="col">Quoted Date</th>
                                <th scope="col">Expiration Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                        <?php //echo "<pre>"; print_r($quotes); die; ?>
                            @foreach($quotes as $quote)                             
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td style="width: 145px;"><?php echo $quote->order_id; ?></td>
                                <td>{{$quote->product->name}}({{$quote->category->name}}),{{$quote->orderdata->size}},{{$quote->orderdata->colors}},{{$quote->orderdata->pages}},{{$quote->orderdata->finishing_req}},{{$quote->orderdata->papertype}},({{$quote->quotesdata->quote_tat}}Days TAT),x{{$quote->quotesdata->quote_quantity}}</td> 
                                <td><?php echo explode(" ", $quote->order_at)[0]; ?></td>
                                <td>@if(isset($quote->orderdata->expire_date)){{$quote->orderdata->expire_date}}@endif </td> 
                                <td><a href="{{url('my-account/quote/detail')}}/{{$quote->id}}">View</a></td>                               
                            </tr>                            
                            @endforeach                           
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

       
@endsection
