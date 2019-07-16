<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Models\Database\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Events\OrderPlaceAfterEvent;
use App\Http\Requests\PlaceOrderRequest;
use AvoRed\Framework\Payment\Facade as Payment;
use AvoRed\Framework\Cart\Facade as Cart;
use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Models\Database\Order;
use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Models\Database\Address;
use AvoRed\Framework\Models\Database\OrderProductVariation;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Contracts\OrderHistoryInterface;
use App\Http\Requests\MyAccount\Order\OrderReturnRequest;
use AvoRed\Framework\Models\Contracts\OrderReturnRequestInterface;
use AvoRed\Framework\Models\Contracts\OrderReturnProductInterface;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
    */
    protected $repository;
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\OrderReturnRequestRepository  $orderReturnRequestRepository
    */
    protected $orderReturnRequestRepository;
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\OrderReturnProductRepository  $orderReturnProductRepository
    */
    protected $orderReturnProductRepository;

    /**
     * Construct to setup Repository
     *
     */
    public function __construct(
        ConfigurationInterface $rep,
        OrderReturnRequestInterface $orderReturnRequestRepository,
        OrderReturnProductInterface $orderReturnProductRepository
    ) {
        parent::__construct();

        $this->repository = $rep;
        $this->orderReturnRequestRepository = $orderReturnRequestRepository;
        $this->orderReturnProductRepository = $orderReturnProductRepository;
    }

    public function place(Request $request)
    {

        $user_id  = $request->user_id;

        $get_cart= DB::table('cart')
                       ->where("user_id",Auth::user()->id)
                       ->get();
        $total = 0;
        $cart_data = array();  

            ////////////////////////////////////////////
            foreach ($get_cart as $cartProduct) {

                $get_orderprocess= DB::table('orderprocess')
                                   ->where("id",$cartProduct->orderprocess_id)
                                   ->first();

                $get_orderprocess_data = json_decode($get_orderprocess->order_data);
                $cartProduct->orderdata = json_decode($get_orderprocess->order_data);
                $cartProduct->printing_data = json_decode($get_orderprocess->printing_data);
                $get_order = DB::table('product_custom_fields')
                                       ->where("id",$get_orderprocess_data->custom_field_id)
                                       ->first(); 
                $cartProduct->job_id = $get_orderprocess->job_no;                       
                //echo "<pre>"; print_r($get_orderprocess); die;                       
                  //////////////////////////////////////////////                       
                    $selected_day = $cartProduct->orderdata->order_day;
                    $pound_org_price = $get_order->custom_price_pound;   
                    $base_price = $pound_org_price;
                    $EUR_price = $this->get_euro_price($base_price);
                    $euro_org_price = $EUR_price;
                    $prepare_days = $get_order->prepare_days;
                    $tat_price_pound = json_decode($get_order->tat_price_pound);
                    $tat_price = json_decode($get_order->tat_price_pound);
                    $tat_days = json_decode($get_order->tat_days);
                     $tat_price_euro = array();
                      foreach ($tat_price_pound as $key => $value) {
                        $tat_price_euro[] = $this->get_euro_price($value);
                      }
                    $currency = Auth::user()->currency;

                    $price = array();
                    $price["quantity"]  = $get_order->custom_quantity;
                    $sort = $cartProduct->orderdata->select_sort;
                    if($currency == "GBP"){
                      if(!empty($tat_days)){
                           $count = 0;
                           for($i = 0; $i < count($tat_days); $i++){
                                 $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>$tat_price[$i],"day"=>$tat_days[$i],"sort"=>$sort);
                           }
                       }
                      /*$price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>0,"day"=>$prepare_days,"sort"=>$sort);
                      if(!empty($tat_price_pound)){
                          $count = 0;
                          for($i = $prepare_days - 1; $i >= $prepare_days - count($tat_price_pound); $i--){

                             for($k = $count;$k < count($tat_price_pound);$k++){
                                $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>$tat_price_pound[$k],"day"=>$i,"sort"=>$sort);
                                break;
                             }
                             $count++;

                          }

                      }*/
                    }else{

                      if(!empty($tat_days)){
                          $count = 0;
                          for($i = 0; $i < count($tat_days); $i++){
                                $price["price"][] = array("symbol"=>"€","price"=>$EUR_price,"tat_price"=>$tat_price_euro[$i],"day"=>$tat_days[$i],"sort"=>$sort);
                          }
                      }

                      /*$price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>0,"day"=>$prepare_days,"sort"=>$sort);
                      if(!empty($tat_price_euro)){
                          $count = 0;
                          for($i = $prepare_days - 1; $i >= $prepare_days - count($tat_price_euro); $i--){

                             for($k = $count;$k < count($tat_price_euro);$k++){
                                $price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>$tat_price_euro[$k],"day"=>$i,"sort"=>$sort);
                                break;
                             }
                             $count++;

                          }

                      }*/
                    } 
                $org_price = "";  
                $price_symbol = "";   
                $product_price = ""; 
                foreach ($price["price"] as $key => $value) {
                           if($value["day"] == $selected_day){
                              $org_price .= $value["sort"] * $value["tat_price"];
                              $product_price .= $value["sort"] * $value["tat_price"];;
                              $price_symbol .= $value["symbol"];

                                 if($cartProduct->orderdata->printing_sample) {
                                       $org_price =  $org_price + $cartProduct->orderdata->printing_sample;
                                       $product_price =  $product_price + $cartProduct->orderdata->printing_sample;
                                  } 
                                  if($cartProduct->orderdata->sustainable_paper) {
                                       $org_price =  $org_price + $cartProduct->orderdata->sustainable_paper;
                                       $product_price =  $product_price + $cartProduct->orderdata->sustainable_paper;
                                  }
                                  if($cartProduct->orderdata->vat) {
                                       $vat_price =  (int) $org_price * (int) $cartProduct->orderdata->vat;
                                       $vat_price =  $vat_price / 100;
                                       $org_price =  $org_price + $vat_price;
                                  }

                           }
                }
                

              ////////////////////////////////////////////////

              $total += $org_price;
              $symbol = $price_symbol; 



              /////////////////////////////////////////////////////
              $product_data = array(); 
              $cartProduct->product_price = $product_price;
              $cartProduct->org_price = $org_price;
              $cartProduct->symbol = $price_symbol; 


                $get_product = DB::table('products')
                                 ->where("id",$get_order->product_id)
                                 ->first();
                $cartProduct->product = $get_product;
       
                  if($get_order->material){
                    $get_material= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->material)
                                         ->first();
                    $cartProduct->material = $get_material->name;                  
                  }
                  if($get_order->side){
                    $get_side= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->side)
                                         ->first();
                    $cartProduct->side = $get_side->name;                  
                  }
                  if($get_order->orientation){
                    $get_orientation= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->orientation)
                                         ->first();
                    $cartProduct->orientation = $get_orientation->name;                 
                  }
                  if($get_order->printing_side){
                    $get_printing_side= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->printing_side)
                                         ->first();
                    $cartProduct->printing_side = $get_printing_side->name;                  
                  }
                  if($get_order->finishing_type){
                    $get_finishing_type= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->finishing_type)
                                         ->first();
                    $cartProduct->finishing_type = $get_finishing_type->name;                  
                  }
                  if($get_order->size){
                    $get_size= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->size)
                                         ->first();
                    $cartProduct->size = $get_size->name;                  
                  }
                  if($get_order->shape){
                    $get_shape= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->shape)
                                         ->first();
                    $cartProduct->shape = $get_shape->name;                  
                  }
                  if($get_order->sleeve_color){
                    $get_sleeve_color= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->sleeve_color)
                                         ->first();
                    $cartProduct->sleeve_color = $get_sleeve_color->name;                  
                  }
                  if($get_order->base){
                    $get_base= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->base)
                                         ->first();
                    $cartProduct->base = $get_base->name;                  
                  }                               
            }
         // echo "<pre>"; print_r($get_cart); die;
        $cart_data["price"] = $total;
        if($symbol == "£"){
            $currency_code = "GBP";
        }else{
            $currency_code = "EUR";
        }
        $cart_data["currency_code"] = $currency_code;
        $data = array();
       $payment = Payment::get("stripe");
       if(Auth::user()->role == "guest"){
              $user_address= DB::table('user_address')
                               ->where("user_id",Auth::user()->id)
                               ->first();
              $email = $user_address->billing_email;
       }else{
            $email= Auth::user()->email;
       }
      
       $company_name= Auth::user()->company_name;
       $paymentReturn = $payment->process($data,$cart_data,$request);
       if(isset($paymentReturn["error"])){
        return redirect()->back()->with("error_order",$paymentReturn["error"]);
       }

        if($paymentReturn->status == "succeeded"){
            $payment_option = array("payment_method"=>"stripe","status"=>$paymentReturn->status);
            $payment_option = json_encode($payment_option);
            $orders_data = json_encode($get_cart);
            $date = date('Y-m-d h:i:s');
           
            ////////////////////////////////////////////
            $mail_order_data = DB::table('cart')
                             ->where("user_id",Auth::user()->id)
                             ->get();
            foreach ($mail_order_data as $cartProduct) {
                $get_orderprocess= DB::table('orderprocess')
                                   ->where("id",$cartProduct->orderprocess_id)
                                   ->first();
                $get_orderprocess_data = json_decode($get_orderprocess->order_data);
                $cartProduct->orderdata = json_decode($get_orderprocess->order_data);
                $get_order = DB::table('product_custom_fields')
                                       ->where("id",$get_orderprocess_data->custom_field_id)
                                       ->first(); 
                $cartProduct->job_id = $get_orderprocess->job_no;                        
                //echo "<pre>"; print_r($cartProduct); die;                       
                  //////////////////////////////////////////////                       
                  $selected_day = $cartProduct->orderdata->order_day;
                    $pound_org_price = $get_order->custom_price_pound;   
                    $base_price = $pound_org_price;
                    $EUR_price = $this->get_euro_price($base_price);
                    $euro_org_price = $EUR_price;
                    $prepare_days = $get_order->prepare_days;
                    $tat_price_pound = json_decode($get_order->tat_price_pound);
                    $tat_price = json_decode($get_order->tat_price_pound);
                    $tat_days = json_decode($get_order->tat_days);
                    $tat_price_euro = array();
                    foreach ($tat_price_pound as $key => $value) {
                      $tat_price_euro[] = $this->get_euro_price($value);
                    }
                    $currency = Auth::user()->currency;

                    $price = array();
                    $price["quantity"]  = $get_order->custom_quantity;
                    $sort = $cartProduct->orderdata->select_sort;
                    if($currency == "GBP"){
                      /*$price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>0,"day"=>$prepare_days,"sort"=>$sort);
                      if(!empty($tat_price_pound)){
                          $count = 0;
                          for($i = $prepare_days - 1; $i >= $prepare_days - count($tat_price_pound); $i--){

                             for($k = $count;$k < count($tat_price_pound);$k++){
                                $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>$tat_price_pound[$k],"day"=>$i,"sort"=>$sort);
                                break;
                             }
                             $count++;

                          }

                      }*/
                      if(!empty($tat_days)){
                           $count = 0;
                           for($i = 0; $i < count($tat_days); $i++){
                                 $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>$tat_price[$i],"day"=>$tat_days[$i],"sort"=>$sort);
                           }
                       }
                    }else{

                      if(!empty($tat_days)){
                          $count = 0;
                          for($i = 0; $i < count($tat_days); $i++){
                                $price["price"][] = array("symbol"=>"€","price"=>$EUR_price,"tat_price"=>$tat_price_euro[$i],"day"=>$tat_days[$i],"sort"=>$sort);
                          }
                      }

                      /*$price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>0,"day"=>$prepare_days,"sort"=>$sort);
                      if(!empty($tat_price_euro)){
                          $count = 0;
                          for($i = $prepare_days - 1; $i >= $prepare_days - count($tat_price_euro); $i--){

                             for($k = $count;$k < count($tat_price_euro);$k++){
                                $price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>$tat_price_euro[$k],"day"=>$i,"sort"=>$sort);
                                break;
                             }
                             $count++;

                          }

                      }*/
                    } 
                $org_price = "";  
                $price_symbol = "";   
                foreach ($price["price"] as $key => $value) {
                           if($value["day"] == $selected_day){
                              $org_price .= $value["sort"] * $value["tat_price"];
                              $price_symbol .= $value["symbol"];
                           }
                }
                

              ////////////////////////////////////////////////





              /////////////////////////////////////////////////////
              $product_data = array(); 
              $cartProduct->org_price = $org_price;
              $cartProduct->symbol = $price_symbol; 


                $get_product = DB::table('products')
                                 ->where("id",$get_order->product_id)
                                 ->first();
                $cartProduct->product = $get_product;
       
                  if($get_order->material){
                    $get_material= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->material)
                                         ->first();
                    $cartProduct->material = $get_material->name;                  
                  }
                  if($get_order->side){
                    $get_side= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->side)
                                         ->first();
                    $cartProduct->side = $get_side->name;                  
                  }
                  if($get_order->orientation){
                    $get_orientation= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->orientation)
                                         ->first();
                    $cartProduct->orientation = $get_orientation->name;                 
                  }
                  if($get_order->printing_side){
                    $get_printing_side= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->printing_side)
                                         ->first();
                    $cartProduct->printing_side = $get_printing_side->name;                  
                  }
                  if($get_order->finishing_type){
                    $get_finishing_type= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->finishing_type)
                                         ->first();
                    $cartProduct->finishing_type = $get_finishing_type->name;                  
                  }
                  if($get_order->size){
                    $get_size= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->size)
                                         ->first();
                    $cartProduct->size = $get_size->name;                  
                  }
                  if($get_order->shape){
                    $get_shape= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->shape)
                                         ->first();
                    $cartProduct->shape = $get_shape->name;                  
                  }
                  if($get_order->sleeve_color){
                    $get_sleeve_color= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->sleeve_color)
                                         ->first();
                    $cartProduct->sleeve_color = $get_sleeve_color->name;                  
                  }
                  if($get_order->base){
                    $get_base= DB::table('custom_attribute_cat')
                                         ->where("id",$get_order->base)
                                         ->first();
                    $cartProduct->base = $get_base->name;                  
                  }                               
            }
            $data_mail = array("mail_order_data"=>$mail_order_data);
            $orderprocess =  DB::table('orders')->insertGetId(["user_id"=>Auth::user()->id,"orderprocess_data"=>$orders_data,"payment_option"=>$payment_option,"order_status_id"=>"3", 'created_at'=>$date, 'updated_at'=>$date]);
            ///////////////////////////////////////////////
            Mail::send("mail.order_mail", $data_mail, function($message) use($email,$company_name){
             $message->to($email, "<".$company_name.">")->subject
                ('Order successfully.');
            });
           
            
            foreach ($get_cart as $cartProduct) {
                $cart_delete = DB::table('cart')
                               ->where("id",$cartProduct->id)
                               ->delete();
            }
             return redirect()->back()->with("success_order","Order generated successfully");
        }else{
            return redirect()->back()->with("error_order","Somethig went wrong");
        }   
       
       die;

        /*Mail::send([], [], function($message) use($email,$company_name){
         $message->to($email, "<".$company_name.">")->subject
            ('Order successfully.')
            ->setBody('<h1>Order successfully!</h1>', 'text/html');
        });
        return redirect()->back();*/
        $order = Order::create($data);
        $this->syncOrderProductData($order, $orderProductData);

        ////INSERT a RECORD INTO ORDER_HISTORY TABLE
        $orderHistoryRepository = app(OrderHistoryInterface::class);
        $orderHistoryRepository->create(['order_id' => $order->id, 'order_status_id' => $orderStatus->id]);
        Event::fire(new OrderPlaceAfterEvent($order, $orderProductData, $request));

        Cart::clear();

        return redirect()->route('order.success', $order->id);
    }


