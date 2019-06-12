@extends('layouts.app_new')

@section('slider')
<div class="faq-banner inner-banner">
            <div class="container">
                <div class="banner-heading">
                    <h2>faq- <br>Frequently Asked Questions</h2>
                </div>
            </div>
        </div>
@endsection
@section('breadcrumbs')
<div class="breadcrumb-block">
    <div class="container">
        <nav aria-label="breadcrumb">
        {{ Breadcrumbs::render('faq') }}
        </nav>
    </div>
</div>
@endsection

@section('content')	  
        
        <section class="faq-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="faq-list">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item faq-list-heading">
                                    <h4 class="faq-list-heading">Please choose question category</h4>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="ordering-tab" data-toggle="tab" href="#ordering" role="tab" aria-controls="ordering" aria-selected="true">
                                        <i class="faq-list-icon"></i>Ordering</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="paying-tab" data-toggle="tab" href="#paying" role="tab" aria-controls="paying" aria-selected="false">
                                        <i class="faq-list-icon faq-database-icon"></i>Paying</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="artwork-tab" data-toggle="tab" href="#artwork" role="tab" aria-controls="artwork" aria-selected="false">
                                        <i class="faq-list-icon faq-image-icon"></i>Artwork</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="tracking-tab" data-toggle="tab" href="#tracking" role="tab" aria-controls="tracking" aria-selected="false">
                                        <i class="faq-list-icon faq-map-maker-icon"></i>Tracking</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="turnaround-tab" data-toggle="tab" href="#turnaround" role="tab" aria-controls="turnaround" aria-selected="false">
                                        <i class="faq-list-icon faq-hourglass-icon"></i>Turnaround Times</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" role="tab" aria-controls="additional" aria-selected="false">
                                        <i class="faq-list-icon faq-plus-icon"></i>Additional Services</a>
                                </li>

                            </ul>
                        </div>

                    </div>
                    
                    <div class="col-lg-9">
                        <div class="tab-content faq-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="ordering" role="tabpanel" aria-labelledby="ordering-tab">
                                <div class="faq-content-box">
                                    <h4>HOW DO I ORDER?</h4>
                                    <ul class="">
                                        <li>Select the product that your want from the products menu.</li>
                                        <li>Specify the paper, sides to be printed, quantity and turnaround days and click on “Order Now”.</li>
                                        <li>Follow the instructions and click on “Place Order”. You will then be asked to pay for the job.</li>
                                        <li>After the job is paid for, you will receive a confirmation email with the job reference number indicating a successful order. E.g. QTP12345.</li>
                                        <li>Please use that job reference number for all the communication with Quinns regarding that job.</li>
                                        <li>If you have any difficulties, please don’t hesitate to contact us.</li>
                                    </ul>
                                </div>
                                
                                <div class="faq-content-box">
                                    <h4>ORDER CUT OFF TIME?</h4>
                                    <ul class="">
                                        <li>Is there any cut off time for placing the order each day?</li>
                                        <li>In the case of a PDF job, if a job is placed before 5pm and approved before 6pm of the same day, we process the job on that day. If no proof is required the cut off time for placing the order is 5pm. This does not apply to 1day TAT jobs which in all cases should be approved  before 3pm on the day that the order is placed.</li>
                                        <li>When no proof is required the order must be placed before 5pm. Again, this does not apply  to 1day TAT jobs which in all cases should be ordered before 3pm.</li>
                                    </ul>
                                </div>
                                
                            
                            </div>
                            <div class="tab-pane fade" id="paying" role="tabpanel" aria-labelledby="paying-tab">
                                <div class="faq-content-box">
                                    <h4>WHEN DO I PAY?</h4>
                                    <ul class="">
                                        <li>If ordering through our website, you will be asked for payment before your order is confirmed.</li>
                                        <li>If you have requested a quote, our team will provide you with a top-up link once you confirm the job.</li>
                                    </ul>
                                </div>
                                
                                <div class="faq-content-box">
                                    <h4>HOW DO I PAY?</h4>
                                    <ul class="">
                                        <li>We offer standard e-commerce payment options.</li>
                                        <li>If you need help making a payment please don’t hesitate to contact us.</li>
                                    </ul>
                                </div>
                                
                                 <div class="faq-content-box">
                                    <h4>WHERE'S MY INVOICE?</h4>
                                    <ul class="">
                                        <li>You will receive an email containing the invoice once the job status changes to complete.</li>
                                        <li>You may also view any of your previous invoices by searching for the job in the customer area.</li>
                                    </ul>
                                </div>
                                
                            </div>
                            
                            <div class="tab-pane fade" id="artwork" role="tabpanel" aria-labelledby="artwork-tab">
                                
                                <div class="faq-content-box">
                                    <h4>WHAT IS ARTWORK BLEED?</h4>
                                    <ul class="">
                                        <li>We require Bleed to allow for tolerance in the print and finishing process.</li>
                                        <li>If a design finishes exactly at the edge of the required finished size, then without bleed, when the job is trimmed there may be slight white edges to the finished print. By extending the background colour or image beyond the edge of the finished job, this defect can be rectified. We recommend that elements intended to go to the very edge of the finished job should extend 3mm beyond the edge.</li>
                                        <li>Similarly, within the printed area a quiet area of 5mm from the edge of the job should be allowed. Important elements of the design should not be placed in the quiet area. This prevents important features such as text from being cut off due to alignment tolerances, and where misalignment occurs it will be much less noticeable. For example a 2mm border on a business card which is cut with a misalignment of 1mm will look unbalanced.</li>
                                    </ul>
                                </div>
                                <div class="faq-content-box">
                                    <h4>HOW DO I UPLOAD MY ARTWORK?</h4>
                                    <ul class="">
                                        <li>You will receive a link to the artwork upload page in the confirmation email of placing your job.</li>
                                        <li><a href="#">You can also click here to upload your artwork.</a></li>
                                    </ul>
                                </div>
                                <div class="faq-content-box">
                                    <h4>WHAT FORMAT DOES MY ARTWORK NEED TO BE?</h4>
                                    <ul class="">
                                        <li>The artwork should be in Press ready PDF ( font embedded) format, CMYK format, with a minimum of 300dpi resolution.</li>
                                        <li>We process only in CMYK format.</li>
                                        <li>If there are any Spot colors in the artwork, it will be converted to CMYK.</li>
                                    </ul>
                                </div>
                                
                                <div class="faq-content-box">
                                    <h4>HOW DO I PREPARE MY ARTWORK FOR UPLOAD?</h4>
                                    <ul class="">
                                        <li>
                                            <a href="#">For a less detailed description please view our artwork-guide.</a>
                                        </li>
                                        <li>
                                            <strong>Page size</strong> Ensure your artwork is on the correct page size. You can download our standard page sizes from the artwork guide.</li>
                                        <li>
                                            <strong>Bleed</strong>Make sure there is a 3mm bleed around the finished artwork . Bleed is required to allow for the tolerance of guillotines used in the finishing/cutting of the job and eliminate any margin of error. We recommend a 4mm clearance from trim size for all important elements - text, imagery etc.
                                        </li>
                                        <li>
                                            <strong>Processing colours</strong>There are four basic, universal colours in the printing industry: Cyan, Magenta, Yellow and Black. Unless you are using a 5th (spot) colour in your document everything should fall within these four colours, including Pantones, unless the Pantone is a 5th color. If you plan to use Pantones for fills, be sure to convert them to CMYK or use Pantone to Process. Watch the Pantone conversion as colour shifts will occur.
                                        </li>
                                        <li>
                                            <strong>Font</strong>Please make sure all fonts used in the artwork are embedded while producing your PDF. Where you have used a rate font outside the ‘normal’ range we recommend converting the text created with this font into curves, paths or outlines - dependent upon the software package being used. This means that we do not necessarily require the original font when we print your job.
                                        </li>
                                        <li>
                                            <strong>Flattening</strong>Always flatten the layers in your artwork before converting to PDF. This eliminates any problems with special effects (Drop shadows, Embossing, Feather, external plug-ins ef- fects etc.) at the time of processing at a later stage. It will also reduce the size of your pdf and speed up processing time.
                                        </li>
                                        <li>
                                            <strong>Overprint</strong>This is the problem in which artwork to press looks perfect on screen, but dreadful in print. E.g. when areas of solid black allow images behind to show through. The overprint settings need to be set correctly before going to press, which is why modern page layout pro- grams such as InDesign and pre-press programs like Acrobat have built-in PDF overprint Preview options. Please check PDF by “Overprint Preview ON” (Shift+Ctrl+7 for Windows), (Shift+Command+7 for Mac). These allow you to spot potential over printing problems before the become expensive!
                                        </li>
                                        <li>
                                            <strong>Booklets</strong> All PDF’s should be single sided pages with cut marks/bleed and not created as spreads.
                                        </li>
                                        <li>
                                            <strong>Incorrect blending options</strong>In setting up blends where the colour fades, we have commonly found that one colour is set at 100% and fades to white or 0% of the starting and sometimes different colour. Please refrain from setting up your blends like this as it causes unexplainable banding. While it may seem logical to do so, this is not practical because white is not considered a colour in the print- ing world and realistically you cant’ have a 0% of any colour. When setting up your blends, set your ending colour at a minimum of 1% of your starting colour. This will insure against any blending problems.If you are using a 5th colour for a blend, start at your Pantone and end at a minimum of 1% of that same Pantone.
                                        </li>
                                        <li>
                                            <strong>Resolution</strong> Images should be 300 dpi with a minimum of 200dpi. Any less will result in a blocky image.
                                        </li>
                                        <li>
                                            <strong>File size</strong>Unnecessarily large files will cause a slow down in the processing of your files. An image for and A4+3mm bleed at 300dpi is absolutely NO larger than 40MB. Anything beyond that and the laws of negative returns comes into play. Please to file size question for help reducing file sizes.
                                        </li>
                                    </ul>
                                </div>
                                
                                 <div class="faq-content-box">
                                    <h4>HOW DO I REDUCE THE FILE SIZE?</h4>
                                    <ul class="">
                                        <li>If an image is going to be resized up or down in your publication we offer the following sizing conventions:</li>
                                        <li>You can safely enlarge your image to 120% of its original size in the application. Anything beyond that and the resampling rate degrades the quality of the image.</li>
                                        <li>When reducing the image in size, anything below 75% of its original size results in a 23MB file. That equates to less processing time.</li>
                                    </ul>
                                </div>
                                
                            </div>
                            
                            
                             <div class="tab-pane fade" id="tracking" role="tabpanel" aria-labelledby="tracking-tab">
                                <div class="faq-content-box">
                                    <h4>WHERE’S MY JOB?</h4>
                                    <ul class="">
                                        <li>You get emailed updates whenever the status of your job changes.</li>
                                        <li><a href="#">You can also track the status of your job here.</a></li>
                                    </ul>
                                </div>
                                 
                                 <div class="faq-content-box">
                                    <h4>WHERE’S MY DELIVERY?</h4>
                                    <ul class="">
                                        <li>We email you the details of the Courier Company and tracking number when the job is dispatched from our factory.</li>
                                        <li>You will then need to use the couriers website to track your order once dispatched from us.</li>
                                    </ul>
                                </div>
            
                            </div>
                            
                             <div class="tab-pane fade" id="turnaround" role="tabpanel" aria-labelledby="turnaround-tab">
                                <div class="faq-content-box">
                                    <h4>HOW DOES TURN AROUND TIME (TAT) WORK?</h4>
                                    <!--table-->
                                    <div class="turnaround-time-table table-responsive">
                                      <table class="bordered tat-table highlight centered">
                                        <thead>
                                        <tr>
                                            <th>TAT</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Same-day</td>
                                            <td>Approved before 12 pm<br>Shipped</td>
                                            <td>Arrive</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Approved</td>
                                            <td>Shipped</td>
                                            <td>Arrive</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Approved</td>
                                            <td></td>
                                            <td>Shipped</td>
                                            <td>Arrive</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr><td>3</td>
                                            <td>Approved</td>
                                            <td></td>
                                            <td></td>
                                            <td>Shipped</td>
                                            <td>Arrive</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Approved</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Shipped</td>
                                            <td>Arrive</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Approved</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Shipped</td>
                                            <td>Arrive</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                <p>
                                    <a href="#collapse" class="" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse" style="margin-top: 15px;display: inline-block;margin-bottom: 10px;">Explanation...</a>
                                    </p>
                                    <div class="collapse" id="collapse" aria-expanded="false">
                                        <p>TAT starts from the date of approval and ends at the date of dispatch from Quinns.</p>
                                        <p>1 day TAT mean, if the job is approved on Monday, the job will be shipped from Quinns 1 business day later, i.e. on Tuesday.</p>
                                        <p>2 days TAT means, if the job is approved on Monday, the job will be shipped from Quinns 2 business says later, i.e. on Wednesday.</p>
                                        <p>3 days TAT means, if the job is approved on Monday, the job will be shipped from Quinns 3 business days later, i.e. on Thursday.</p>
                                        <p>4 days TAT means, if the job is approved on Monday, the job will be shipped from Quinns 4 business days later, i.e. on Friday.</p>
                                        <p>5 days TAT means, if the job is approved on Monday, the job will be shipped from Quinns 5 business days later, i.e. on the following Monday.</p>
                                    </div>
                                <p></p>
                            </div>
                            <!--table end-->
                                  <h4>ORDER CUT OFF TIME?</h4>
                                   <p>Is there any cut off time for placing the order each day?</p>
                                    <ul class="">
                                        <li>In the case of a PDF job, if a job is placed before 5pm and approved before 6pm of the same day, we process the job on that day. If no proof is required the cut off time for placing the order is 5pm. This does not apply to 1day TAT jobs which in all cases should be approved before 3pm on the day that the order is placed.</li>
                                        <li>When no proof is required the order must be placed before 5pm. Again, this does not apply to 1day TAT jobs which in all cases should be ordered before 3pm.</li>
                                    </ul>
                                </div>
            
                            </div>
                            <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                                <div class="faq-content-box">
                                    <h4>DO YOU OFFER A WHITE-LABEL PRODUCT?</h4>
                                    <ul class="">
                                        <li>Yes, Quinns pride ourselves on being a Trade printer.</li>
                                        <li>All orders are dealt with as a White-label and we ensure none of our branding is visible on arrival at your customer.</li>
                                        <li>Please feel free to contact our team if you have further questions regarding this.</li>
                                    </ul>
                                </div>
            
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
      
@endsection
@push('scripts')
<script type="text/javascript">
    jQuery(document).ready(function(){
        var hash = window.location.hash;
        if(hash == "#tat"){
            jQuery(".faq-list ul li a").each(function(){
                jQuery(this).removeClass("active");
            });
            jQuery("#turnaround-tab").addClass("active");

            jQuery(".faq-content div").each(function(){
                jQuery(this).removeClass("active");
                jQuery(this).removeClass("show");
            });
            jQuery("#turnaround").addClass("active");
            jQuery("#turnaround").addClass("show");
        }
        jQuery("#select_category").on("change", function(){
            var catid = jQuery(this).val();
            var links = jQuery.get("{{url('getproductsbycat')}}", { catid: catid }, function (data) {
            var prodData = JSON.parse(data);

            var html = '<option>Select Product</option>'
            for(i=0; i<prodData.length;i++){
                html += '<option value="'+prodData[i].id+'">'+prodData[i].name+'</option>';
            }
            jQuery("#select_product").html(html);
        });        
    });
});
</script>
@endpush


