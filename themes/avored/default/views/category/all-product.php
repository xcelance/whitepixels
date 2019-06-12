@extends('layouts.app_new')

@section('meta_title')
@endsection


@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('category', $category) }}
        </nav>
    </div>
</div>
@endsection
@section('productsearch')
   

@endsection
@section('content')
 <div class="product-search">
       <div class="container">
            
           <div class="form-group autocomplete-items ui-widget" >
               <input type="text" class="form-control typewrite" id="searchproduct" placeholder='' data-period="1000" data-type='[ "" ]'>
               <button class="search-btn"></button>
           </div>
           
       </div>
   </div>
        <section class="products-sec">
            <div class="container">
                <div class="">

                            <div class="row">             
                                <div class="col-md-3 col-sm-6 mb-5"> 
                                    <a href="http://122.160.12.75:3044/quinnstheprinters/product/a4-booklets-heavy-cover-gloss-laminated-printing" title="A4 Booklets Heavy Cover Gloss Laminated">
                                    <div class="product-block">
                                        <div class="product-img">
                                            <div class="product-images-wrapper">
                                                <div class="main-media" style="display: block">
                                                    <img alt="A4 Booklets Heavy Cover Gloss Laminated" style="max-height: 300px;" class="card-img-top img-fluid" src="http://122.160.12.75:3044/quinnstheprinters/storage/app/public/uploads/catalog/images/7/v/w/Ud0QKBVhvGUPaacnjeCFAwi3qOV4XnVZNJjVgghn.png">
                                                </div>
                                               </div>
                                            <div class="product-price-tag">
                                                <h4>From <span class="price-number">£165</span></h4>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4>A4 Booklets Heavy Cover Gloss Laminated</h4>
                                        </div>
                                    </div>
                                    </a> 
                                </div>
                            </div>
                    <div class="clearfix"></div>
                        
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