public function quote_place(Request $request)
    {
        $user = Auth::user();
        $quotes = DB::table("orderprocess")->where('user_id',$user->id)->where('id',$request->qid)->first();
        $quotesinfo = DB::table("quotation")->where('user_id',$user->id)->where('quote_id',$request->qid)->first();
        $quotes->order_data = json_decode($quotes->order_data);
        $quotes->job_id = $quotes->job_no;
        $quotes->printing_data = json_decode($quotes->printing_data);
        $quotes->quotesinfo = $quotesinfo;
        $quotes->quotesinfo->quote_info = json_decode($quotes->quotesinfo->quote_info);
        $product_data = array(); ////////////////////////////////////////////////////////////////                       
                $get_product = DB::table('products')
                                 ->where("id",$quotes->order_data->product)
                                 ->first();
                $get_category = DB::table('categories')
                 ->where("id",$quotes->order_data->category)
                 ->first();
        $quotes->product = $get_product;  
        $quotes->category = $get_category;       
        $quate_data =  (array)$quotes;
        $quate_data =  json_encode($quotes); 
               
                $quotes->product = $get_product;
                $quotes->category = $get_category;

        
        $cart_data["price"] = $quotesinfo->quote_info->quote_price;
        $currency_code = $quotesinfo->quote_info->quote_currency;
       
        $cart_data["currency_code"] = $currency_code;
        $data = array();
       $payment = Payment::get("stripe");
       $company_name= Auth::user()->company_name;
       $paymentReturn = $payment->process($data,$cart_data,$request);
       if(isset($paymentReturn["error"])){
        return redirect()->back()->with("error_order",$paymentReturn["error"]);
       }

        if($paymentReturn->status == "succeeded"){
            $payment_option = array("payment_method"=>"stripe","status"=>$paymentReturn->status);
            $payment_option = json_encode($payment_option);
            $orders_data = json_encode($quate_data);
            $date = date('Y-m-d h:i:s');
          
            ////////////////////////////////////////////

        $quotes = DB::table("orderprocess")->where('request_type', 'quote')->where('user_id',$user->id)->where('id',$request->qid)->where('status',"1")->first();
        $quotesinfo = DB::table("quotation")->where('user_id',$user->id)->where('quote_id',$request->qid)->first();
        
             $get_orderprocess_data = json_decode($quotes->order_data);
              $quotesinfo->quotesdata = json_decode($quotesinfo->quote_info);
              $quotes->orderdata = json_decode($quotes->order_data);
              $quotes->printing_data = json_decode($quotes->printing_data);
              $quotes->job_id = $quotes->job_no;
             
                                   
              //////////////////////////////////////////////                       
             
               $product_data = array(); ////////////////////////////////////////////////////////////////                       
                $get_product = DB::table('products')
                                 ->where("id",$quotes->orderdata->product)
                                 ->first();
                $get_category = DB::table('categories')
                 ->where("id",$quotes->orderdata->category)
                 ->first();
                $quotes->product = $get_product;
                $quotes->category = $get_category;                   
          
            $data_mail = array("quote"=>$quotes, "quotesinfo"=>$quotesinfo);
            $email = $user->email;
            ///////////////////////////////////////////////
            Mail::send("mail.quote_mail", $data_mail, function($message) use($email,$company_name){
             $message->to($email, "<".$company_name.">")->subject
                ('Order successfully.');
            });
            $orderprocess =  DB::table('orders')->insertGetId(["user_id"=>Auth::user()->id,"orderprocess_data"=>$orders_data,"payment_option"=>$payment_option,"order_status_id"=>"3",'request_type'=>"quote", 'created_at'=>$date, 'updated_at'=>$date]);
            
             return redirect("quotes")->with("success_order","Order generated successfully");
        }else{
            return redirect("quotes")->with("error_order","Somethig went wrong");
        }   
       
       die;

        /*Mail::send([], [], function($message) use($email,$company_name){
         $message->to($email, "<".$company_name.">")->subject
            ('Order successfully.')
            ->setBody('<h1>Order successfully!</h1>', 'text/html');
        });
        return redirect()->back();*/
        $order = Order::create($data);
        $this->syncOrderProductData($order, $orderProductData);

        ////INSERT a RECORD INTO ORDER_HISTORY TABLE
        $orderHistoryRepository = app(OrderHistoryInterface::class);
        $orderHistoryRepository->create(['order_id' => $order->id, 'order_status_id' => $orderStatus->id]);
        Event::fire(new OrderPlaceAfterEvent($order, $orderProductData, $request));

        Cart::clear();

        return redirect()->route('order.success', $order->id);
    }
    public function success(Order $order)
    {
        return view('order.success')->with('order', $order);
    }
    public function orderprocess(Request $request)
    {   
        $get_orderprocess= DB::table('orderprocess')
                               ->where("order_id",$request->id)
                               ->first();
        //echo "<pre>"; print_r($get_orderprocess); die;                     
        $get_orderprocess->order_data = json_decode($get_orderprocess->order_data);
        $get_order = DB::table('product_custom_fields')
                               ->where("id",$get_orderprocess->order_data->custom_field_id)
                               ->first();  
        $orientation_data= DB::table('custom_attribute_cat')
                               ->where("parent_id",4)
                               ->get();
        //echo "<pre>"; print_r($orientation_data); die;
              $selected_day = $get_orderprocess->order_data->order_day;


              $pound_org_price = $get_order->custom_price_pound;  


              $base_price = $pound_org_price;
              $EUR_price = $this->get_euro_price($base_price);
                      
              $euro_org_price = $EUR_price;
              $prepare_days = $get_order->prepare_days;
              $tat_price_pound = json_decode($get_order->tat_price_pound);
              $tat_price = json_decode($get_order->tat_price_pound);
              $tat_days = json_decode($get_order->tat_days);  
              $tat_price_euro = array();
              foreach ($tat_price_pound as $key => $value) {
                $tat_price_euro[] = $this->get_euro_price($value);
              }
              //echo "<pre>"; print_r($tat_price_euro); die;
              $currency = Auth::user()->currency;

              $price = array();
              $price["quantity"]  = $get_order->custom_quantity;
              $sort = $get_orderprocess->order_data->select_sort;
              if($currency == "GBP"){

                       // $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>0,"day"=>$prepare_days);
                       if(!empty($tat_days)){
                           $count = 0;
                           for($i = 0; $i < count($tat_days); $i++){
                                 $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>$tat_price[$i],"day"=>$tat_days[$i],"sort"=>$sort);
                           }
                       }
                //$price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>0,"day"=>$prepare_days,"sort"=>$sort);
                /*if(!empty($tat_price_pound)){
                    $count = 0;
                    for($i = $prepare_days - 1; $i >= $prepare_days - count($tat_price_pound); $i--){

                       for($k = $count;$k < count($tat_price_pound);$k++){
                          $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>$tat_price_pound[$k],"day"=>$i,"sort"=>$sort);
                          break;
                       }
                       $count++;

                    }

                }*/
              }else{

                if(!empty($tat_days)){
                    $count = 0;
                    for($i = 0; $i < count($tat_days); $i++){
                          $price["price"][] = array("symbol"=>"€","price"=>$EUR_price,"tat_price"=>$tat_price_euro[$i],"day"=>$tat_days[$i],"sort"=>$sort);
                    }
                }

                /*$price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>0,"day"=>$prepare_days,"sort"=>$sort);
                if(!empty($tat_price_euro)){
                    $count = 0;
                    for($i = $prepare_days - 1; $i >= $prepare_days - count($tat_price_euro); $i--){

                       for($k = $count;$k < count($tat_price_euro);$k++){
                          $price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>$tat_price_euro[$k],"day"=>$i,"sort"=>$sort);
                          break;
                       }
                       $count++;

                    }

                }*/
              } 

          $org_price = "";  
          $price_symbol = "";   
          foreach ($price["price"] as $key => $value) {
                     if($value["day"] == $selected_day){
                        $org_price .= $value["sort"] * $value["tat_price"];
                        $price_symbol .= $value["symbol"];
                     }
          }
          
         //  echo "<pre>"; print_r($org_price); die;
        ////////////////////////////////////////////////





        /////////////////////////////////////////////////////
        $product_data = array(); 
        $product_data["org_price"] = $org_price;
        $product_data["symbol"] = $price_symbol;

        $product_data["order_process_id"]  = $get_orderprocess->id; 
                $product_data["product_total"]  = $get_orderprocess->order_data; 
                if($get_order->product_id){
                    $get_product= DB::table('products')
                                         ->where("id",$get_order->product_id)
                                         ->first();
                    $get_product_cat_id= DB::table('category_product')
                                         ->where("product_id",$get_order->product_id)
                                         ->first(); 
                    $get_product_cat= DB::table('categories')
                                         ->where("id",$get_product_cat_id->category_id)
                                         ->first();                
                    $product_data["product"] = $get_product->name;
                    $product_data["category"] = $get_product_cat->name;  
                    $product_data["product_slug"] = $get_product->slug;                
                }                    
              if($get_order->material){
                $get_material= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->material)
                                     ->first();
                $product_data["material"] = $get_material->name;                  
              }
              if($get_order->side){
                $get_side= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->side)
                                     ->first();
                $product_data["side"] = $get_side->name;                  
              }
              if($get_order->orientation){
                $get_orientation= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->orientation)
                                     ->first();
                $product_data["orientation"] = $get_orientation->name; 
                $product_data["orientation_id"] = $get_orientation->id;                 
              }
              if($get_order->printing_side){
                $get_printing_side= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->printing_side)
                                     ->first();
                $product_data["printing_side"] = $get_printing_side->name;                  
              }
              if($get_order->finishing_type){
                $get_finishing_type= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->finishing_type)
                                     ->first();
                $product_data["finishing_type"] = $get_finishing_type->name;                  
              }
              if($get_order->size){
                $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->size)
                                     ->first();
                $product_data["size"] = $get_size->name;                  
              }
              if($get_order->size){
                $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->size)
                                     ->first();
                $product_data["size"] = $get_size->name;                  
              }
              if($get_order->shape){
                $get_shape= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->shape)
                                     ->first();
                $product_data["shape"] = $get_shape->name;                  
              }
              if($get_order->sleeve_color){
                $get_sleeve_color= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->sleeve_color)
                                     ->first();
                $product_data["sleeve_color"] = $get_sleeve_color->name;                  
              }
              if($get_order->base){
                $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$get_order->base)
                                     ->first();
                $product_data["base"] = $get_base->name;                  
              }

        $user_address =  DB::table('user_address')
                               ->where("user_id",Auth::user()->id)
                               ->first();      
        return view("checkout/orderprocess")->with("orderData",$product_data)->with("orientation_data",$orientation_data)->with("user_address",$user_address);                                                                     
       // echo "<pre>"; print_r($user_address);;
    }

     /**
     * User Order List Page
     *
     * @return Illuminate\Http\Response
     */

    public function get_euro_price($price){
                      $req_url = 'https://api.exchangerate-api.com/v4/latest/GBP';
                      $response_json = file_get_contents($req_url);

                      // Continuing if we got a result
                      if(false !== $response_json) {

                          // Try/catch for json_decode operation
                          try {

                            // Decoding
                            $response_object = json_decode($response_json);

                           return $EUR_price = round(($price * $response_object->rates->EUR));

                          }
                          catch(Exception $e) {
                             return $EUR_price = null;
                          }

                      }
    }
    public function myQuotes()
    {
        $active = "quote";
        if(Auth::guard()->user()){
          $user = Auth::guard()->user();
          $quotes = DB::table("orderprocess")->where('request_type', 'quote')->where('user_id',$user->id)->where('status',"1")->get();
          
          foreach ($quotes as $cartProduct) {
            $quotesinfo = DB::table("quotation")->where('user_id',$user->id)->where('quote_id',$cartProduct->id)->first();
              $cartProduct->quotesdata = json_decode($quotesinfo->quote_info);

              $get_orderprocess_data = json_decode($cartProduct->order_data);
              $cartProduct->orderdata = json_decode($cartProduct->order_data);
              $cartProduct->printing_data = json_decode($cartProduct->printing_data);
             
                                   
              //////////////////////////////////////////////                       
             
               $product_data = array(); ////////////////////////////////////////////////////////////////                       
                $get_product = DB::table('products')
                                 ->where("id",$cartProduct->orderdata->product)
                                 ->first();
                $get_category = DB::table('categories')
                 ->where("id",$cartProduct->orderdata->category)
                 ->first();
                $cartProduct->product = $get_product;
                $cartProduct->category = $get_category;  
                                     
          }
          
        }
       return $view = view('user.my-account.quotation')->with('quotes', $quotes)->with('quote', 'quote');
    }

    

    /**
     * User Order List Page
     *
     * @return Illuminate\Http\Response
     */
    public function myAccountOrderList()
    {
        $user = Auth::guard()->user();
        $orders = Order::whereUserId($user->id)->get();
        $view = view('order.list')->with('orders', $orders);

        return $view;
    }
     public function myAccountinvoiceList(){
       
        $user = Auth::guard()->user(); 
        $orders = Order::whereUserId($user->id)->where("order_status_id","5")->get();
        $data_all = array();
        $active = 'active';

       foreach ($orders as $key => $order) {
          if($order->request_type == "quote"){

              

              $get_orderstatus= DB::table('order_statuses')
                                       ->where("id",$order->order_status_id)
                                       ->first();                          
              $order->status =  $get_orderstatus->name;   
              $order->orderprocess_data = json_decode(json_decode($order->orderprocess_data));

              
             
                   $orderprocess_id = $order->orderprocess_data->id;
                    $get_order_address= DB::table('cart_shipping_address')
                                   ->where("orderprocess_id",$orderprocess_id)
                                   ->first();
                    $order->address = $get_order_address;
          }else{
              $get_orderstatus= DB::table('order_statuses')
                                       ->where("id",$order->order_status_id)
                                       ->first();
              $order->status =  $get_orderstatus->name;   
              $order->orderprocess_data = json_decode($order->orderprocess_data);
              foreach ($order->orderprocess_data as $value) {
                   $orderprocess_id = $value->orderprocess_id;
                    $get_order_address= DB::table('cart_shipping_address')
                                   ->where("orderprocess_id",$orderprocess_id)
                                   ->first();
                    $value->address = $get_order_address;
              }
          }    

        }
        $view = view('user.my-account.invoice')->with('orders', $orders)->with('data_all', $data_all)->with('invoice', $active);

        return $view;
    } 
    public function myAccountJobsList(){

        $user = Auth::guard()->user();
        $orders = Order::whereUserId($user->id)->whereNotIn("order_status_id",[5])->get();
        $data_all = array();
        $active = 'active';
        
        foreach ($orders as $key => $order) {
          if($order->request_type == "quote"){

              

              $get_orderstatus= DB::table('order_statuses')
                                       ->where("id",$order->order_status_id)
                                       ->first();                          
              $order->status =  $get_orderstatus->name;   
              $order->orderprocess_data = json_decode(json_decode($order->orderprocess_data));

              
             
                   $orderprocess_id = $order->orderprocess_data->id;
                    $get_order_address= DB::table('cart_shipping_address')
                                   ->where("orderprocess_id",$orderprocess_id)
                                   ->first();
                    $order->address = $get_order_address;
          }else{
              $get_orderstatus= DB::table('order_statuses')
                                       ->where("id",$order->order_status_id)
                                       ->first();
              $order->status =  $get_orderstatus->name;   
              $order->orderprocess_data = json_decode($order->orderprocess_data);
              foreach ($order->orderprocess_data as $value) {
                   $orderprocess_id = $value->orderprocess_id;
                    $get_order_address= DB::table('cart_shipping_address')
                                   ->where("orderprocess_id",$orderprocess_id)
                                   ->first();
                    $value->address = $get_order_address;
              }
          }    

        }

        $view = view('user.my-account.jobs')->with('orders', $orders)->with('data_all', $data_all)->with('jobdata', $active);

        return $view;
    } 
    public function myAccountinvoiceDetail(Request $request, $invoice_id){

        $user = Auth::guard()->user();
        $order = Order::whereUserId($user->id)->where('id',$invoice_id)->first();
        $data_all = array();

        // print_r($job_id);
        $active = 'active';
        if($order->request_type == "quote"){

          $get_orderstatus= DB::table('order_statuses')
                                   ->where("id",$order->order_status_id)
                                   ->first();
          $order->status =  $get_orderstatus->name;   
          $order->orderprocess_data = json_decode(json_decode($order->orderprocess_data));

              
             
                   $orderprocess_id = $order->orderprocess_data->id;
                    $get_order_address= DB::table('cart_shipping_address')
                                   ->where("orderprocess_id",$orderprocess_id)
                                   ->first();
                    $order->address = $get_order_address;


        }else{
          $get_orderstatus= DB::table('order_statuses')
                                   ->where("id",$order->order_status_id)
                                   ->first();
          $order->status =  $get_orderstatus->name;   
          $order->orderprocess_data = json_decode($order->orderprocess_data);
          foreach ($order->orderprocess_data as $value) {
               $orderprocess_id = $value->orderprocess_id;
                $get_order_address= DB::table('cart_shipping_address')
                               ->where("orderprocess_id",$orderprocess_id)
                               ->first();
                $value->address = $get_order_address;
          }
        }  
          //echo '<pre>';print_r($order);die;
        
        $view = view('user.my-account.invoice-detailed')->with('order', $order)->with('invoice', $active);

        return $view;
    }

    public function myAccountJobDetail(Request $request, $job_id){

        $user = Auth::guard()->user();
        $order = Order::whereUserId($user->id)->where('id',$job_id)->first();
        $data_all = array();

        // print_r($job_id);
        $active = 'active';
        if($order->request_type == "quote"){

          $get_orderstatus= DB::table('order_statuses')
                                   ->where("id",$order->order_status_id)
                                   ->first();
          $order->status =  $get_orderstatus->name;   
          $order->orderprocess_data = json_decode(json_decode($order->orderprocess_data));

              
             
                   $orderprocess_id = $order->orderprocess_data->id;
                    $get_order_address= DB::table('cart_shipping_address')
                                   ->where("orderprocess_id",$orderprocess_id)
                                   ->first();
                    $order->address = $get_order_address;


        }else{
          $get_orderstatus= DB::table('order_statuses')
                                   ->where("id",$order->order_status_id)
                                   ->first();
          $order->status =  $get_orderstatus->name;   
          $order->orderprocess_data = json_decode($order->orderprocess_data);
          foreach ($order->orderprocess_data as $value) {
               $orderprocess_id = $value->orderprocess_id;
                $get_order_address= DB::table('cart_shipping_address')
                               ->where("orderprocess_id",$orderprocess_id)
                               ->first();
                $value->address = $get_order_address;
          }
        }  
          //echo '<pre>';print_r($order);die;
        
        $view = view('user.my-account.job-detailed')->with('order', $order)->with('jobdata', $active);

        return $view;
    }

    public function myAccountquoteDetail(Request $request, $quote_id){
        
        $user = Auth::guard()->user();
        $quotes = DB::table("orderprocess")->where('request_type', 'quote')->where('user_id',$user->id)->where('id',$quote_id)->where('status',"1")->first();
        $quotesinfo = DB::table("quotation")->where('user_id',$user->id)->where('quote_id',$quote_id)->first();
        
             $get_orderprocess_data = json_decode($quotes->order_data);
              $quotesinfo->quotesdata = json_decode($quotesinfo->quote_info);
              $quotes->orderdata = json_decode($quotes->order_data);
              $quotes->printing_data = json_decode($quotes->printing_data);
             
                                   
              //////////////////////////////////////////////                       
             
               $product_data = array(); ////////////////////////////////////////////////////////////////                       
                $get_product = DB::table('products')
                                 ->where("id",$quotes->orderdata->product)
                                 ->first();
                $get_category = DB::table('categories')
                 ->where("id",$quotes->orderdata->category)
                 ->first();
                $quotes->product = $get_product;
                $quotes->category = $get_category;  

      $orders = Order::whereUserId($user->id)->get();
      $quate_status = array();
      foreach ($orders as $key => $order) {
          if($order->request_type == "quote"){

            $order->orderprocess_data = json_decode(json_decode($order->orderprocess_data));
            if($order->orderprocess_data->id == $quote_id){
               $get_orderstatus= DB::table('order_statuses')
                                   ->where("id",$order->order_status_id)
                                   ->first();
               $quate_status["status"] =  $get_orderstatus->name; 

            }
          }

        # code...
      }
      
       return $view = view('user.my-account.quotation-detailed')->with('quotes', $quotes)->with('quote', 'quote')->with('quotesinfo', $quotesinfo)->with('quate_status', $quate_status);
    }

    public function myAccountquotePayment(Request $request, $quote_id){
        
       $user = Auth::guard()->user();
        $quotes = DB::table("orderprocess")->where('request_type', 'quote')->where('user_id',$user->id)->where('id',$quote_id)->where('status',"1")->first();
        $quotesinfo = DB::table("quotation")->where('user_id',$user->id)->where('quote_id',$quote_id)->first();

        $user_address =  DB::table('user_address')
                               ->where("user_id",Auth::user()->id)
                               ->first();
        $orientation_data= DB::table('custom_attribute_cat')
                               ->where("parent_id",4)
                               ->get();
        
             $get_orderprocess_data = json_decode($quotes->order_data);
              $quotesinfo->quotesdata = json_decode($quotesinfo->quote_info);
              $quotes->orderdata = json_decode($quotes->order_data);
              $quotes->printing_data = json_decode($quotes->printing_data);
             
                                   
              //////////////////////////////////////////////                       
             
               $product_data = array(); ////////////////////////////////////////////////////////////////                       
                $get_product = DB::table('products')
                                 ->where("id",$quotes->orderdata->product)
                                 ->first();
                $get_category = DB::table('categories')
                 ->where("id",$quotes->orderdata->category)
                 ->first();
                $quotes->product = $get_product;
                $quotes->category = $get_category;  
       return $view = view('user.my-account.quote-payment')->with('quotes', $quotes)->with('quote', 'quote')->with('quotesinfo', $quotesinfo)->with('user_address', $user_address)->with('orientation_data', $orientation_data);
    }

    /**
     * User Order Details Page
     *
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @return Illuminate\Http\Response
     */
    public function myAccountOrderView(Order $order)
    {
        return view('order.view')->withOrder($order);
    }

    /**
     * Order Return Request Page
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @return Illuminate\Http\Response
     */
    public function return(Order $order)
    {
        return view('order.return')->withOrder($order);
    }

    /**
     * Order Return Request Page
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @param \App\Http\Requests\MyAccount\Order\OrderReturnRequest $order
     * @return Illuminate\Http\Response
     */
    public function returnPost(Order $order, OrderReturnRequest $request)
    {
        $returnRequest = $this->orderReturnRequestRepository->create([
            'order_id' => $order->id,
            'comment' => $request->get('comment'),
            'status' => 'PENDING'
        ]);

        foreach ($request->get('products') as $product) {
            $product['product_id'] = app(ProductInterface::class)->findBySlug($product['slug'])->id;

            $returnRequest->products()->create($product);
        }

        return redirect()->back()->withNotificationText(__('return.success'));
    }

    private function getUser(Request $request)
    {
        if (Auth::guard()->check()) {
            return Auth::guard()->user();
        }
        $userData = $request->get('user');

        $user = User::whereEmail($userData['email'])->first();

        if (null === $user) {
            $billingData = $request->get('billing');

            //register guest user as user with random password
            $userData['password'] = bcrypt(str_random(6));
            $userData['first_name'] = $billingData['first_name'];
            $userData['last_name'] = $billingData['last_name'];

            $user = User::create($userData);
        }

        Auth::guard()->loginUsingId($user->id);

        return $user;
    }

    private function getBillingAddress(Request $request)
    {
        $billingData = $request->get('billing');

        $billingData['type'] = 'BILLING';
        $billingData['user_id'] = Auth::guard()->user()->id;

        if (isset($billingData['id']) && $billingData['id'] > 0) {
            $address = Address::findorfail($billingData['id']);
        //$address->update($shippingData);
        } else {
            $address = Address::create($billingData);
        }

        return $address;
    }

    private function getShippingAddress(Request $request)
    {
        if (null == $request->get('use_different_shipping_address')) {
            $shippingData = $request->get('billing');
        } else {
            $shippingData = $request->get('shipping');
        }

        $shippingData['type'] = 'SHIPPING';
        $shippingData['user_id'] = Auth::guard()->user()->id;

        if (isset($shippingData['id']) && $shippingData['id'] > 0) {
            $address = Address::findorfail($shippingData['id']);
        //$address->update($shippingData);
        } else {
            $address = Address::create($shippingData);
        }

        return $address;
    }

    /**
     * @param $order
     * @param $orderProducts
     *
     *
     */
    private function syncOrderProductData($order, $orderProducts)
    {
        $orderProductTableData = [];

        foreach ($orderProducts as $orderProduct) {
            if (null != $orderProduct->attributes() && $orderProduct->attributes()->count() >= 0) {
                foreach ($orderProduct->attributes() as $attribute) {
                    $product = Product::whereSlug($orderProduct->slug())->first();
                    $data = ['order_id' => $order->id,
                        'product_id' => $product->id,
                        'attribute_dropdown_option_id' => $attribute['attribute_dropdown_option_id'],
                        'attribute_id' => $attribute['attribute_id'],
                    ];

                    OrderProductVariation::create($data);

                    $productVariationModel = Product::find($attribute['variation_id']);
                    $productVariationModel->update(['qty' => ($productVariationModel->qty - $orderProduct->qty())]);
                }
            } else {
                $product = Product::whereSlug($orderProduct->slug())->first();
                $product->update(['qty' => ($product->qty - $orderProduct->qty())]);
            }

            $orderProductTableData[] = [
                'product_id' => $product->id,
                'qty' => $orderProduct->qty(),
                'price' => $orderProduct->price(),
                'tax_amount' => 0.00,
                'product_info' => $product->toJson()

            ];
        }
        $order->products()->sync($orderProductTableData);
    }
}
