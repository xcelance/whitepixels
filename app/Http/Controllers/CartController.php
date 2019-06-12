<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Cart\Facade as Cart;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Payment\Facade as Payment;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use DB;
use Auth;

class CartController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ProductRepository
     */
    protected $repository;

    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
     */
    protected $configurationRepository;

    public function __construct(ProductInterface $repository, ConfigurationInterface $configRep)
    {
        parent::__construct();

        $this->repository = $repository;
        $this->configurationRepository = $configRep;
    }

    /**
     * Add To Cart Product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function addToCart(Request $request)
    {
        $date = date("Y-m-d h:i:s");
       // echo "<pre>"; print_r($request->all()); die;
        $get_orderprocess= DB::table('cart')
                           ->where("orderprocess_id",$request->order_process_id)
                           ->count();
                  
        if($get_orderprocess > 0){
            return redirect('/');
        }
        if(Auth::user()->role == "guest"){
          $order_pid = DB::table('orderprocess')->where('id', $request->order_process_id)->first();
          $job_no = "WP800".$order_pid->id."-".strtoupper($request->business_bill);
          
        }else{
          $order_pid = DB::table('orderprocess')->where('id', $request->order_process_id)->first();
          $job_no = "WP800".$order_pid->id."-".strtoupper(Auth::user()->company_name);
        }

        $orderprocess =  DB::table('cart')->insertGetId(["user_id"=>Auth::user()->id,"orderprocess_id"=>$request->order_process_id,"submit_at"=>$date]);

      
        $printing_data = array("po"=>$request->po,"reference"=>$request->reference,"orientation"=>$request->orientation,"proof"=>$request->proof);
        $printing_data = json_encode($printing_data);
        DB::table('orderprocess')->where('id', $request->order_process_id)->update(['printing_data' => $printing_data,'job_no' => $job_no]);
        if(Auth::user()->role == "guest"){
            $get_user_address= DB::table('user_address')
                           ->where("user_id",Auth::user()->id)
                           ->count();
            $get_users= DB::table('users')
                           ->where("email",$request->email_bill)
                           ->count();  
            if($get_users < 1) {                           
              $users_update = DB::table('users')->where('id', Auth::user()->id)->update(["contact_person"=>$request->contact_person_bill,"phone"=>$request->phone_bill,"email"=>$request->email_bill,"company_name"=>$request->business_bill,"address1"=>$request->address1_bill,"address2"=>$request->address2_bill,"city"=>$request->city_bill,"country"=>$request->country_bill,"state"=>$request->state_bill,"postcode"=>$request->postalcode_bill]);  
            }             
            if($get_user_address > 0){
                $user_address = DB::table('user_address')->where('user_id', Auth::user()->id)->update(["delivery_contact_person"=>$request->contact_person,"delivery_contact_number"=>$request->phone,"delivery_email"=>$request->email,"delivery_business"=>$request->business_name,"delivery_address1"=>$request->address1,"delivery_address2"=>$request->address2,"delivery_city"=>$request->city,"delivery_country"=>$request->country,"delivery_state"=>$request->state,"delivery_postalcode"=>$request->postalcode,"billing_contact_person"=>$request->contact_person_bill,"billing_contact_number"=>$request->phone_bill,"billing_email"=>$request->email_bill,"billing_business"=>$request->business_bill,"billing_address1"=>$request->address1_bill,"billing_address2"=>$request->address2_bill,"billing_city"=>$request->city_bill,"billing_country"=>$request->country_bill,"billing_state"=>$request->state_bill,"billing_postalcode"=>$request->postalcode_bill,"updated_at"=>$date]);   


            }else{
                
                $user_address =  DB::table('user_address')->insertGetId(["user_id"=>Auth::user()->id,"delivery_contact_person"=>$request->contact_person,"delivery_contact_number"=>$request->phone,"delivery_email"=>$request->email,"delivery_business"=>$request->business_name,"delivery_address1"=>$request->address1,"delivery_address2"=>$request->address2,"delivery_city"=>$request->city,"delivery_country"=>$request->country,"delivery_state"=>$request->state,"delivery_postalcode"=>$request->postalcode,"billing_contact_person"=>$request->contact_person_bill,"billing_contact_number"=>$request->phone_bill,"billing_email"=>$request->email_bill,"billing_business"=>$request->business_bill,"billing_address1"=>$request->address1_bill,"billing_address2"=>$request->address2_bill,"billing_city"=>$request->city_bill,"billing_country"=>$request->country_bill,"billing_state"=>$request->state_bill,"billing_postalcode"=>$request->postalcode_bill,"submit_at"=>$date]);

            }
        }
        
        


        $orderprocess =  DB::table('cart_shipping_address')->insertGetId(["user_id"=>Auth::user()->id,"orderprocess_id"=>$request->order_process_id,"delivery_contact_person"=>$request->contact_person,"delivery_contact_number"=>$request->phone,"delivery_email"=>$request->email,"delivery_business"=>$request->business_name,"delivery_address1"=>$request->address1,"delivery_address2"=>$request->address2,"delivery_city"=>$request->city,"delivery_country"=>$request->country,"delivery_state"=>$request->state,"delivery_postalcode"=>$request->postalcode,"billing_contact_person"=>$request->contact_person_bill,"billing_contact_number"=>$request->phone_bill,"billing_email"=>$request->email_bill,"billing_business"=>$request->business_bill,"billing_address1"=>$request->address1_bill,"billing_address2"=>$request->address2_bill,"billing_city"=>$request->city_bill,"billing_country"=>$request->country_bill,"billing_state"=>$request->state_bill,"billing_postalcode"=>$request->postalcode_bill,"delivery_instruction"=>$request->instructions,"submit_at"=>$date]);

        return redirect('cart/view');
        
    }
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
    public function view()
    {   
        if(Auth::user()){
            $get_cart= DB::table('cart')
                       ->where("user_id",Auth::user()->id)
                       ->get();
        }else{
            $get_cart = array();
        }
        $paymentOptions =  Payment::get("stripe");
        $token= DB::table('configurations')
                    ->where("configuration_key","payment_stripe_publishable_key")
                    ->first();
        $token  = $token->configuration_value;    

        //echo "<pre>"; print_r($paymentOptions->with()); die;
        foreach ($get_cart as $cartProduct) {
            $get_orderprocess= DB::table('orderprocess')
                               ->where("id",$cartProduct->orderprocess_id)
                               ->first();
            $get_order_address= DB::table('cart_shipping_address')
                               ->where("orderprocess_id",$cartProduct->orderprocess_id)
                               ->first();
            $cartProduct->address = $get_order_address;                   
            $get_orderprocess_data = json_decode($get_orderprocess->order_data);
            $cartProduct->orderdata = json_decode($get_orderprocess->order_data);
            $cartProduct->printing_data = json_decode($get_orderprocess->printing_data);
            $get_order = DB::table('product_custom_fields')
                                   ->where("id",$get_orderprocess_data->custom_field_id)
                                   ->first();
            //echo "<pre>"; print_r($cartProduct); die;                       
            //////////////////////////////////////////////                       
            $selected_day = $cartProduct->orderdata->order_day;
              $pound_org_price = $get_order->custom_price_pound;   

              $base_price = $pound_org_price;
              $EUR_price = $this->get_euro_price($base_price);
              $prepare_days = $get_order->prepare_days;
              $euro_org_price = $EUR_price;
              $tat_price_pound = json_decode($get_order->tat_price_pound);
              $tat_price_euro = array();
              foreach ($tat_price_pound as $key => $value) {
                $tat_price_euro[] = $this->get_euro_price($value);
              }
              $currency = Auth::user()->currency;

              $price = array();
              $price["quantity"]  = $get_order->custom_quantity;
              $sort = $cartProduct->orderdata->select_sort;
              if($currency == "GBP"){
                $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>0,"day"=>$prepare_days,"sort"=>$sort);
                if(!empty($tat_price_pound)){
                    $count = 0;
                    for($i = $prepare_days - 1; $i >= $prepare_days - count($tat_price_pound); $i--){

                       for($k = $count;$k < count($tat_price_pound);$k++){
                          $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>$tat_price_pound[$k],"day"=>$i,"sort"=>$sort);
                          break;
                       }
                       $count++;

                    }

                }
              }else{

                $price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>0,"day"=>$prepare_days,"sort"=>$sort);
                if(!empty($tat_price_euro)){
                    $count = 0;
                    for($i = $prepare_days - 1; $i >= $prepare_days - count($tat_price_euro); $i--){

                       for($k = $count;$k < count($tat_price_euro);$k++){
                          $price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>$tat_price_euro[$k],"day"=>$i,"sort"=>$sort);
                          break;
                       }
                       $count++;

                    }

                }
              } 
          $org_price = "";  
          $price_symbol = "";   
          foreach ($price["price"] as $key => $value) {
                     if($value["day"] == $selected_day){
                        $org_price .= ($value["price"] * $value["sort"]) + $value["tat_price"];
                        $price_symbol .= $value["symbol"];
                     }
          }
          

        ////////////////////////////////////////////////





        /////////////////////////////////////////////////////
        $product_data = array(); 
        $cartProduct->org_price = $org_price;
        $cartProduct->symbol = $price_symbol; 
        //////////////////////////////////////////////////////////////////                       
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
        //echo "<pre>"; print_r($get_cart); die;
        return view('cart.view')
            ->with('cartProducts', $get_cart)
            ->with('paymentOptions', $paymentOptions)
            ->with('token', $token);
    }

    public function quotationPlaceOrder(Request $request){
      
      $date = date('Y-m-d H:i:s');
      $user = Auth::user();
        $token= DB::table('configurations')
                    ->where("configuration_key","payment_stripe_publishable_key")
                    ->first();
        $token  = $token->configuration_value;    
        

      $printing_data = array("po"=>$request->po,"reference"=>$request->reference,"orientation"=>$request->orientation,"proof"=>$request->proof);
        $printing_data = json_encode($printing_data);
        DB::table('orderprocess')->where('id', $request->qid)->update(['printing_data' => $printing_data]);
        $cart_shipping_address =DB::table('cart_shipping_address')->where('orderprocess_id', $request->qid)->count();
       if($cart_shipping_address > 0){
        $orderprocess =  DB::table('cart_shipping_address')->where('orderprocess_id', $request->qid)->update(["delivery_contact_person"=>$request->contact_person,"delivery_contact_number"=>$request->phone,"delivery_email"=>$request->email,"delivery_business"=>$request->business_name,"delivery_address1"=>$request->address1,"delivery_address2"=>$request->address2,"delivery_city"=>$request->city,"delivery_country"=>$request->country,"delivery_state"=>$request->state,"delivery_postalcode"=>$request->postalcode,"billing_contact_person"=>$request->contact_person,"billing_contact_number"=>$request->phone,"billing_email"=>$request->email,"billing_business"=>$request->business,"billing_address1"=>$request->address1,"billing_address2"=>$request->address2,"billing_city"=>$request->city,"billing_country"=>$request->country,"billing_state"=>$request->state,"billing_postalcode"=>$request->postalcode,"delivery_instruction"=>$request->instructions]);


       }else{
        $orderprocess =  DB::table('cart_shipping_address')->insertGetId(["user_id"=>Auth::user()->id,"orderprocess_id"=>$request->qid,"delivery_contact_person"=>$request->contact_person,"delivery_contact_number"=>$request->phone,"delivery_email"=>$request->email,"delivery_business"=>$request->business_name,"delivery_address1"=>$request->address1,"delivery_address2"=>$request->address2,"delivery_city"=>$request->city,"delivery_country"=>$request->country,"delivery_state"=>$request->state,"delivery_postalcode"=>$request->postalcode,"billing_contact_person"=>$request->contact_person,"billing_contact_number"=>$request->phone,"billing_email"=>$request->email,"billing_business"=>$request->business,"billing_address1"=>$request->address1,"billing_address2"=>$request->address2,"billing_city"=>$request->city,"billing_country"=>$request->country,"billing_state"=>$request->state,"billing_postalcode"=>$request->postalcode,"delivery_instruction"=>$request->instructions,"submit_at"=>$date]);
       }
        
      $quotesinfo = DB::table("quotation")->where('user_id',$user->id)->where('quote_id',$request->qid)->first();

      $quotesinfo->quotesdata = json_decode($quotesinfo->quote_info);
      return view('cart.quote-payment-place')->with('quotesinfo',$quotesinfo)->with("qid", $request->qid)->with('token', $token) ;      
    }

    public function update(Request $request)
    {
        $slug = $request->get('slug');
        $qty = abs($request->get('qty', 1));
        if (!Cart::canAddToCart($slug, $qty, $request->all())) {
            return redirect()->back()
                ->with(
                    'errorNotificationText',
                    'Not Enough Qty Available. Please with less qty or Contact site Administrator!'
                );
        }

        Cart::update($slug, $qty);
        $this->setTaxAmount($slug, $qty);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $delete_cart= DB::table('cart')
                         ->where("id",$id)
                         ->delete();
        return redirect()->back()->with('notificationText', 'Product has been removed from Cart!');
    }

    /**
     * Set the Tax Amount for the Product
     *
     * @param string $slug
     * @param int $qty
     * @param array $attributes
     * @return self $this
     */
    private function setTaxAmount($slug, $qty = 1, $attributes = [])
    {
        $productModel = $this->repository->findBySlug($slug);
        $isTaxEnabled = $this->configurationRepository->getValueByKey('tax_enabled');

        if ($isTaxEnabled && $productModel->is_taxable) {
            $percentage = $this->configurationRepository->getValueByKey('tax_percentage');

            if (null !== $attributes) {
                foreach ($attributes as $attributeId => $productId) {
                    $productModel = $this->repository->find($productId);
                }
            }

            $taxAmount = ($percentage * $productModel->price / 100) * $qty;
            Cart::hasTax(true);
            Cart::updateProductTax($slug, $taxAmount);
        }

        return $this;
    }
}
