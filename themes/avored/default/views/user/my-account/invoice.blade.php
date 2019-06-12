@extends('layouts.invoices')

@section('meta_title','Invoice')
@section('meta_description','Invoice')

@section('invoice-content')
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
                                <th scope="col">#</th>
                                <th scope="col">Order-ID</th>                                
                                <th scope="col">Description</th>                                                                
                                <th scope="col">Quantity</th>
                                <th scope="col">Request Type</th>
                                <th scope="col">Status</th>  
                                <th scope="col">Action</th>                                                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                            @foreach($orders as $order)
                            @if($order->request_type == "quote")

                              <?php $text = $order->orderprocess_data->product->name ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo base64_encode($order->id); ?></td>
                                <td>{{$text}}</td> 
                                <td>1</td>
                                <td>{{strtoupper($order->request_type)}}</td>
                                <td>{{$order->status}}</td> 
                                <td><a href="{{url('my-account/invoice/detail')}}/{{$order->id}}">View</a></td>                               
                              </tr> 

                            @else
                              <?php $text = array(); ?>
                              @foreach($order->orderprocess_data  as $data)
                                <?php $text[] = $data->product->name; ?>

                              @endforeach
                              <?php $text = implode(", ", $text) ?>
 
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo base64_encode($order->id); ?></td>
                                <td>{{$text}}</td> 
                                <td><?php echo count($order->orderprocess_data); ?></td>
                                <td>{{strtoupper($order->request_type)}}</td>
                                <td>{{$order->status}}</td> 
                                <td><a href="{{url('my-account/invoice/detail')}}/{{$order->id}}">View</a></td>                               
                            </tr>  

                            @endif                          
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
