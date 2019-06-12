@extends('layouts.app_new')

@section('meta_title')
   
@endsection


@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
            {{ Breadcrumbs::render('products', $products) }}
        </nav>
    </div>
</div>
@endsection
@section('productsearch')
<?php 
$product = $products->toArray();
//echo "<pre>"; print_r($product); die;
if(!empty($product)){

$data = array_rand($product,1);
$pro_name  = $product[$data]["name"];
}else{
    $pro_name  = "";
} ?>
    <div class="product-search">
       <div class="container">
            
           <div class="form-group autocomplete-items ui-widget" >
               <input type="text" class="form-control typewrite" id="searchproduct" placeholder='' data-period="1000" data-type='[ "{{$pro_name}}" ]'>
               <button class="search-btn"></button>
           </div>
           <div class="product-view-btn"><button class="ct-btn view_cats" style="display: none">View</button></div>
           
       </div>
   </div>
@endsection
@section('productsearch')


@endsection
@section('content')
        <section class="all-product-nav-sec list-products-sec cat_all">
            <div class="container">
                <div class="row">
                   <?php $tree =  \App\Helpers\AppHelper::instance()->show_categories(); ?>
                            @foreach($tree as $category)
                            <div class="col">
                                <div class="product-list dropdown-list">
                                    <h4>{{$category->name}}</h4>
                                    <ul class="">
                                        @if(isset($category->childs))
                                        @foreach($category->childs as $child_category)
                                         <li><a href="javascript:void(0)" id="{{$child_category->id}}" class="sub_cat">{{$child_category->name}}</a></li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                </div>
                    <div class="request-quote-block">
                         <p>Can't find what you need or have a bespoke requirement?</p>
                          <a href="{{url('request_quote')}}">Request a quote</a>
                    </div>
            </div>
        </section>

        <section class="products-sec">
            <div class="container">
                <div class="">

                            <div class="row cat_products">             
                                                                                    
                            </div>
                    <div class="clearfix"></div>
                        
                 </div>

        
            </div>
        </section>
        <section class="booklet-sec">
            <div class="container">
                <div class="popular-heading">
                    <h2 class="cat_name"></h2>
                </div>
                <div class="booklet-content">
                    <div id="description" class="cat_desc"></div>
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
        jQuery(document).ready(function(){
            jQuery(document).on("click",".sub_cat",function(e){
                    e.preventDefault();
                    var cat_id = $(this).attr("id");
                    var action="{{url('cat_products')}}";
                    jQuery(".cat_all").slideUp();
                    jQuery(".view_cats").show();
                    $.ajax({
                    type: 'get',
                    url: action,
                    async: false,
                    data: {cat_id:cat_id},
                    success: function(response) {
                       
                        var data = JSON.parse(response);
                         console.log(data);
                         var html = "";
                          for (var i = 0; i < data.products.length; i++) {
                            html += '<div class="col-md-3 col-sm-6 mb-5"><a href="<?php echo url("/"); ?>/product/'+data.products[i].slug+'" title="'+data.products[i].name+'"><div class="product-block"><div class="product-img"><div class="product-images-wrapper"><div class="main-media" style="display: block"><img alt="'+data.products[i].name+'" style="max-height: 300px;" class="card-img-top img-fluid" src="<?php echo url("/storage/app/public"); ?>/'+data.products[i].image+'"></div></div><div class="product-price-tag"> <h4>From <span class="price-number">'+data.products[i].symbol+data.products[i].product_price+'</span></h4> </div> </div><div class="product-content"><h4>'+data.products[i].name+'</h4></div></div></a> </div>';
                           }
                        /* if(data.products.length < 1){
                            jQuery(".cat_products").html("<h4>No products found!</h4>");
                         }else{
                             jQuery(".cat_products").html(html);
                         }*/
                           jQuery(".cat_products").html(html);
                          
                           jQuery(".cat_desc").html(data.cat_info.cat_desc);
                           jQuery(".cat_name").html(data.cat_info.cat_name);
                           console.log(html);
                           /**/
                        }
                    });       
                    
            });
                /////////////////////////////////////////////////////

                jQuery(document).on("click",".view_cats",function(e){
                    jQuery(".cat_all").slideDown();
                    jQuery(this).hide();
                });
        });
</script>

 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush
