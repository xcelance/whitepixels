@extends('layouts.app_new')

@section('meta_title')
    Cutting Forme
@endsection

@section('slider')
<div class="aboutus-banner inner-banner">
    <div class="container">
        <div class="banner-heading">
            <h2>Cutting Formes</h2>
        </div>
    </div>
</div>
@endsection
@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('cutting-forme') }}
        </nav>
    </div>
</div>
@endsection

@section('content')	  
    <section class="cutting-form-sec">
        
            <div class="container">
                
                <div class="cutting-top-nav">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="cutting-formes-tabs">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="ordering-tab" data-toggle="tab" href="#ordering" role="tab" aria-controls="ordering" aria-selected="true">
                                        Interlocking</a>
                                    </li>
                                   <!--  <li class="nav-item">
                                        <a class="nav-link" id="paying-tab" data-toggle="tab" href="#paying" role="tab" aria-controls="paying" aria-selected="false">
                                        Glue_Folders</a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cutting-tabs-nav clearfix">
                                <span class="valign change-text">Change View:</span>
                                <a href="javascript:void(0)" class="valign active grid-btn" data-tab=".tab-grid">
                                    <i class="grid-icon"></i>Grid
                                </a>
                                <a href="javascript:void(0)" class="valign list-btn" data-tab=".tab-list">
                                    <i class="list-icon"></i> List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="download-form-block d-flex">
                    <!-- <a href="#">Download 0 Forms</a> -->
                    <a href="{{url('/public/vendor/avored-default/images/cutting_forme')}}/interlocking.zip" class="ml-auto">Download all forms</a>
                </div>

                <div class="grid-view active">
                   
                    <div class="tab-content cutting-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="ordering" role="tabpanel" aria-labelledby="ordering-tab">
                            <div class="row">
                                @foreach($lockingdata as $ldata)
                                    <div class="col-md-6 col-lg-3">
                                        <div class="cutting-block">
                                            <div class="cutting-form-img">
                                                <img src="{{url('/')}}/{{$ldata->cutting_image}}">
                                            </div>
                                            <div class="cutting-text">
                                                <h4>{{$ldata->name}}</h4>
                                                <ul class="">
                                                    <li>Fin size: {{$ldata->finish_size}}</li>
                                                    <li>Flat size: {{$ldata->flat_size}}</li>
                                                    <li>Paper size: {{$ldata->paper_size}}</li>
                                                </ul>
                                                <div class="download-btn">
                                                    <a href="{{url('/')}}/{{$ldata->cutting_pdf}}" class="ct-btn">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="paying" role="tabpanel" aria-labelledby="paying-tab">
                            <div class="row">
                                 @foreach($gluedata as $gdata)
                                    <div class="col-md-6 col-lg-3">
                                        <div class="cutting-block">
                                            <div class="cutting-form-img">
                                                <img src="{{url('/')}}/{{$gdata->cutting_image}}">
                                            </div>
                                            <div class="cutting-text">
                                                <h4>{{$gdata->name}}</h4>
                                                <ul class="">
                                                    <li>Fin size: {{$gdata->finish_size}}</li>
                                                    <li>Flat size: {{$gdata->flat_size}}</li>
                                                    <li>Paper size: {{$gdata->paper_size}}</li>
                                                </ul>
                                                <div class="download-btn">
                                                    <a href="{{url('/')}}/{{$ldata->cutting_pdf}}" class="ct-btn">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="list-view">
                    <div class="table-responsive-md order-table  cutting-form-table">
                        <table class="table lockingdata">
                            <thead>
                                <tr>
                                   <!--  <th scope="col">
                                        <div class="custom-control custom-checkbox table-check">
                                            <input type="checkbox" id="customRadio1" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1"></label>
                                        </div>
                                    </th> -->
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Paper size</th>
                                    <th scope="col">Finish size, mm</th>
                                    <th scope="col">Flat size, mm</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt=1; ?>
                                @foreach($lockingdata as $ldata)
                                <tr>
                                   <!--  <td scope="col">
                                        <div class="custom-control custom-checkbox table-check">
                                            <input type="checkbox" id="customRadio2" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio2"></label>
                                        </div>
                                    </td> -->
                                    <td><?php echo $cnt++.'.'; ?></td>
                                    <td>{{$ldata->name}}</td>
                                    <td>{{$ldata->paper_size}}</td>
                                    <td>{{$ldata->finish_size}}</td>
                                    <td>{{$ldata->flat_size}}</td>
                                    <td>                                        
                                        <a href="{{url('/')}}/{{$ldata->cutting_pdf}}">DOWNLOAD</a>
                                    </td>
                                </tr>
                                @endforeach                                
                            </tbody>
                        </table>

                        <table class="table gluedata" style="display: none;">
                            <thead>
                                <tr>
                                   <!--  <th scope="col">
                                        <div class="custom-control custom-checkbox table-check">
                                            <input type="checkbox" id="customRadio1" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1"></label>
                                        </div>
                                    </th> -->
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Paper size</th>
                                    <th scope="col">Finish size, mm</th>
                                    <th scope="col">Flat size, mm</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt=1; ?>
                                @foreach($gluedata as $ldata)
                                <tr>
                                    <!-- <td scope="col">
                                        <div class="custom-control custom-checkbox table-check">
                                            <input type="checkbox" id="customRadio2" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio2"></label>
                                        </div>
                                    </td> -->
                                    <td><?php echo $cnt++.'.'; ?></td>
                                    <td>{{$ldata->name}}</td>
                                    <td>{{$ldata->paper_size}}</td>
                                    <td>{{$ldata->finish_size}}</td>
                                    <td>{{$ldata->flat_size}}</td>
                                    <td>                                        
                                        <a href="{{url('/')}}/{{$ldata->cutting_pdf}}">DOWNLOAD</a>
                                    </td>
                                </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        
     
      
@endsection
@push('scripts')
<script type="text/javascript">
   $('.cutting-tabs-nav a').click(function() {
        $('.cutting-tabs-nav .active').removeClass('active');
        $(this).addClass('active');
        
        if ($(".list-btn").hasClass("active")) { 
            $('.list-view').addClass("active");
            $('.grid-view.active').removeClass("active");
        }
        else{
            $('.list-view').removeClass("active");
            $('.grid-view').addClass("active");
        }
    });
   $("#ordering-tab").click(function(){
        if($('.list-view').hasClass("active")){
            $('.lockingdata').show();
            $('.gluedata').hide();
        }
   });
   $("#paying-tab").click(function(){
        if($('.list-view').hasClass("active")){
            $('.gluedata').show();
            $('.lockingdata').hide();
        }
   });
</script>
@endpush


