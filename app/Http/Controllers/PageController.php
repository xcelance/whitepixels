<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Models\Database\Page;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserMail;
use Illuminate\Support\Facades\Auth;
use AvoRed\Framework\Models\Database\User;
use Session;

class PageController extends Controller
{
    /**
     * Display the specified page.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::whereSlug($slug)->first();

        return view('page.show')->with('page', $page);
    }
    public function aboutus()
    {
        $page = Page::whereSlug('about-us')->first();

        return view('page.aboutus')->with('page', $page);
    }
    public function uploadartwork()
    {
        return view('page.artwork');
    }
    public function upload_file($file,$job_id,$i) {

        $destinationPath = public_path('/vendor/avored-default/artwork/'.$job_id); // upload path
   
            if (!file_exists($destinationPath)) {
              mkdir($destinationPath, 0755, true);
            }
        $name = "artwork_".time()."_".$i.'.'.$file->getClientOriginalExtension();
        $destinationPath = $destinationPath;
        $file->move($destinationPath, $name);
        return "/public/vendor/avored-default/artwork/".$job_id."/".$name;
    }
    public function cuttingForme()
    {        
        $lockingdata= DB::table('cutting_forme')
                            ->where("forme_category","Interlocking")
                            ->get();

        $gluedata= DB::table('cutting_forme')
                            ->where("forme_category","Glue")
                            ->get();

        return view('page.cutting-forme')->with('gluedata', $gluedata)->with('lockingdata', $lockingdata);
    }

    public function request_quote()
    {
        $page = Page::whereSlug('request-a-quote')->first();
        $categorylist= DB::table('categories')
                           ->where("parent_id",'<>', null)
                           ->orWhere("parent_id",'<>','')
                           ->get();

        return view('page.request_quote')->with('page', $page)->with('categorylist', $categorylist);
    }
    public function check_jobId(Request $request)
    {
        $check_jobId= DB::table('orderprocess')
                            ->where("job_no",$request->job_id)
                            ->count();
        if($check_jobId > 0){
            echo "true";
        }else{
            echo "false";
        }                  
    }
    public function postuploadartwork(Request $request)
    {
       // echo "<pre>"; print_r($request->all()); 
        $job_id = $request->job_id;
        $files =array();
        $i = 0;
        foreach ($request->artwork_file as $file) {
            $files[] = $this->upload_file($file,$job_id,$i);
            $i++;
        }
        $artwork = DB::table('artwork')->where("job_id",$job_id)->get();
        if(count($artwork) > 0){
            $artwork_files = json_decode($artwork[0]->artwork_files);
            $files = array_merge($artwork_files,$files);
            $files_json =json_encode($files);
            $insert_artwork =  DB::table('artwork')->where("job_id",$job_id)->update(["artwork_files"=>$files_json]);
        }else{

          $files = json_encode($files);  
          $insert_artwork =  DB::table('artwork')->insertGetId(["job_id"=>$request->job_id,"artwork_files"=>$files]);
        }
        $data = array("job_id"=>$job_id);
        $email = $request->artwork_email;
        Mail::send("mail.artwork_mail", $data, function($message) use($email){
         $message->to($email, "<Artwork>")->subject
            ('Artwork Upload Request');
        });
        echo "true";
        //$artwork_file = $this->upload_file($file);                 
    }
    public function samplePacks(){
         return view('page.sample_packs');
    }
    public function postsamplePacks(Request $request){
       
           $SECRET = env('NOCAPTCHA_SECRET');
        $captcha = $request->get('g-recaptcha-response');
        //GET VERIFY RESPONSE DATA
        $CAPTCHARESPONSE = FILE_GET_CONTENTS('https://www.google.com/recaptcha/api/siteverify?secret=' . $SECRET . '&response=' . $captcha);
        $RESPONSEDATA = JSON_DECODE($CAPTCHARESPONSE );
        /*echo "<pre>"; print_r($RESPONSEDATA); echo $RESPONSEDATA->success; die;*/
        if($RESPONSEDATA->success != 1) {

            return redirect()->back()->with('captcha_error', 'captcha error!')->withInput();
        }
        $sample_data = array();
        foreach ($request->all() as $key => $value) {
           if( ($key !="_token") && ($key != "g-recaptcha-response")) {
              $sample_data[$key] = $value;
           }
        }
        $sample_data = json_encode($sample_data);
        $orderprocess =  DB::table('samplepacks')->insertGetId(["cust_info"=>$sample_data]);
        // echo '<pre>';print_r($sample_data);  die; 
        $email = $request->email;
        $company_name = $request->company_name;
        $data = array("name"=>$request->custname);
        Mail::send("mail.samplepacks_mail", $data, function($message) use($email,$company_name){
         $message->to($email, "<".$company_name.">")->subject
            ('Sample Packs Request');
        });


        // $data = array();
        // Mail::send([],[], function($message) use($email,$company_name,$html){
        //  $message->to($email, "<".$company_name.">")->subject
        //     ('Quote Request')
        //     ->setBody($html);
        // });
        // Mail::send("", $data, function($message) use ($html){
        //  $message->to("niraj.pathak@xcelance.com", "<niraj>")->subject
        //     ('Quote Request');
        // });
        return redirect()->back()->with('sample_success', 'Get free sample request Successfully sent!.');
        die;
    }

    public function post_request_quote(Request $request){
     
        $SECRET = env('NOCAPTCHA_SECRET');
        $captcha = $request->get('g-recaptcha-response');
        //GET VERIFY RESPONSE DATA
        $CAPTCHARESPONSE = FILE_GET_CONTENTS('https://www.google.com/recaptcha/api/siteverify?secret=' . $SECRET . '&response=' . $captcha);
        $RESPONSEDATA = JSON_DECODE($CAPTCHARESPONSE );
        /*echo "<pre>"; print_r($RESPONSEDATA); echo $RESPONSEDATA->success; die;*/
        if($RESPONSEDATA->success != 1) {

            return redirect()->back()->with('captcha_error', 'captcha error!')->withInput();
        }
        $expire_date =  date('Y-m-d', strtotime('+2 months'));
        $data_encode = json_encode(array("category"=>$request->get('category'), "product"=>$request->get('product'), "size"=>$request->get('size'), "colors"=>$request->get('colors'),"pages"=>$request->get('pages'),"finishing_req"=>$request->get('finishing_req'), "papertype"=>$request->get('papertype'),"artwork"=>$request->get('artwork'),"quantity"=>$request->get('quantity'),"other"=>$request->get('other'),"extra_info"=>$request->get('extra_info'), 'custname' => $request->get('custname'),'company_name' => $request->get('company_name'),'phone' => $request->get('phone'),'email' => $request->get('email'),'city' => $request->get('city'),'country' => $request->get('country'),'postcode' => $request->get('postcode'),'expire_date' => $expire_date));
        $user_id = (Auth::user())?Auth::user()->id:NULL;

        $email = $request->email;
        $company_name = $request->company_name;

         if (Auth::user()) {   // Check is user logged in
           $orderprocess =  DB::table('orderprocess')->insertGetId(["order_data"=>$data_encode,"user_id"=>Auth::user()->id,"request_type"=>"quote"]);
           $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.time();

           $order_id = "W-".substr(str_shuffle($permitted_chars), 0, 8);
           $job_no = "WP800".$orderprocess."-".strtoupper($request->get('company_name'));
           DB::table('orderprocess')->where('id', $orderprocess)->update(['order_id' => $order_id,'job_no' => $job_no]);
           
        } else {
           $user = User::where("email",$email)->first();
           if(!empty($user)){
             $orderprocess =  DB::table('orderprocess')->insertGetId(["order_data"=>$data_encode,"user_id"=>$user->id,"request_type"=>"quote"]);
           }else{
            $orderprocess =  DB::table('orderprocess')->insertGetId(["order_data"=>$data_encode,"request_type"=>"quote"]); 
           }
           
           $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.time();

           $order_id = "W-".substr(str_shuffle($permitted_chars), 0, 8); 
           $job_no = "WP800".$orderprocess."-".strtoupper($request->get('company_name'));
           DB::table('orderprocess')->where('id', $orderprocess)->update(['order_id' => $order_id,'job_no' => $job_no]);           
        }
      
        // $html = "Hi, ".$request->custname."  <br> Thank you for your quote request. We are currently processing it for you and will contact you with a price shortly."; 
        
        $data = array("username"=> $request->custname,"email"=> $request->company_name, "name"=> $request->custname);
        // $email = 'niraj.pathak@xcelance.com';
        Mail::send("mail.quotation", $data, function($message) use($email,$company_name){
         $message->to($email, "<".$company_name.">")->subject
            ('Quote Request');
        });

        return redirect()->back()->with('quotation_success', 'Your quotation has been successfully sent. We will contact you soon.');
        die;

    }

    public function sendmail(){
      $company_name = 'Ands Raj';
      $email = 'niraj.pathak@xcelance.com';


        Mail::send("mail.register_mail", [], function($message) use($email,$company_name){
         $message->to($email, "<".$company_name.">")->subject
            ('Quote Request');
        });       
    }

    public function getProductsByCatid(Request $request){
         $catid = $request->get('catid');
        // print_r($catid);
        $products = DB::table('category_product')
                           ->where("category_id",$catid)
                           ->get(); 
        $ids = array();
        foreach ($products as $key => $value) {
            $ids[] = $value->product_id;
        }  
         $products = DB::table('products')
                           ->whereIn("id",$ids)
                           ->get();  
        return json_encode($products);
    }
    public function faq(){
         return view('page.faq');
    }
    public function artwork_guide(){
         return view('page.artwork-guide');
    }
    public function contact(){
         return view('page.contact');
    }
    public function legal(){
         return view('page.legal');
    }
    public function change_currency(Request $request){
      session_start();
      if(isset($request["set_cur"])){
            echo $_SESSION['currency'];
            if(!isset($_SESSION['currency'])){
              $_SESSION['currency'] =  $request->currency;
            }
      }else{
        $_SESSION['currency'] =  $request->currency;
        echo "1";
      }
      
    }


}
