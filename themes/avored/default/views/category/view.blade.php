
@extends('layouts.app_new')

@section('meta_title')
    {{ $category->name }}
@endsection


@section('breadcrumbs')
<div class="breadcrumb-block product_bread">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('category', $category) }}
        </nav>
    </div>
</div>
@endsection
@section('productsearch')
<?php 
$product = $products->toArray();
if(!empty($product['data'])){

$data = array_rand($product['data'],1);
$pro_name  = $product['data'][$data]["name"];
}else{
    $pro_name  = "";
}
 ?>
    <div class="product-search">
       <div class="container">
            
           <div class="form-group autocomplete-items ui-widget" >
               <input type="text" class="form-control typewrite" id="searchproduct" placeholder='' data-period="1000" data-type='[ "{{$pro_name}}" ]'>
               <button class="search-btn"></button>
           </div>
           
       </div>
   </div>

@endsection
@section('content')
        <section class="products-sec">
            <div class="container">
                <div class="">
                    @if(count($category->products) <= 0)
                        <div class="row">    <p>Sorry No Product Found</p> </div>
                    @else
                    <div class="row">
                            <?php //echo "<pre>"; print_r($products); die; ?>
                            @foreach($products as $product)
                            
                                <div class="col-md-3 col-sm-6 mb-5"> 
                                    <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->name }}">
                                    <div class="product-block">
                                        <div class="product-img">
                                            @include('product.view.product-image',['product' => $product])
                                            <div class="product-price-tag">
                                                <h4>From <span class="price-number">{{$product->symbol}}{{$product->product_price}}</span></h4>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4>{{$product->name}}</h4>
                                        </div>
                                    </div>
                                    </a> 
                                </div>

                            @endforeach
                    </div>
                    <div class="clearfix"></div>
                        {!!  $products->links('pagination.bootstrap-4') !!}
                    @endif
                </div>
            </div>
        </section>
        <section class="booklet-sec">
            <div class="container">
                <div class="popular-heading">
                    <h2>Cheap {{ $category->name }}</h2>
                </div>
                <div class="booklet-content">
                    <div id="description">{!!html_entity_decode($category->description)!!}</div>
                </div>
            </div>
        </section>
@endsection
@push('scripts')


<script src="{{ asset('public/vendor/avored-default/js/bootstrap3-typeahead.min.js')}}"></script>   
<script src="{{ asset('public/vendor/avored-default/js/typeahead.bundle.js')}}"></script>   
<script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
<script type="text/javascript">
    var route = "{{ url('autocomplete') }}";
    var term = '';
    var links = jQuery.get(route, { term: term }, function (data) {
                console.log(data);                
            });
    links = [{name: "abc", link: "http://abc.com"}, 
             {name: "abc2", link: "http://nbc.com"}];
    console.log(links);
    var source = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
            url: route+"?q=%QUERY",
            wildcard: '%QUERY'                    // %QUERY will be replace by users input in
        },
    });    
    
    source.initialize();

    jQuery('#searchproduct').typeahead({ 
        hint: false,
        highlight: true, 
        minLength: 1
        },{      
            name: 'name',
            source:  source.ttAdapter(),
            display: function(item) {       
                return item.name;
            }, 
            limit: 100,
            templates: {                
                suggestion: function(item) {
                    return "<div><a href=\"{{ url('product') }}/"+ item.slug +"\">"+ item.name +"</a></div>";
                }
            }
     
        });
    ////////////////////////////////////////////////////////////////////
                      

                 var TxtType = function(el, toRotate, period) {
                    this.toRotate = toRotate;
                    this.el = el;
                    this.loopNum = 0;
                    this.period = parseInt(period, 10) || 2000;
                    this.txt = '';
                    this.tick();
                    this.isDeleting = false;
                };
                  jQuery(document).ready(function () {
                       localStorage.setItem('searchproduct', 'false');
                       jQuery(document).on("click","#searchproduct",function(){
                            jQuery(this).attr("placeholder",'');
                            localStorage.setItem('searchproduct', 'true');
                       });
                }); 
                window.onclick = function(e) {

                    if(e.target.id != "searchproduct"){
                      localStorage.setItem('searchproduct', 'false');
                        if(localStorage.getItem('searchproduct_show') ==  "show"){
                            var elements = document.getElementsByClassName('typewrite');
                            for (var i=0; i<elements.length; i++) {
                                var toRotate = elements[i].getAttribute('data-type');
                                var period = elements[i].getAttribute('data-period');
                                if (toRotate) {
                                  new TxtType(elements[i], JSON.parse(toRotate), period);
                                }
                            }
                            localStorage.setItem('searchproduct_show',"hide")
                        } 
                    }
                };

                TxtType.prototype.tick = function() {
                    if(localStorage.getItem('searchproduct') == "true"){
                        localStorage.setItem('searchproduct_show',"show")
                        return false;
                    }
                    var i = this.loopNum % this.toRotate.length;
                    var fullTxt = this.toRotate[i];

                    if (this.isDeleting) {
                    this.txt = fullTxt.substring(0, this.txt.length - 1);
                    } else {
                    this.txt = fullTxt.substring(0, this.txt.length + 1);
                    }

                    this.el.placeholder = this.txt;

                    var that = this;
                    var delta = 200 - Math.random() * 100;

                    if (this.isDeleting) { delta /= 2; }

                    if (!this.isDeleting && this.txt === fullTxt) {
                    delta = this.period;
                    this.isDeleting = true;
                    } else if (this.isDeleting && this.txt === '') {
                    this.isDeleting = false;
                    this.loopNum++;
                    delta = 500;
                    }
                    setTimeout(function() {
                    that.tick();
                    }, delta);
                };

                window.onload = function() {
                    var elements = document.getElementsByClassName('typewrite');
                    for (var i=0; i<elements.length; i++) {
                        var toRotate = elements[i].getAttribute('data-type');
                        var period = elements[i].getAttribute('data-period');
                        if (toRotate) {
                          new TxtType(elements[i], JSON.parse(toRotate), period);
                        }
                    }
                };
        /////////////////////////////////////////////////////////   
</script>

 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush
