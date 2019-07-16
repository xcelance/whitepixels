<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Models\Contracts\ProductInterface;
use Illuminate\Http\Request;
use AvoRed\Framework\Models\Contracts\ProductDownloadableUrlInterface;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Support\Collection;
use AvoRed\Framework\Models\Database\ProductAttributeIntegerValue;
use Session;
use DB;
use Auth;
class ProductViewController extends Controller
{
    /**
     * Product Repository
     * @var \AvoRed\Framework\Models\Repository\ProductRepository
     */
    protected $repository;

    /**
    * Product Downloadable Url Repository
    * @var \AvoRed\Framework\Models\Repository\ProductDownloadableUrlRepository
    */
    protected $downRep;

    public function __construct(
        ProductInterface $repository,
        ProductDownloadableUrlInterface $downRep
    ) {
        parent::__construct();

        $this->repository = $repository;
        $this->downRep = $downRep;
    }

    public function view($maincat,$slug)
    {
        $product = $this->repository->findBySlug($slug);
        $jsonData = [];
        session_start();
        if(Auth::user()){
                $currency = Auth::user()->currency;
                    if($currency == "GBP"){
                     
                       $currency_symbol = "£";
                    }else{
                       $currency_symbol = "€";
                    }
        }else{ 
                    if(isset($_SESSION["currency"])) {                         
                        if($_SESSION["currency"] == "euro"){
                            $currency_symbol = "€";

                        }else{
                          $currency_symbol = "£";
                        }  
                    }else{
                        $currency_symbol = "£";
                    } 
            }
        if($currency_symbol == "£"){
          $sustainable_paper_price = DB::table('configurations')
                    ->where("configuration_key","sustainable_paper_price_pound")
                    ->first();
          $sustainable_paper_price = $sustainable_paper_price->configuration_value;
          $sustainable_paper_price_symbol = "£"; 
          $printing_sample_price = DB::table('configurations')
                    ->where("configuration_key","printing_sample_price_pound")
                    ->first();
          $printing_sample_price = $printing_sample_price->configuration_value;
          $printing_sample_price_symbol = "£";           

        }else{
          $sustainable_paper_price = DB::table('configurations')
                    ->where("configuration_key","sustainable_paper_price_euro")
                    ->first();
          $sustainable_paper_price = $sustainable_paper_price->configuration_value;
          $sustainable_paper_price_symbol = "€"; 
          $printing_sample_price = DB::table('configurations')
                    ->where("configuration_key","printing_sample_price_euro")
                    ->first();
          $printing_sample_price = $printing_sample_price->configuration_value;
          $printing_sample_price_symbol = "€";

        } 

        $vat = DB::table('configurations')
                    ->where("configuration_key","vat_percent")
                    ->first();    
        $vat = $vat->configuration_value;

        $product_configuration = array("sustainable_paper_price"=>$sustainable_paper_price,"sustainable_paper_price_symbol"=>$sustainable_paper_price_symbol,"printing_sample_price"=>$printing_sample_price,"printing_sample_price_symbol"=>$printing_sample_price_symbol,"vat"=>$vat);

        if ($product->hasVariation()) {
            $jsonData = $product->getProductVariationJsonData();
        }
        $get_cat_id = DB::table('category_product')
                           ->where("product_id",$product->id)
                           ->first();
        $get_cat = DB::table('category_product')
                           ->where("category_id",$get_cat_id->category_id)
                           ->get(); 
        $get_relative = array();                   
            foreach ($get_cat as $value) {
                  
                    $relative_product = DB::select("select * from avored_products where id = $value->product_id AND section = '$maincat'");
                    if(!empty($relative_product)){
                      $get_relative[] =  $relative_product; 
                    }
                    # code...
            }
            //echo "<pre>"; print_r($get_relative); die;
      $get_product_fields= DB::table('product_custom_fields')
                           ->where("product_id",$product->id)
                           ->get();
      //echo "<pre>"; print_r($get_product_fields); die;                 
                $material_ids = array();                   
                foreach ($get_product_fields as $value) {
                    $material_ids[] = $value->material;

                }  
                $material_ids = array_unique($material_ids);

                $data_material = array();
                foreach ($material_ids as $value) {
                    $get_material = DB::table('custom_attribute_cat')
                               ->where("id",$value)
                               ->first();
                    $data_material["material"][] = $get_material;           
                } 
              //  echo "<pre>"; print_r($get_relative); die;                      
        $title = $product->meta_title ?? $product->name;
        $description = $product->meta_description ?? substr($product->description, 0, 255);
        return view('product.view')
            ->withProduct($product)
            ->with("get_relative",$get_relative)
            ->with("get_material",$data_material)
            ->with("product_configuration",$product_configuration)
            ->withTitle($title)
            ->withDescription($description)
            ->withJsonData($jsonData);
    }
    public function downloadDemoProduct(Request $request)
    {
        $downModel = $this->downRep->findByToken($request->get('product_token'));

        $path = storage_path('app/public' . DIRECTORY_SEPARATOR . $downModel->demo_path);
        return response()->download($path);
    }
    public function send_order(Request $request)
    {
       $order_day = $request->order_day;
       $order_price = $request->order_price;
       $select_sort = $request->select_sort;
       $dispatch_date = $request->dispatch_date;
       $order_date = $request->order_date;
       $custom_field_id = $request->custom_field_id;
       $order_price_symbol = $request->order_price_symbol;
       $quantity = $request->quantity;
       $vat = $request->vat;
       $sustainable_paper = $request->sustainable_paper;
       $printing_sample = $request->printing_sample;
       $data = array("order_day"=>$order_day,"order_price"=>$order_price,"select_sort"=>$select_sort,"dispatch_date"=>$dispatch_date,"order_date"=>$order_date,"custom_field_id"=>$custom_field_id,"order_price_symbol"=>$order_price_symbol,"quantity"=>$quantity,"vat"=>$vat,"sustainable_paper"=>$sustainable_paper,"printing_sample"=>$printing_sample);
       $data_encode = json_encode($data);
        
       if (Auth::user()) {   // Check is user logged in
           $orderprocess =  DB::table('orderprocess')->insertGetId(["order_data"=>$data_encode,"user_id"=>Auth::user()->id]);
           $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.time();

           $order_id = "W-".substr(str_shuffle($permitted_chars), 0, 8);
           DB::table('orderprocess')->where('id', $orderprocess)->update(['order_id' => $order_id]);
           $redirect = url("order/orderprocess?process=order&id=".$order_id);;
           $json = array("msg"=>"success","redirect"=>$redirect);
           echo json_encode($json);
        } else {
            $orderprocess =  DB::table('orderprocess')->insertGetId(["order_data"=>$data_encode]);
           $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.time();

           $order_id = "W-".substr(str_shuffle($permitted_chars), 0, 8); 
           DB::table('orderprocess')->where('id', $orderprocess)->update(['order_id' => $order_id]);
           $redirect = url("order/loginprocess?process=order&id=".$order_id);
           $json = array("msg"=>"success","redirect"=>$redirect);
           echo json_encode($json);
        }
    }

    public function get_custom_change_data(Request $request)
    {
      if((isset($request->material_id)) && (!isset($request->side_id)) && (!isset($request->orientation_id)) && (!isset($request->finishing_type_id)) && (!isset($request->printing_side_id)) && (!isset($request->shape_id)) && (!isset($request->sleeve_color_id)) && (!isset($request->size_id)) && (!isset($request->base_id))){

          $get_product_fields= DB::table('product_custom_fields')
                               ->where("product_id",$request->product_id)
                               ->where("material",$request->material_id)
                               ->orderBy('custom_quantity')
                               ->get();

          $material_ids = array();                   
          foreach ($get_product_fields as $value) {
              $material_ids[] = $value->material;

          }  
          $material_ids = array_unique($material_ids);

          $material = array();
          foreach ($material_ids as $value) {
              $get_material = DB::table('custom_attribute_cat')
                         ->where("id",$value)
                         ->first();
              $material["material"][] = $get_material;           
          }  
         //////////////////////////////////////////////////////////////////                                             
         // echo "<pre>"; print_r($material); die;
          if(!empty($material)){
            $material_id = $material["material"][0]->id;

            $get_side_fields = DB::table('product_custom_fields')
                               ->where("product_id",$request->product_id)
                               ->where("material",$material_id)
                               ->get();
         
            $side_ids = array();                   
            foreach ($get_side_fields as $value) {
                
                $side_ids[] = $value->side;

            }
            $side_ids = array_unique($side_ids);
            $side_data = array();
            foreach ($side_ids as $value) {
              if($value){
                 $get_side= DB::table('custom_attribute_cat')
                            ->where("id",$value)
                            ->first();
                 $side_data["side"][] = $get_side;
              }
                   
            }
          /////////////////////////////////////////////////////////////////////////////
            if(!empty($side_data)) {
                $side_id = $side_data["side"][0]->id;
            }else{
                $side_id = null;
            }  
            $get_orientation_fields= DB::table('product_custom_fields')
                               ->where("product_id",$request->product_id)
                               ->where("material",$material_id)
                               ->where("side",$side_id)
                               ->get();
            $orientation_ids = array();                   
                    foreach ($get_orientation_fields as $value) {
                        $orientation_ids[] = $value->orientation;

                    }
            $orientation_ids = array_unique($orientation_ids);
                     
                    $orientation_data = array();
                    foreach ($orientation_ids as $value) {
                        if($value){
                           $get_orientation= DB::table('custom_attribute_cat')
                                   ->where("id",$value)
                                   ->first();
                           $orientation_data["orientation"][] = $get_orientation;
                        }
                                   
                    }  
            //////////////////////////////////////////////////////////////////////////////        
                if(!empty($orientation_data)) {
                    $orientation_id = $orientation_data["orientation"][0]->id;
                }else{
                    $orientation_id = null;
                }

            $get_finishing_type_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->get();
            $finishing_type_ids = array();                   
                      foreach ($get_finishing_type_fields as $value) {
                          $finishing_type_ids[] = $value->finishing_type;

                      }
            $finishing_type_ids = array_unique($finishing_type_ids);
                       
                      $finishing_type_data = array();
                      foreach ($finishing_type_ids as $value) {
                          if($value){
                             $get_finishing_type= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $finishing_type_data["finishing_type"][] = $get_finishing_type;
                          }
                                     
                      }  
            //echo "<pre>"; print_r($finishing_type_data); die;
          /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($finishing_type_data)) {
                $finishing_type_id = $finishing_type_data["finishing_type"][0]->id;
            }else{
                $finishing_type_id = null;
            }     

        $get_printing_side_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->get();
        $printing_side_ids = array();                   
                foreach ($get_printing_side_fields as $value) {
                    $printing_side_ids[] = $value->printing_side;

                }
        $printing_side_ids = array_unique($printing_side_ids);
                 
                $printing_side_data = array();
                foreach ($printing_side_ids as $value) {
                    if($value){
                       $get_printing_side= DB::table('custom_attribute_cat')
                               ->where("id",$value)
                               ->first();
                       $printing_side_data["printing_side"][] = $get_printing_side;
                    }
                               
                }  
        ////////////////////////////////////////////////////////////////////////////////       
            if(!empty($printing_side_data)) {
                $printing_side_id = $printing_side_data["printing_side"][0]->id;
            }else{
                $printing_side_id = null;
            } 
        $get_shape_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->get();
            $shape_ids = array();                   
                      foreach ($get_shape_fields as $value) {
                          $shape_ids[] = $value->shape;

                      }
            $shape_ids = array_unique($shape_ids);
                       
                      $shape_data = array();
                      foreach ($shape_ids as $value) {
                          if($value){
                             $get_shape= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $shape_data["shape"][] = $get_shape;
                          }
                                     
                      } 
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($shape_data)) {
                $shape_id = $shape_data["shape"][0]->id;
            }else{
                $shape_id = null;
            } 
           $get_sleeve_color_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->get();
            $sleeve_color_ids = array();                   
                      foreach ($get_sleeve_color_fields as $value) {
                          $sleeve_color_ids[] = $value->sleeve_color;

                      }
            $sleeve_color_ids = array_unique($sleeve_color_ids);
                       
                      $sleeve_color_data = array();
                      foreach ($sleeve_color_ids as $value) {
                          if($value){
                             $get_sleeve_color= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $sleeve_color_data["sleeve_color"][] = $get_sleeve_color;
                          }
                                     
                      }   
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($sleeve_color_data)) {
                $sleeve_color_id = $sleeve_color_data["sleeve_color"][0]->id;
            }else{
                $sleeve_color_id = null;
            } 
            

            $get_size_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->get();
            $size_ids = array();                   
                      foreach ($get_size_fields as $value) {
                          $size_ids[] = $value->size;

                      }
            $size_ids = array_unique($size_ids);
                       
                      $size_data = array();
                      foreach ($size_ids as $value) {
                          if($value){
                             $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $size_data["size"][] = $get_size;
                          }
                                     
                      }             
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($size_data)) {
                $size_id = $size_data["size"][0]->id;
            }else{
                $size_id = null;
            } 

           

           

            $get_base_fields= DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$material_id)
                                 ->where("side",$side_id)
                                 ->where("orientation",$orientation_id)
                                 ->where("finishing_type",$finishing_type_id)
                                 ->where("printing_side",$printing_side_id)
                                 ->where("shape",$shape_id)
                                 ->where("sleeve_color",$sleeve_color_id)
                                 ->where("size",$size_id)
                                 ->get();
            $base_ids = array();                   
                      foreach ($get_base_fields as $value) {
                          $base_ids[] = $value->base;

                      }
            $base_ids = array_unique($base_ids);
                       
                      $base_data = array();
                      foreach ($base_ids as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
            //echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($base_data)) {
                $base_id = $base_data["base"][0]->id;
            }else{
                $base_id = null;
            } 

            $get_quanitity_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->where("size",$size_id)
                           ->where("base",$base_id)
                           ->get();  
       
            $quantity = array(); 
            $price = array(); 
            $symbol = array(); 
            $i = 0;  
            $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);           
            foreach ($get_quanitity_fields as $value) {
              $quantity["quantity_id"][]= $value->id;
                $quantity["quantity"][]= $value->custom_quantity;
                if($request->currency == "pound"){
                  $price["price"][]= $value->custom_price_pound;
                  $price["symbol"][]= "£";
                }else{
                  $base_price = $value->custom_price_pound;
                          $EUR_price = $this->get_euro_price($base_price);
                        
                          $price["price"][]= $EUR_price;
                          $price["symbol"][]= "€";
                }
                
            } 
            $quantity_price = array();
            $quantity_price = array_merge($quantity,$price,$symbol);
            $data_all = array_merge($material,$side_data,$orientation_data,$printing_side_data,$finishing_type_data,$size_data,$shape_data,$sleeve_color_data,$base_data,$quantity_price);
            //echo "<pre>"; print_r($quantity_price); die;
            echo json_encode($data_all);

            } 
      }
      ////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////

      if((isset($request->material_id)) && (isset($request->side_id)) && (!isset($request->orientation_id)) && (!isset($request->finishing_type_id)) && (!isset($request->printing_side_id)) && (!isset($request->shape_id)) && (!isset($request->sleeve_color_id)) && (!isset($request->size_id)) && (!isset($request->base_id))){
          $get_product_fields= DB::table('product_custom_fields')
                               ->where("product_id",$request->product_id)
                               ->where("material",$request->material_id)
                               ->where("side",$request->side_id)
                               ->get();  
          //echo "<pre>"; print_r($get_product_fields); die;  
         //////////////////////////////////////////////////////////////////                                             
         // echo "<pre>"; print_r($material); die;
            $get_side_fields = DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$request->material_id)
                                 ->where("side",$request->side_id)
                                 ->get();
         
            $side_ids = array();                   
            foreach ($get_side_fields as $value) {
                
                $side_ids[] = $value->side;

            }
            $side_ids = array_unique($side_ids);
            $side_data = array();
            foreach ($side_ids as $value) {
              if($value){
                 $get_side= DB::table('custom_attribute_cat')
                            ->where("id",$value)
                            ->first();
                 $side_data["side"][] = $get_side;
              }
                   
            }
          /////////////////////////////////////////////////////////////////////////////
            if(!empty($side_data)) {
                $side_id = $side_data["side"][0]->id;
            }else{
                $side_id = null;
            }  
            $get_orientation_fields= DB::table('product_custom_fields')
                               ->where("product_id",$request->product_id)
                               ->where("material",$request->material_id)
                               ->where("side",$side_id)
                               ->get();
            $orientation_ids = array();                   
                    foreach ($get_orientation_fields as $value) {
                        $orientation_ids[] = $value->orientation;

                    }
            $orientation_ids = array_unique($orientation_ids);
                     
                    $orientation_data = array();
                    foreach ($orientation_ids as $value) {
                        if($value){
                           $get_orientation= DB::table('custom_attribute_cat')
                                   ->where("id",$value)
                                   ->first();
                           $orientation_data["orientation"][] = $get_orientation;
                        }
                                   
                    }  
            //////////////////////////////////////////////////////////////////////////////        
                if(!empty($orientation_data)) {
                    $orientation_id = $orientation_data["orientation"][0]->id;
                }else{
                    $orientation_id = null;
                }

            $get_finishing_type_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->get();
            $finishing_type_ids = array();                   
                      foreach ($get_finishing_type_fields as $value) {
                          $finishing_type_ids[] = $value->finishing_type;

                      }
            $finishing_type_ids = array_unique($finishing_type_ids);
                       
                      $finishing_type_data = array();
                      foreach ($finishing_type_ids as $value) {
                          if($value){
                             $get_finishing_type= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $finishing_type_data["finishing_type"][] = $get_finishing_type;
                          }
                                     
                      }  
            //echo "<pre>"; print_r($finishing_type_data); die;
          /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($finishing_type_data)) {
                $finishing_type_id = $finishing_type_data["finishing_type"][0]->id;
            }else{
                $finishing_type_id = null;
            }     

        $get_printing_side_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->get();
        $printing_side_ids = array();                   
                foreach ($get_printing_side_fields as $value) {
                    $printing_side_ids[] = $value->printing_side;

                }
        $printing_side_ids = array_unique($printing_side_ids);
                 
                $printing_side_data = array();
                foreach ($printing_side_ids as $value) {
                    if($value){
                       $get_printing_side= DB::table('custom_attribute_cat')
                               ->where("id",$value)
                               ->first();
                       $printing_side_data["printing_side"][] = $get_printing_side;
                    }
                               
                }  
        ////////////////////////////////////////////////////////////////////////////////       
            if(!empty($printing_side_data)) {
                $printing_side_id = $printing_side_data["printing_side"][0]->id;
            }else{
                $printing_side_id = null;
            } 
        $get_shape_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->get();
            $shape_ids = array();                   
                      foreach ($get_shape_fields as $value) {
                          $shape_ids[] = $value->shape;

                      }
            $shape_ids = array_unique($shape_ids);
                       
                      $shape_data = array();
                      foreach ($shape_ids as $value) {
                          if($value){
                             $get_shape= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $shape_data["shape"][] = $get_shape;
                          }
                                     
                      } 
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($shape_data)) {
                $shape_id = $shape_data["shape"][0]->id;
            }else{
                $shape_id = null;
            } 
           $get_sleeve_color_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->get();
            $sleeve_color_ids = array();                   
                      foreach ($get_sleeve_color_fields as $value) {
                          $sleeve_color_ids[] = $value->sleeve_color;

                      }
            $sleeve_color_ids = array_unique($sleeve_color_ids);
                       
                      $sleeve_color_data = array();
                      foreach ($sleeve_color_ids as $value) {
                          if($value){
                             $get_sleeve_color= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $sleeve_color_data["sleeve_color"][] = $get_sleeve_color;
                          }
                                     
                      }   
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($sleeve_color_data)) {
                $sleeve_color_id = $sleeve_color_data["sleeve_color"][0]->id;
            }else{
                $sleeve_color_id = null;
            } 
            

            $get_size_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->get();
            $size_ids = array();                   
                      foreach ($get_size_fields as $value) {
                          $size_ids[] = $value->size;

                      }
            $size_ids = array_unique($size_ids);
                       
                      $size_data = array();
                      foreach ($size_ids as $value) {
                          if($value){
                             $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $size_data["size"][] = $get_size;
                          }
                                     
                      }             
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($size_data)) {
                $size_id = $size_data["size"][0]->id;
            }else{
                $size_id = null;
            } 

           

           

            $get_base_fields= DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$request->material_id)
                                 ->where("side",$side_id)
                                 ->where("orientation",$orientation_id)
                                 ->where("finishing_type",$finishing_type_id)
                                 ->where("printing_side",$printing_side_id)
                                 ->where("shape",$shape_id)
                                 ->where("sleeve_color",$sleeve_color_id)
                                 ->where("size",$size_id)
                                 ->get();
            $base_ids = array();                   
                      foreach ($get_base_fields as $value) {
                          $base_ids[] = $value->base;

                      }
            $base_ids = array_unique($base_ids);
                       
                      $base_data = array();
                      foreach ($base_ids as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
            //echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($base_data)) {
                $base_id = $base_data["base"][0]->id;
            }else{
                $base_id = null;
            } 

            $get_quanitity_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->where("size",$size_id)
                           ->where("base",$base_id)
                           ->get();  
       
            $quantity = array(); 
            $price = array(); 
            $symbol = array(); 
            $i = 0;   
            $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);          
            foreach ($get_quanitity_fields as $value) {
              $quantity["quantity_id"][]= $value->id;
                $quantity["quantity"][]= $value->custom_quantity;
                if($request->currency == "pound"){
                  $price["price"][]= $value->custom_price_pound;
                  $price["symbol"][]= "£";
                }else{
                  $base_price = $value->custom_price_pound;
                          $EUR_price = $this->get_euro_price($base_price);
                        
                          $price["price"][]= $EUR_price;
                          $price["symbol"][]= "€";
                }
                
            } 
            $quantity_price = array();
            $quantity_price = array_merge($quantity,$price,$symbol);
            $data_all = array_merge($orientation_data,$printing_side_data,$finishing_type_data,$size_data,$shape_data,$sleeve_color_data,$base_data,$quantity_price);
            //echo "<pre>"; print_r($quantity_price); die;
            echo json_encode($data_all);

      }
      /////////////////////////////////////////////////////////////// 
      ////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////

      if((isset($request->material_id)) && (isset($request->side_id)) && (isset($request->orientation_id)) && (!isset($request->finishing_type_id)) && (!isset($request->printing_side_id)) && (!isset($request->shape_id)) && (!isset($request->sleeve_color_id)) && (!isset($request->size_id)) && (!isset($request->base_id))){
        if($request->side_id == "null"){
           $request->side_id = null;
        }
         
          //echo "<pre>"; print_r($get_product_fields); die;  
         //////////////////////////////////////////////////////////////////                                             
         // echo "<pre>"; print_r($material); die;
           

          $get_finishing_type_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->get();
            $finishing_type_ids = array();                   
                      foreach ($get_finishing_type_fields as $value) {
                          $finishing_type_ids[] = $value->finishing_type;

                      }
            $finishing_type_ids = array_unique($finishing_type_ids);
                       
                      $finishing_type_data = array();
                      foreach ($finishing_type_ids as $value) {
                          if($value){
                             $get_finishing_type= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $finishing_type_data["finishing_type"][] = $get_finishing_type;
                          }
                                     
                      }  
            //echo "<pre>"; print_r($finishing_type_data); die;
          /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($finishing_type_data)) {
                $finishing_type_id = $finishing_type_data["finishing_type"][0]->id;
            }else{
                $finishing_type_id = null;
            }     

        $get_printing_side_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->get();
        $printing_side_ids = array();                   
                foreach ($get_printing_side_fields as $value) {
                    $printing_side_ids[] = $value->printing_side;

                }
        $printing_side_ids = array_unique($printing_side_ids);
                 
                $printing_side_data = array();
                foreach ($printing_side_ids as $value) {
                    if($value){
                       $get_printing_side= DB::table('custom_attribute_cat')
                               ->where("id",$value)
                               ->first();
                       $printing_side_data["printing_side"][] = $get_printing_side;
                    }
                               
                }  
        ////////////////////////////////////////////////////////////////////////////////       
            if(!empty($printing_side_data)) {
                $printing_side_id = $printing_side_data["printing_side"][0]->id;
            }else{
                $printing_side_id = null;
            } 
        $get_shape_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->get();
            $shape_ids = array();                   
                      foreach ($get_shape_fields as $value) {
                          $shape_ids[] = $value->shape;

                      }
            $shape_ids = array_unique($shape_ids);
                       
                      $shape_data = array();
                      foreach ($shape_ids as $value) {
                          if($value){
                             $get_shape= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $shape_data["shape"][] = $get_shape;
                          }
                                     
                      } 
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($shape_data)) {
                $shape_id = $shape_data["shape"][0]->id;
            }else{
                $shape_id = null;
            } 
           $get_sleeve_color_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->get();
            $sleeve_color_ids = array();                   
                      foreach ($get_sleeve_color_fields as $value) {
                          $sleeve_color_ids[] = $value->sleeve_color;

                      }
            $sleeve_color_ids = array_unique($sleeve_color_ids);
                       
                      $sleeve_color_data = array();
                      foreach ($sleeve_color_ids as $value) {
                          if($value){
                             $get_sleeve_color= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $sleeve_color_data["sleeve_color"][] = $get_sleeve_color;
                          }
                                     
                      }   
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($sleeve_color_data)) {
                $sleeve_color_id = $sleeve_color_data["sleeve_color"][0]->id;
            }else{
                $sleeve_color_id = null;
            } 
            

            $get_size_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->get();
            $size_ids = array();                   
                      foreach ($get_size_fields as $value) {
                          $size_ids[] = $value->size;

                      }
            $size_ids = array_unique($size_ids);
                       
                      $size_data = array();
                      foreach ($size_ids as $value) {
                          if($value){
                             $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $size_data["size"][] = $get_size;
                          }
                                     
                      }             
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($size_data)) {
                $size_id = $size_data["size"][0]->id;
            }else{
                $size_id = null;
            } 

           

           

            $get_base_fields= DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$request->material_id)
                                 ->where("side",$request->side_id)
                                 ->where("orientation",$request->orientation_id)
                                 ->where("finishing_type",$finishing_type_id)
                                 ->where("printing_side",$printing_side_id)
                                 ->where("shape",$shape_id)
                                 ->where("sleeve_color",$sleeve_color_id)
                                 ->where("size",$size_id)
                                 ->get();
            $base_ids = array();                   
                      foreach ($get_base_fields as $value) {
                          $base_ids[] = $value->base;

                      }
            $base_ids = array_unique($base_ids);
                       
                      $base_data = array();
                      foreach ($base_ids as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
            //echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($base_data)) {
                $base_id = $base_data["base"][0]->id;
            }else{
                $base_id = null;
            } 

            $get_quanitity_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->where("size",$size_id)
                           ->where("base",$base_id)
                           ->get(); 
           
                $quantity = array(); 
                $price = array(); 
                $symbol = array(); 
                $i = 0; 
                $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);            
                foreach ($get_quanitity_fields as $value) {
                  $quantity["quantity_id"][]= $value->id;
                    $quantity["quantity"][]= $value->custom_quantity;
                    if($request->currency == "pound"){
                      $price["price"][]= $value->custom_price_pound;
                      $price["symbol"][]= "£";
                    }else{
                      $base_price = $value->custom_price_pound;
                          $EUR_price = $this->get_euro_price($base_price);
                        
                          $price["price"][]= $EUR_price;
                          $price["symbol"][]= "€";
                    }
                    
                } 
                $quantity_price = array();
                $quantity_price = array_merge($quantity,$price,$symbol);
                $data_all = array_merge($finishing_type_data,$size_data,$shape_data,$sleeve_color_data,$base_data,$quantity_price);
                //echo "<pre>"; print_r($quantity_price); die;
                echo json_encode($data_all);

      }
      /////////////////////////////////////////////////////////////// 

      ////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////
      if((isset($request->material_id)) && (isset($request->side_id)) && (isset($request->orientation_id)) && (isset($request->finishing_type_id)) && (!isset($request->printing_side_id)) && (!isset($request->shape_id)) && (!isset($request->sleeve_color_id)) && (!isset($request->size_id)) && (!isset($request->base_id))){
        if($request->side_id == "null"){
           $request->side_id = null;
        }
        if($request->orientation_id == "null"){
           $request->orientation_id = null;
        }
        if($request->printing_side_id == "null"){
           $request->printing_side_id = null;
        }
        if($request->finishing_type_id == "null"){
           $request->finishing_type_id = null;
        }
        if($request->size_id == "null"){
           $request->size_id = null;
        }
        if($request->shape_id == "null"){
           $request->shape_id = null;
        }
        if($request->sleeve_color_id == "null"){
           $request->sleeve_color_id = null;
        }
        if($request->base_id == "null"){
           $request->base_id = null;
        }
          //echo "<pre>"; print_r($get_product_fields); die;  
         //////////////////////////////////////////////////////////////////                                             
         // echo "<pre>"; print_r($material); die;
              
        $get_printing_side_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->get();
        //echo "<pre>"; print_r($get_printing_side_fields); die;                
        $printing_side_ids = array();                   
                foreach ($get_printing_side_fields as $value) {
                    $printing_side_ids[] = $value->printing_side;

                }
        $printing_side_ids = array_unique($printing_side_ids);
                 
                $printing_side_data = array();
                foreach ($printing_side_ids as $value) {
                    if($value){
                       $get_printing_side= DB::table('custom_attribute_cat')
                               ->where("id",$value)
                               ->first();
                       $printing_side_data["printing_side"][] = $get_printing_side;
                    }
                               
                }  
        ////////////////////////////////////////////////////////////////////////////////       
            if(!empty($printing_side_data)) {
                $printing_side_id = $printing_side_data["printing_side"][0]->id;
            }else{
                $printing_side_id = null;
            } 
        $get_shape_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->get();
            $shape_ids = array();                   
                      foreach ($get_shape_fields as $value) {
                          $shape_ids[] = $value->shape;

                      }
            $shape_ids = array_unique($shape_ids);
                       
                      $shape_data = array();
                      foreach ($shape_ids as $value) {
                          if($value){
                             $get_shape= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $shape_data["shape"][] = $get_shape;
                          }
                                     
                      } 
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($shape_data)) {
                $shape_id = $shape_data["shape"][0]->id;
            }else{
                $shape_id = null;
            } 
           $get_sleeve_color_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->get();
            $sleeve_color_ids = array();                   
                      foreach ($get_sleeve_color_fields as $value) {
                          $sleeve_color_ids[] = $value->sleeve_color;

                      }
            $sleeve_color_ids = array_unique($sleeve_color_ids);
                       
                      $sleeve_color_data = array();
                      foreach ($sleeve_color_ids as $value) {
                          if($value){
                             $get_sleeve_color= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $sleeve_color_data["sleeve_color"][] = $get_sleeve_color;
                          }
                                     
                      }   
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($sleeve_color_data)) {
                $sleeve_color_id = $sleeve_color_data["sleeve_color"][0]->id;
            }else{
                $sleeve_color_id = null;
            } 
            

            $get_size_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->get();
            $size_ids = array();                   
                      foreach ($get_size_fields as $value) {
                          $size_ids[] = $value->size;

                      }
            $size_ids = array_unique($size_ids);
                       
                      $size_data = array();
                      foreach ($size_ids as $value) {
                          if($value){
                             $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $size_data["size"][] = $get_size;
                          }
                                     
                      }             
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($size_data)) {
                $size_id = $size_data["size"][0]->id;
            }else{
                $size_id = null;
            } 

           

           

            $get_base_fields= DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$request->material_id)
                                 ->where("side",$request->side_id)
                                 ->where("orientation",$request->orientation_id)
                                 ->where("finishing_type",$request->finishing_type_id)
                                 ->where("printing_side",$printing_side_id)
                                 ->where("shape",$shape_id)
                                 ->where("sleeve_color",$sleeve_color_id)
                                 ->where("size",$size_id)
                                 ->get();
            $base_ids = array();                   
                      foreach ($get_base_fields as $value) {
                          $base_ids[] = $value->base;

                      }
            $base_ids = array_unique($base_ids);
                       
                      $base_data = array();
                      foreach ($base_ids as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
            //echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($base_data)) {
                $base_id = $base_data["base"][0]->id;
            }else{
                $base_id = null;
            } 

            $get_quanitity_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->where("size",$size_id)
                           ->where("base",$base_id)
                           ->get(); 
           
                $quantity = array(); 
                $price = array(); 
                $symbol = array(); 
                $i = 0;  
                $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);           
                foreach ($get_quanitity_fields as $value) {
                  $quantity["quantity_id"][]= $value->id;
                    $quantity["quantity"][]= $value->custom_quantity;
                    if($request->currency == "pound"){
                      $price["price"][]= $value->custom_price_pound;
                      $price["symbol"][]= "£";
                    }else{
                      $base_price = $value->custom_price_pound;
                          $EUR_price = $this->get_euro_price($base_price);
                        
                          $price["price"][]= $EUR_price;
                          $price["symbol"][]= "€";
                    }
                    
                } 
                $quantity_price = array();
                $quantity_price = array_merge($quantity,$price,$symbol);
                $data_all = array_merge($printing_side_data,$size_data,$shape_data,$sleeve_color_data,$base_data,$quantity_price);
                //echo "<pre>"; print_r($quantity_price); die;
                echo json_encode($data_all);

      }
      ///////////////////////////////////////////////////////////////

      ////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////

      if((isset($request->material_id)) && (isset($request->side_id)) && (isset($request->orientation_id)) && (isset($request->finishing_type_id)) && (isset($request->printing_side_id)) && (!isset($request->shape_id)) && (!isset($request->sleeve_color_id)) && (!isset($request->size_id)) && (!isset($request->base_id))){
        
        if($request->side_id == "null"){
           $request->side_id = null;
        }
        if($request->orientation_id == "null"){
           $request->orientation_id = null;
        }
        if($request->printing_side_id == "null"){
           $request->printing_side_id = null;
        }
        if($request->finishing_type_id == "null"){
           $request->finishing_type_id = null;
        }
        if($request->size_id == "null"){
           $request->size_id = null;
        }
        if($request->shape_id == "null"){
           $request->shape_id = null;
        }
        if($request->sleeve_color_id == "null"){
           $request->sleeve_color_id = null;
        }
        if($request->base_id == "null"){
           $request->base_id = null;
        }
          //echo "<pre>"; print_r($get_product_fields); die;  
         //////////////////////////////////////////////////////////////////                                             
         // echo "<pre>"; print_r($material); die;
              
       
        $get_shape_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->get();
            $shape_ids = array();                   
                      foreach ($get_shape_fields as $value) {
                          $shape_ids[] = $value->shape;

                      }
            $shape_ids = array_unique($shape_ids);
                       
                      $shape_data = array();
                      foreach ($shape_ids as $value) {
                          if($value){
                             $get_shape= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $shape_data["shape"][] = $get_shape;
                          }
                                     
                      } 
           //echo "<pre>"; print_r($shape_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($shape_data)) {
                $shape_id = $shape_data["shape"][0]->id;
            }else{
                $shape_id = null;
            } 
           $get_sleeve_color_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->where("shape",$shape_id)
                           ->get();
            $sleeve_color_ids = array();                   
                      foreach ($get_sleeve_color_fields as $value) {
                          $sleeve_color_ids[] = $value->sleeve_color;

                      }
            $sleeve_color_ids = array_unique($sleeve_color_ids);
                       
                      $sleeve_color_data = array();
                      foreach ($sleeve_color_ids as $value) {
                          if($value){
                             $get_sleeve_color= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $sleeve_color_data["sleeve_color"][] = $get_sleeve_color;
                          }
                                     
                      }   
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($sleeve_color_data)) {
                $sleeve_color_id = $sleeve_color_data["sleeve_color"][0]->id;
            }else{
                $sleeve_color_id = null;
            } 
            

            $get_size_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->get();
            $size_ids = array();                   
                      foreach ($get_size_fields as $value) {
                          $size_ids[] = $value->size;

                      }
            $size_ids = array_unique($size_ids);
                       
                      $size_data = array();
                      foreach ($size_ids as $value) {
                          if($value){
                             $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $size_data["size"][] = $get_size;
                          }
                                     
                      }             
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($size_data)) {
                $size_id = $size_data["size"][0]->id;
            }else{
                $size_id = null;
            } 

           

           

            $get_base_fields= DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$request->material_id)
                                 ->where("side",$request->side_id)
                                 ->where("orientation",$request->orientation_id)
                                 ->where("finishing_type",$request->finishing_type_id)
                                 ->where("printing_side",$request->printing_side_id)
                                 ->where("shape",$shape_id)
                                 ->where("sleeve_color",$sleeve_color_id)
                                 ->where("size",$size_id)
                                 ->get();
            $base_ids = array();                   
                      foreach ($get_base_fields as $value) {
                          $base_ids[] = $value->base;

                      }
            $base_ids = array_unique($base_ids);
                       
                      $base_data = array();
                      foreach ($base_ids as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
            //echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($base_data)) {
                $base_id = $base_data["base"][0]->id;
            }else{
                $base_id = null;
            } 

            $get_quanitity_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->where("size",$size_id)
                           ->where("base",$base_id)
                           ->get(); 
           
                $quantity = array(); 
                $price = array(); 
                $symbol = array(); 
                $i = 0;   
                $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);          
                foreach ($get_quanitity_fields as $value) {
                  $quantity["quantity_id"][]= $value->id;
                    $quantity["quantity"][]= $value->custom_quantity;
                    if($request->currency == "pound"){
                      $price["price"][]= $value->custom_price_pound;
                      $price["symbol"][]= "£";
                    }else{
                         $base_price = $value->custom_price_pound;
                          $EUR_price = $this->get_euro_price($base_price);
                        
                          $price["price"][]= $EUR_price;
                          $price["symbol"][]= "€";
                    
                    }
                    
                } 
                $quantity_price = array();
                $quantity_price = array_merge($quantity,$price,$symbol);
                $data_all = array_merge($shape_data,$sleeve_color_data,$size_data,$base_data,$quantity_price);
                //echo "<pre>"; print_r($quantity_price); die;
                echo json_encode($data_all);

      }
      ///////////////////////////////////////////////////////////////

      ////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////

      if((isset($request->material_id)) && (isset($request->side_id)) && (isset($request->orientation_id)) && (isset($request->finishing_type_id)) && (isset($request->printing_side_id)) && (isset($request->shape_id)) && (!isset($request->sleeve_color_id)) && (!isset($request->size_id)) && (!isset($request->base_id))){
        
        if($request->side_id == "null"){
           $request->side_id = null;
        }
        if($request->orientation_id == "null"){
           $request->orientation_id = null;
        }
        if($request->printing_side_id == "null"){
           $request->printing_side_id = null;
        }
        if($request->finishing_type_id == "null"){
           $request->finishing_type_id = null;
        }
        if($request->size_id == "null"){
           $request->size_id = null;
        }
        if($request->shape_id == "null"){
           $request->shape_id = null;
        }
        if($request->sleeve_color_id == "null"){
           $request->sleeve_color_id = null;
        }
        if($request->base_id == "null"){
           $request->base_id = null;
        }
          //echo "<pre>"; print_r($get_product_fields); die;  
         //////////////////////////////////////////////////////////////////                                             
         // echo "<pre>"; print_r($material); die;
             
           $get_sleeve_color_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->where("shape",$request->shape_id)
                           ->get();
            $sleeve_color_ids = array();                   
                      foreach ($get_sleeve_color_fields as $value) {
                          $sleeve_color_ids[] = $value->sleeve_color;

                      }
            $sleeve_color_ids = array_unique($sleeve_color_ids);
                       
                      $sleeve_color_data = array();
                      foreach ($sleeve_color_ids as $value) {
                          if($value){
                             $get_sleeve_color= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $sleeve_color_data["sleeve_color"][] = $get_sleeve_color;
                          }
                                     
                      }   
          // echo "<pre>"; print_r($sleeve_color_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($sleeve_color_data)) {
                $sleeve_color_id = $sleeve_color_data["sleeve_color"][0]->id;
            }else{
                $sleeve_color_id = null;
            } 
            

            $get_size_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->where("shape",$request->shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->get();
            $size_ids = array();                   
                      foreach ($get_size_fields as $value) {
                          $size_ids[] = $value->size;

                      }
            $size_ids = array_unique($size_ids);
                       
                      $size_data = array();
                      foreach ($size_ids as $value) {
                          if($value){
                             $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $size_data["size"][] = $get_size;
                          }
                                     
                      }             
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($size_data)) {
                $size_id = $size_data["size"][0]->id;
            }else{
                $size_id = null;
            } 

           

           

            $get_base_fields= DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$request->material_id)
                                 ->where("side",$request->side_id)
                                 ->where("orientation",$request->orientation_id)
                                 ->where("finishing_type",$request->finishing_type_id)
                                 ->where("printing_side",$request->printing_side_id)
                                 ->where("shape",$request->shape_id)
                                 ->where("sleeve_color",$sleeve_color_id)
                                 ->where("size",$size_id)
                                 ->get();
            $base_ids = array();                   
                      foreach ($get_base_fields as $value) {
                          $base_ids[] = $value->base;

                      }
            $base_ids = array_unique($base_ids);
                       
                      $base_data = array();
                      foreach ($base_ids as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
            //echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($base_data)) {
                $base_id = $base_data["base"][0]->id;
            }else{
                $base_id = null;
            } 

            $get_quanitity_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->where("shape",$request->shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->where("size",$size_id)
                           ->where("base",$base_id)
                           ->get(); 
           
                $quantity = array(); 
                $price = array(); 
                $symbol = array(); 
                $i = 0;   
                $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);          
                foreach ($get_quanitity_fields as $value) {
                  $quantity["quantity_id"][]= $value->id;
                    $quantity["quantity"][]= $value->custom_quantity;
                    if($request->currency == "pound"){
                      $price["price"][]= $value->custom_price_pound;
                      $price["symbol"][]= "£";
                    }else{
                       //echo "<pre>"; print_r($get_quanitity_fields); die;
                        $base_price = $value->custom_price_pound;
                          $EUR_price = $this->get_euro_price($base_price);
                        
                          $price["price"][]= $EUR_price;
                          $price["symbol"][]= "€";
                    }
                    
                } 
                $quantity_price = array();
                $quantity_price = array_merge($quantity,$price,$symbol);
                $data_all = array_merge($sleeve_color_data,$size_data,$base_data,$quantity_price);
                //echo "<pre>"; print_r($quantity_price); die;
                echo json_encode($data_all);

      }
      ///////////////////////////////////////////////////////////////

      ////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////

      if((isset($request->material_id)) && (isset($request->side_id)) && (isset($request->orientation_id)) && (isset($request->finishing_type_id)) && (isset($request->printing_side_id)) && (isset($request->shape_id)) && (isset($request->sleeve_color_id)) && (!isset($request->size_id)) && (!isset($request->base_id))){
        
        if($request->side_id == "null"){
           $request->side_id = null;
        }
        if($request->orientation_id == "null"){
           $request->orientation_id = null;
        }
        if($request->printing_side_id == "null"){
           $request->printing_side_id = null;
        }
        if($request->finishing_type_id == "null"){
           $request->finishing_type_id = null;
        }
        if($request->size_id == "null"){
           $request->size_id = null;
        }
        if($request->shape_id == "null"){
           $request->shape_id = null;
        }
        if($request->sleeve_color_id == "null"){
           $request->sleeve_color_id = null;
        }
        if($request->base_id == "null"){
           $request->base_id = null;
        }
          //echo "<pre>"; print_r($get_product_fields); die;  
         //////////////////////////////////////////////////////////////////                                             
         // echo "<pre>"; print_r($material); die;
             
          
            $get_size_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->where("shape",$request->shape_id)
                           ->where("sleeve_color",$request->sleeve_color_id)
                           ->get();
            $size_ids = array();                   
                      foreach ($get_size_fields as $value) {
                          $size_ids[] = $value->size;

                      }
            $size_ids = array_unique($size_ids);
                       
                      $size_data = array();
                      foreach ($size_ids as $value) {
                          if($value){
                             $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $size_data["size"][] = $get_size;
                          }
                                     
                      }             
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($size_data)) {
                $size_id = $size_data["size"][0]->id;
            }else{
                $size_id = null;
            } 

           

           

            $get_base_fields= DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$request->material_id)
                                 ->where("side",$request->side_id)
                                 ->where("orientation",$request->orientation_id)
                                 ->where("finishing_type",$request->finishing_type_id)
                                 ->where("printing_side",$request->printing_side_id)
                                 ->where("shape",$request->shape_id)
                                 ->where("sleeve_color",$request->sleeve_color_id)
                                 ->where("size",$size_id)
                                 ->get();
            $base_ids = array();                   
                      foreach ($get_base_fields as $value) {
                          $base_ids[] = $value->base;

                      }
            $base_ids = array_unique($base_ids);
                       
                      $base_data = array();
                      foreach ($base_ids as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
            //echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($base_data)) {
                $base_id = $base_data["base"][0]->id;
            }else{
                $base_id = null;
            } 

            $get_quanitity_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->where("shape",$request->shape_id)
                           ->where("sleeve_color",$request->sleeve_color_id)
                           ->where("size",$size_id)
                           ->where("base",$base_id)
                           ->get(); 
           
                $quantity = array(); 
                $price = array(); 
                $symbol = array(); 
                $i = 0;  
                $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);           
                foreach ($get_quanitity_fields as $value) {
                  $quantity["quantity_id"][]= $value->id;
                    $quantity["quantity"][]= $value->custom_quantity;
                    if($request->currency == "pound"){
                      $price["price"][]= $value->custom_price_pound;
                      $price["symbol"][]= "£";
                    }else{
                       //echo "<pre>"; print_r($get_quanitity_fields); die;
                      $base_price = $value->custom_price_pound;
                        $EUR_price = $this->get_euro_price($base_price);
                      
                        $price["price"][]= $EUR_price;
                        $price["symbol"][]= "€";
                    }
                    
                } 
                $quantity_price = array();
                $quantity_price = array_merge($quantity,$price,$symbol);
                $data_all = array_merge($size_data,$base_data,$quantity_price);
                //echo "<pre>"; print_r($quantity_price); die;
                echo json_encode($data_all);

      }
      ///////////////////////////////////////////////////////////////

      ////////////////////////////////////////////////////////////
//echo "<pre>"; print_r($_REQUEST); 
      if((isset($request->material_id)) && (isset($request->side_id)) && (isset($request->orientation_id)) && (isset($request->finishing_type_id)) && (isset($request->printing_side_id)) && (isset($request->shape_id)) && (isset($request->sleeve_color_id)) && (isset($request->size_id)) && (!isset($request->base_id))){
        
        if($request->side_id == "null"){
           $request->side_id = null;
        }
        if($request->orientation_id == "null"){
           $request->orientation_id = null;
        }
        if($request->printing_side_id == "null"){
           $request->printing_side_id = null;
        }
        if($request->finishing_type_id == "null"){
           $request->finishing_type_id = null;
        }
        if($request->size_id == "null"){
           $request->size_id = null;
        }
        if($request->shape_id == "null"){
           $request->shape_id = null;
        }
        if($request->sleeve_color_id == "null"){
           $request->sleeve_color_id = null;
        }
        if($request->base_id == "null"){
           $request->base_id = null;
        }
          //echo "<pre>"; print_r($get_product_fields); die;  
         //////////////////////////////////////////////////////////////////                                             
         // echo "<pre>"; print_r($material); die;
             
          
            

            $get_base_fields= DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$request->material_id)
                                 ->where("side",$request->side_id)
                                 ->where("orientation",$request->orientation_id)
                                 ->where("finishing_type",$request->finishing_type_id)
                                 ->where("printing_side",$request->printing_side_id)
                                 ->where("shape",$request->shape_id)
                                 ->where("sleeve_color",$request->sleeve_color_id)
                                 ->where("size",$request->size_id)
                                 ->get();
            $base_ids = array();                   
                      foreach ($get_base_fields as $value) {
                          $base_ids[] = $value->base;

                      }
            $base_ids = array_unique($base_ids);
                       
                      $base_data = array();
                      foreach ($base_ids as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
            //echo "<pre>"; print_r($base_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($base_data)) {
                $base_id = $base_data["base"][0]->id;
            }else{
                $base_id = null;
            } 

            $get_quanitity_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$request->material_id)
                           ->where("side",$request->side_id)
                           ->where("orientation",$request->orientation_id)
                           ->where("finishing_type",$request->finishing_type_id)
                           ->where("printing_side",$request->printing_side_id)
                           ->where("shape",$request->shape_id)
                           ->where("sleeve_color",$request->sleeve_color_id)
                           ->where("size",$request->size_id)
                           ->where("base",$base_id)
                           ->get(); 
           
                $quantity = array(); 
                $price = array(); 
                $symbol = array(); 
                $i = 0;  
                $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);           
                foreach ($get_quanitity_fields as $value) {
                    $quantity["quantity_id"][]= $value->id;
                    $quantity["quantity"][]= $value->custom_quantity;
                    if($request->currency == "pound"){
                      $price["price"][]= $value->custom_price_pound;
                      $price["symbol"][]= "£";
                    }else{
                       //echo "<pre>"; print_r($get_quanitity_fields); die;
                        $base_price = $value->custom_price_pound;
                          $EUR_price = $this->get_euro_price($base_price);
                        
                          $price["price"][]= $EUR_price;
                          $price["symbol"][]= "€";
                    }
                    
                } 
                $quantity_price = array();
                $quantity_price = array_merge($quantity,$price,$symbol);
                $data_all = array_merge($base_data,$quantity_price);
                //echo "<pre>"; print_r($quantity_price); die;
                echo json_encode($data_all);

      }
      ///////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////////////////

      if((isset($request->material_id)) && (isset($request->side_id)) && (isset($request->orientation_id)) && (isset($request->printing_side_id)) && (isset($request->finishing_type_id)) && (isset($request->size_id)) && (isset($request->shape_id)) && (isset($request->sleeve_color_id)) && (isset($request->base_id))){
        session_start();
        

        if($request->side_id == "null"){
           $request->side_id = null;
        }
        if($request->orientation_id == "null"){
           $request->orientation_id = null;
        }
        if($request->printing_side_id == "null"){
           $request->printing_side_id = null;
        }
        if($request->finishing_type_id == "null"){
           $request->finishing_type_id = null;
        }
        if($request->size_id == "null"){
           $request->size_id = null;
        }
        if($request->shape_id == "null"){
           $request->shape_id = null;
        }
        if($request->sleeve_color_id == "null"){
           $request->sleeve_color_id = null;
        }
        if($request->base_id == "null"){
           $request->base_id = null;
        }
       


              $get_quanitity_fields= DB::table('product_custom_fields')
                                     ->where("product_id",$request->product_id)
                                     ->where("material",$request->material_id)
                                     ->where("side",$request->side_id)
                                     ->where("orientation",$request->orientation_id)
                                     ->where("printing_side",$request->printing_side_id)
                                     ->where("finishing_type",$request->finishing_type_id)
                                     ->where("size",$request->size_id)
                                     ->where("shape",$request->shape_id)
                                     ->where("sleeve_color",$request->sleeve_color_id)
                                     ->where("base",$request->base_id)
                                     ->get();  
           
                $quantity = array(); 
                $price = array(); 
                $symbol = array(); 
                $i = 0;  
                $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);           
                foreach ($get_quanitity_fields as $value) {
                    $quantity["quantity_id"][]= $value->id;
                    $quantity["quantity"][]= $value->custom_quantity;
                    if($request->currency == "pound"){
                      $price["price"][]= $value->custom_price_pound;
                      $price["symbol"][]= "£";
                    }else{
                      $base_price = $value->custom_price_pound;
                      $EUR_price = $this->get_euro_price($base_price);
                      
                        $price["price"][]= $EUR_price;
                        $price["symbol"][]= "€";
                    }
                    
                } 
                $_SESSION['currency'] =  $request->currency;
                if(Auth::user()){
                $currency = Auth::user()->currency;
                    if($currency == "GBP"){
                     
                       $currency_symbol = "£";
                    }else{
                       $$currency_symbol = "€";
                    }
                }else{ 
                            if(isset($_SESSION["currency"])) {                         
                                if($_SESSION["currency"] == "euro"){
                                    $currency_symbol = "€";

                                }else{
                                  $currency_symbol = "£";
                                }  
                            }else{
                                $currency_symbol = "£";
                            } 
                    }
        if($currency_symbol == "£"){
          $sustainable_paper_price = DB::table('configurations')
                    ->where("configuration_key","sustainable_paper_price_pound")
                    ->first();
          $sustainable_paper_price = $sustainable_paper_price->configuration_value;
          $sustainable_paper_price_symbol = "£"; 
          $printing_sample_price = DB::table('configurations')
                    ->where("configuration_key","printing_sample_price_pound")
                    ->first();
          $printing_sample_price = $printing_sample_price->configuration_value;
          $printing_sample_price_symbol = "£";           

        }else{
          $sustainable_paper_price = DB::table('configurations')
                    ->where("configuration_key","sustainable_paper_price_euro")
                    ->first();
          $sustainable_paper_price = $sustainable_paper_price->configuration_value;
          $sustainable_paper_price_symbol = "€"; 
          $printing_sample_price = DB::table('configurations')
                    ->where("configuration_key","printing_sample_price_euro")
                    ->first();
          $printing_sample_price = $printing_sample_price->configuration_value;
          $printing_sample_price_symbol = "€";

        } 
       $printing_sample_price_symbol;
        $vat = DB::table('configurations')
                    ->where("configuration_key","vat_percent")
                    ->first();    
        $vat = $vat->configuration_value;
        $product_configuration = array("sustainable_paper_price"=>$sustainable_paper_price,"sustainable_paper_price_symbol"=>$sustainable_paper_price_symbol,"printing_sample_price"=>$printing_sample_price,"printing_sample_price_symbol"=>$printing_sample_price_symbol,"vat"=>$vat);

                $quantity_price = array();
                $quantity_price = array_merge($quantity,$price,$symbol,$product_configuration);
                $data_all = $quantity_price; 
                //echo "<pre>"; print_r($quantity_price); die;
                echo json_encode($data_all);

        }
      ///////////////////////////////////////////////////////////////


           die;

      ///////////////////////////////////////////////////////////////
    }  

    public function get_custom_data(Request $request)
    {

      $product_data= DB::table('products')
                           ->where("id",$request->product_id)
                           ->first();

      $product_name = $product_data->name;
      
      $product_description = $product_data->description;
      $product_long_description = html_entity_decode($product_data->long_description);

      $product_data_image= DB::table('product_images')
                           ->where("product_id",$request->product_id)
                           ->first();
      if($product_data_image){    
         $product_image =  $product_data_image->path;
      }else{
         $product_image =  "/img/default-product.jpg";
      }                    
      //echo "<pre>"; print_r($product_data_image); die; 
      $material_note = $product_data->material_note_text;
      $productData = array("product_name" =>$product_name,"material_note" =>$material_note,"product_description" =>$product_description,"product_long_description" =>$product_long_description,"product_image" =>$product_image);  

      $get_product_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->orderBy('custom_quantity', 'asc')
                           ->get();


      $material_ids = array();                   
      foreach ($get_product_fields as $value) {
          if($value->material != ""){
            $material_ids[] = $value->material;
          }
          

      }  
      $material_ids = array_unique($material_ids);

      $material = array();
      foreach ($material_ids as $value) {
          $get_material = DB::table('custom_attribute_cat')
                     ->where("id",$value)
                     ->first();
          $material["material"][] = $get_material;           
      }  

     //////////////////////////////////////////////////////////////////                                             
     //echo "<pre>"; print_r($material_ids); die;
      if(!empty($material)){
        $material_id = $material["material"][0]->id;

        $get_side_fields = DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->orderBy('custom_quantity', 'asc')
                           ->get();
     
        $side_ids = array();                   
        foreach ($get_side_fields as $value) {
            
            $side_ids[] = $value->side;

        }
        $side_ids = array_unique($side_ids);
        $side_data = array();
        foreach ($side_ids as $value) {
          if($value){
             $get_side= DB::table('custom_attribute_cat')
                        ->where("id",$value)
                        ->first();
             $side_data["side"][] = $get_side;
          }
               
        }

      /////////////////////////////////////////////////////////////////////////////
        if(!empty($side_data)) {
            $side_id = $side_data["side"][0]->id;
        }else{
            $side_id = null;
        }  
        $get_orientation_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->get();
        $orientation_ids = array();                   
                foreach ($get_orientation_fields as $value) {
                    $orientation_ids[] = $value->orientation;

                }
        $orientation_ids = array_unique($orientation_ids);
                 
                $orientation_data = array();
                foreach ($orientation_ids as $value) {
                    if($value){
                       $get_orientation= DB::table('custom_attribute_cat')
                               ->where("id",$value)
                               ->first();
                       $orientation_data["orientation"][] = $get_orientation;
                    }
                               
                }  

        //////////////////////////////////////////////////////////////////////////////        
            if(!empty($orientation_data)) {
                $orientation_id = $orientation_data["orientation"][0]->id;
            }else{
                $orientation_id = null;
            }

          $get_finishing_type_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->orderBy('custom_quantity', 'asc')
                           ->get();
            $finishing_type_ids = array();                   
                      foreach ($get_finishing_type_fields as $value) {
                          $finishing_type_ids[] = $value->finishing_type;

                      }
            $finishing_type_ids = array_unique($finishing_type_ids);
                       
                      $finishing_type_data = array();
                      foreach ($finishing_type_ids as $value) {
                          if($value){
                             $get_finishing_type= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $finishing_type_data["finishing_type"][] = $get_finishing_type;
                          }
                                     
                      }  
            //echo "<pre>"; print_r($finishing_type_data); die;
          /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($finishing_type_data)) {
                $finishing_type_id = $finishing_type_data["finishing_type"][0]->id;
            }else{
                $finishing_type_id = null;
            }     

        $get_printing_side_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->orderBy('custom_quantity', 'asc')
                           ->get();
        $printing_side_ids = array();                   
                foreach ($get_printing_side_fields as $value) {
                    $printing_side_ids[] = $value->printing_side;

                }
        $printing_side_ids = array_unique($printing_side_ids);
                 
                $printing_side_data = array();
                foreach ($printing_side_ids as $value) {
                    if($value){
                       $get_printing_side= DB::table('custom_attribute_cat')
                               ->where("id",$value)
                               ->first();
                       $printing_side_data["printing_side"][] = $get_printing_side;
                    }
                               
                }  
        ////////////////////////////////////////////////////////////////////////////////       
            if(!empty($printing_side_data)) {
                $printing_side_id = $printing_side_data["printing_side"][0]->id;
            }else{
                $printing_side_id = null;
            } 
        $get_shape_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->orderBy('custom_quantity', 'asc')
                           ->get();
            $shape_ids = array();                   
                      foreach ($get_shape_fields as $value) {
                          $shape_ids[] = $value->shape;

                      }
            $shape_ids = array_unique($shape_ids);
                       
                      $shape_data = array();
                      foreach ($shape_ids as $value) {
                          if($value){
                             $get_shape= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $shape_data["shape"][] = $get_shape;
                          }
                                     
                      } 
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($shape_data)) {
                $shape_id = $shape_data["shape"][0]->id;
            }else{
                $shape_id = null;
            } 
           $get_sleeve_color_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->orderBy('custom_quantity', 'asc')
                           ->get();
            $sleeve_color_ids = array();                   
                      foreach ($get_sleeve_color_fields as $value) {
                          $sleeve_color_ids[] = $value->sleeve_color;

                      }
            $sleeve_color_ids = array_unique($sleeve_color_ids);
                       
                      $sleeve_color_data = array();
                      foreach ($sleeve_color_ids as $value) {
                          if($value){
                             $get_sleeve_color= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $sleeve_color_data["sleeve_color"][] = $get_sleeve_color;
                          }
                                     
                      }   
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($sleeve_color_data)) {
                $sleeve_color_id = $sleeve_color_data["sleeve_color"][0]->id;
            }else{
                $sleeve_color_id = null;
            } 
            

            $get_size_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->orderBy('custom_quantity', 'asc')
                           ->get();
            $size_ids = array();                   
                      foreach ($get_size_fields as $value) {
                          $size_ids[] = $value->size;

                      }
            $size_ids = array_unique($size_ids);
                       
                      $size_data = array();
                      foreach ($size_ids as $value) {
                          if($value){
                             $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $size_data["size"][] = $get_size;
                          }
                                     
                      }             
          // echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($size_data)) {
                $size_id = $size_data["size"][0]->id;
            }else{
                $size_id = null;
            } 

           

           

            $get_base_fields= DB::table('product_custom_fields')
                                 ->where("product_id",$request->product_id)
                                 ->where("material",$material_id)
                                 ->where("side",$side_id)
                                 ->where("orientation",$orientation_id)
                                 ->where("finishing_type",$finishing_type_id)
                                 ->where("printing_side",$printing_side_id)
                                 ->where("shape",$shape_id)
                                 ->where("sleeve_color",$sleeve_color_id)
                                 ->where("size",$size_id)
                                 ->orderBy('custom_quantity', 'asc')
                                 ->get();
            $base_ids = array();                   
                      foreach ($get_base_fields as $value) {
                          $base_ids[] = $value->base;

                      }
            $base_ids = array_unique($base_ids);
                       
                      $base_data = array();
                      foreach ($base_ids as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
            //echo "<pre>"; print_r($size_data); die;
            /////////////////////////////////////////////////////////////////////////////////       
            if(!empty($base_data)) {
                $base_id = $base_data["base"][0]->id;
            }else{
                $base_id = null;
            } 

            $get_quanitity_fields= DB::table('product_custom_fields')
                           ->where("product_id",$request->product_id)
                           ->where("material",$material_id)
                           ->where("side",$side_id)
                           ->where("orientation",$orientation_id)
                           ->where("finishing_type",$finishing_type_id)
                           ->where("printing_side",$printing_side_id)
                           ->where("shape",$shape_id)
                           ->where("sleeve_color",$sleeve_color_id)
                           ->where("size",$size_id)
                           ->where("base",$base_id)
                           ->orderBy('custom_quantity', 'asc')
                           ->get();  
       
            $quantity = array(); 
            $price = array(); 
            $symbol = array(); 
            $i = 0;  
            $get_quanitity_fields = array_sort($get_quanitity_fields, 'custom_quantity', SORT_ASC);

            foreach ($get_quanitity_fields as $value) {
                $quantity["quantity_id"][]= $value->id;
                $quantity["quantity"][]= $value->custom_quantity;
                if($request->currency == "pound"){
                  $price["price"][]= $value->custom_price_pound;
                  $price["symbol"][]= "£";
                }else{
                  //echo "<pre>"; print_r($get_quanitity_fields); die;
                  $base_price = $value->custom_price_pound;
                    $EUR_price = $this->get_euro_price($base_price);
                  
                    $price["price"][]= $EUR_price;
                    $price["symbol"][]= "€";

                }
                
            } 
           //echo "<pre>"; print_r($price); die;
            $quantity_price = array();
            $quantity_price = array_merge($quantity,$price,$symbol);
            // print_r($quantity_price);die;
            $data_all = array_merge($material,$side_data,$orientation_data,$printing_side_data,$finishing_type_data,$size_data,$shape_data,$sleeve_color_data,$base_data,$quantity_price,$productData);

           // echo "<pre>"; print_r($data_all); die;
            echo json_encode($data_all);

      }else{

        echo json_encode(array('product_name'=>$product_name,'product_description'=>$product_description,'product_image'=>$product_image));
      }     
                                    
    }
    public function get_euro_price($price){
      // Fetching JSON
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
    public function get_order_detail_data(Request $request)
    {
        if($request->side_id == "null"){
           $request->side_id = null;
        }
        if($request->orientation_id == "null"){
           $request->orientation_id = null;
        }
        if($request->printing_side_id == "null"){
           $request->printing_side_id = null;
        }
        if($request->finishing_type_id == "null"){
           $request->finishing_type_id = null;
        }
        if($request->size_id == "null"){
           $request->size_id = null;
        }
        if($request->shape_id == "null"){
           $request->shape_id = null;
        }
        if($request->sleeve_color_id == "null"){
           $request->sleeve_color_id = null;
        }
        if($request->base_id == "null"){
           $request->base_id = null;
        }
              $get_fields= DB::table('product_custom_fields')
                                     ->where("id",$request->quantity_id)
                                     ->first();
              $product_data = array();
              $product_data["field_id"] = $request->quantity_id;
              if($get_fields->product_id){
                $get_product= DB::table('products')
                                     ->where("id",$get_fields->product_id)
                                     ->first();
                $get_product_cat_id= DB::table('category_product')
                                     ->where("product_id",$get_fields->product_id)
                                     ->first(); 
                $get_product_cat= DB::table('categories')
                                     ->where("id",$get_product_cat_id->category_id)
                                     ->first();                
                $product_data["product"] = $get_product->name;
                $product_data["category"] = $get_product_cat->name;                  
              }
              if($get_fields->material){
                $get_material= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->material)
                                     ->first();
                $product_data["material"] = $get_material->name;                  
              }
              if($get_fields->side){
                $get_side= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->side)
                                     ->first();
                $product_data["side"] = $get_side->name;                  
              }
              if($get_fields->orientation){
                $get_orientation= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->orientation)
                                     ->first();
                $product_data["orientation"] = $get_orientation->name;                  
              }
              if($get_fields->printing_side){
                $get_printing_side= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->printing_side)
                                     ->first();
                $product_data["printing_side"] = $get_printing_side->name;                  
              }
              if($get_fields->finishing_type){
                $get_finishing_type= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->finishing_type)
                                     ->first();
                $product_data["finishing_type"] = $get_finishing_type->name;                  
              }
              if($get_fields->size){
                $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->size)
                                     ->first();
                $product_data["size"] = $get_size->name;                  
              }
              if($get_fields->size){
                $get_size= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->size)
                                     ->first();
                $product_data["size"] = $get_size->name;                  
              }
              if($get_fields->shape){
                $get_shape= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->shape)
                                     ->first();
                $product_data["shape"] = $get_shape->name;                  
              }
              if($get_fields->sleeve_color){
                $get_sleeve_color= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->sleeve_color)
                                     ->first();
                $product_data["sleeve_color"] = $get_sleeve_color->name;                  
              }
              if($get_fields->base){
                $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$get_fields->base)
                                     ->first();
                $product_data["base"] = $get_base->name;                  
              }
              if($get_fields->custom_quantity){
                $product_data["quantity"] = $get_fields->custom_quantity;                  
              }
                      foreach ($get_fields as $value) {
                          if($value){
                             $get_base= DB::table('custom_attribute_cat')
                                     ->where("id",$value)
                                     ->first();
                             $base_data["base"][] = $get_base;
                          }
                                     
                      } 
              $pound_org_price = $get_fields->custom_price_pound;  
              $tat_price = json_decode($get_fields->tat_price_pound);
              $tat_days = json_decode($get_fields->tat_days);

              $base_price = $pound_org_price;
              $EUR_price = $this->get_euro_price($base_price);
                      
              $euro_org_price = $EUR_price;
              $prepare_days = $get_fields->prepare_days;
              $tat_price_pound = json_decode($get_fields->tat_price_pound);
              $tat_price_euro = array();
              foreach ($tat_price as $key => $value) {
                $tat_price_euro[] = $this->get_euro_price($value);
              }
              $price = array();
             // print_r($tat_days);die;
              if($request->currency == "pound"){
                // $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>0,"day"=>$prepare_days);
                if(!empty($tat_days)){
                    $count = 0;
                    for($i = 0; $i < count($tat_days); $i++){
                          $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>$tat_price[$i],"day"=>$tat_days[$i]);
                    }
                }
              }else{

                if(!empty($tat_days)){
                    $count = 0;
                    for($i = 0; $i < count($tat_days); $i++){
                          $price["price"][] = array("symbol"=>"€","price"=>$EUR_price,"tat_price"=>$tat_price_euro[$i],"day"=>$tat_days[$i]);
                    }
                }

                /*$price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>0,"day"=>$prepare_days);
                if(!empty($tat_price_euro)){
                    $count = 0;
                    for($i = $prepare_days - 1; $i >= $prepare_days - count($tat_price_euro); $i--){

                       for($k = $count;$k < count($tat_price_euro);$k++){
                          $price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>$tat_price_euro[$k],"day"=>$i);
                          break;
                       }
                       $count++;

                    }

                }*/
              } 
             //  print_r($price);die;
              $array_data = array(); 
              $array_data["product_data"] = $product_data;
                $data = array_merge($array_data,$price);
                $data_all = $data; 
                //echo "<pre>"; print_r($quantity_price); die;
                echo json_encode($data_all);
      ///////////////////////////////////////////////////////////////
    }
    public function get_sort_data(Request $request)
    {
        
              $get_fields= DB::table('product_custom_fields')
                                     ->where("id",$request->field_id)
                                     ->first();                    
              
              $pound_org_price = $get_fields->custom_price_pound; 
              $base_price = $pound_org_price;
              $EUR_price = $this->get_euro_price($base_price);
              $tat_price = json_decode($get_fields->tat_price_pound);
              //echo "<pre>"; print_r($tat_price); die;
              $tat_days = json_decode($get_fields->tat_days);  
              $euro_org_price = $get_fields->custom_price_euro;
              $prepare_days = $get_fields->prepare_days;
              $tat_price_pound = json_decode($get_fields->tat_price_pound);
              //$tat_price_euro = json_decode($get_fields->tat_price_euro);
              $tat_price_euro = array();
              foreach ($tat_price as $key => $value) {
                $tat_price_euro[] = $this->get_euro_price($value);
              }
             // echo "<pre>"; print_r($tat_price_euro); die;
              $price = array();
              // print_r($request->all());
              $price["quantity"]  = $get_fields->custom_quantity;
              $sort = $request->sort;
               if($request->currency == "pound"){
                // $price["price"][] = array("symbol"=>"£","price"=>$pound_org_price,"tat_price"=>0,"day"=>$prepare_days);
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

               /* $price["price"][] = array("symbol"=>"€","price"=>$euro_org_price,"tat_price"=>0,"day"=>$prepare_days,"sort"=>$sort);
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
               // echo "<pre>"; print_r($price); die;
                echo json_encode($price);
      ///////////////////////////////////////////////////////////////
    }
  

    public function downloadMainProduct(Request $request)
    {
        $downModel = $this->downRep->findByToken($request->get('product_token'));

        $path = storage_path('app/public' . DIRECTORY_SEPARATOR . $downModel->main_path);
        return response()->download($path);
    }
}
