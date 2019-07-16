<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Models\Contracts\CategoryInterface;
use AvoRed\Framework\Models\Database\Product;
use Illuminate\Support\Collection;
use Session;
use DB;
use Auth;

class CategoryViewController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\CategoryRepository
    */
    protected $repository;

    public function __construct(CategoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
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

    /**
     *
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Http\Response
     *
     */
    public function view(Request $request, $maincat, $slug)
    {
        session_start();
        $productsOnCategoryPage = 20;
        $prefix = env('DB_TABLE_PREFIX', 'avored_');
       
        $category = $this->repository->findByKey($slug);
        $filters = $request->except(['page']);

        // custom query for the category products.
        $qry = "SELECT p.id FROM {$prefix}products as p INNER JOIN {$prefix}category_product as cp on p.id = cp.product_id ";

        foreach ($filters as $type => $filterArray) {
            if ('property' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $property = Property::whereIdentifier($identifier)->first();

                    if ('INTEGER' == $property->data_type) {
                        if (false === $propetryInnerJoinFlag) {
                            $propetryInnerJoinFlag = true;
                            $qry .= "INNER JOIN {$prefix}product_property_integer_values as ppiv ON p.id = ppiv.product_id ";
                        }
                    }
                }
            }

            if ('attribute' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $attribute = Attribute::whereIdentifier($identifier)->first();
                    if (false === $attributeInnerJoinFlag) {
                        $attributeInnerJoinFlag = true;
                        $qry .= "INNER JOIN {$prefix}product_attribute_integer_values as paiv ON p.id = paiv.product_id ";
                    }
                }
            }
        }

        $qry .= "WHERE p.type != 'VARIABLE_PRODUCT' AND p.section = '{$maincat}' AND cp.category_id = ? ";
        foreach ($filters as $type => $filterArray) {
            if ('property' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $property = Property::whereIdentifier($identifier)->first();

                    if ('INTEGER' == $property->data_type) {
                        $qry .= "AND ppiv.property_id = {$property->id} AND ppiv.value={$value} ";
                    }
                }
            }
        }

        foreach ($filters as $type => $filterArray) {
            if ('attribute' == $type) {
                foreach ($filterArray as $identifier => $value) {
                    $attribute = Attribute::whereIdentifier($identifier)->first();
                    $qry .= "AND paiv.attribute_id = {$attribute->id} AND paiv.value={$value} ";
                }
            }
        }

        $productss = DB::select($qry, [$category->id]);
        $collect = Collection::make([]);

        foreach ($productss as $productArray) {
            $product = Product::find($productArray->id);

            if ($product->type == 'VARIABLE_PRODUCT') {
                $collect->push(($product->getVariableMainProduct()));
            } else {
                $collect->push(Product::find($productArray->id));
            }
        }
        // echo '<pre>';print_r($collect);


        $products = $this->repository->paginateProducts($collect, $productsOnCategoryPage);

        foreach ($products as $value) {
            $get_product_custom_fields= DB::table('product_custom_fields')                                       
                                       ->where("product_id",$value->id)
                                       ->get();  
                                   
            $get_product_custom_fields = array_sort($get_product_custom_fields, 'custom_quantity', SORT_ASC);
            $get_product_custom_fields = array_values($get_product_custom_fields)[0];
            if(Auth::user()){
                $currency = Auth::user()->currency;
                if($get_product_custom_fields){
                    if($currency == "GBP"){
                       $value->product_price = $get_product_custom_fields->custom_price_pound;
                       $value->symbol = "£";
                    }else{
                       $base_price = $get_product_custom_fields->custom_price_pound;
                       $EUR_price = $this->get_euro_price($base_price);
                  
                       $value->product_price= $EUR_price;
                       $value->symbol = "€";
                    }
                }else{
                    if($currency == "GBP"){
                       $value->product_price = "";
                       $value->symbol = "£";
                    }else{
                       $value->product_price = "";
                       $value->symbol = "€";
                    }
                }    
            }else{                          
                if($get_product_custom_fields){
                    if(isset($_SESSION["currency"])) {                         
                        if($_SESSION["currency"] == "euro"){
                            $base_price = $get_product_custom_fields->custom_price_pound;
                             $EUR_price = $this->get_euro_price($base_price);
                        
                             $value->product_price= $EUR_price;
                             $value->symbol = "€";
                        }else{
                           $value->product_price = $get_product_custom_fields->custom_price_pound;
                               $value->symbol = "£";
                        }  
                    }else{
                        $value->product_price = $get_product_custom_fields->custom_price_pound;
                        $value->symbol = "£";
                    } 
                }else{
                    if(isset($_SESSION["currency"])) {                         
                        if($_SESSION["currency"] == "euro"){
                            $value->product_price = "";
                            $value->symbol = "€";

                        }else{
                          $value->product_price = "";
                          $value->symbol = "£";
                        }  
                    }else{
                        $value->product_price = "";
                        $value->symbol = "£";
                    } 
                }  
            }                          
        }
        //die;
       // echo "<pre>"; print_r($products); die;
        return view('category.view')
            ->with('category', $category)
            ->with('params', $request->all())
            ->with('products', $products ?? []);
    }
    public function products_all(Request $request)
    {
       session_start();
       $products = Product::get();
        foreach ($products as $value) {
            $get_product_custom_fields= DB::table('product_custom_fields')
                                       ->where("product_id",$value->id)
                                       ->first();
            if(Auth::user()){
                $currency = Auth::user()->currency;
                if($get_product_custom_fields){
                    if($currency == "GBP"){
                       $value->product_price = $get_product_custom_fields->custom_price_pound;
                       $value->symbol = "£";
                    }else{
                       $value->product_price = $get_product_custom_fields->custom_price_euro;
                       $value->symbol = "€";
                    }
                }else{
                    if($currency == "GBP"){
                       $value->product_price = "";
                       $value->symbol = "£";
                    }else{
                       $value->product_price = "";
                       $value->symbol = "€";
                    }
                }    
            }else{                          
                if($get_product_custom_fields){
                    if(isset($_SESSION["currency"])) {                         
                        if($_SESSION["currency"] == "euro"){
                            $value->product_price = $get_product_custom_fields->custom_price_euro;
                               $value->symbol = "€";
                        }else{
                           $value->product_price = $get_product_custom_fields->custom_price_pound;
                               $value->symbol = "£";
                        }  
                    }else{
                        $value->product_price = $get_product_custom_fields->custom_price_pound;
                        $value->symbol = "£";
                    } 
                }else{
                    if(isset($_SESSION["currency"])) {                         
                        if($_SESSION["currency"] == "euro"){
                            $value->product_price = "";
                            $value->symbol = "€";

                        }else{
                          $value->product_price = "";
                          $value->symbol = "£";
                        }  
                    }else{
                        $value->product_price = "";
                        $value->symbol = "£";
                    } 
                }  
            }                                                          
            //echo "<pre>"; print_r($get_product_custom_fields); die;
        }
          //echo "<pre>"; print_r($get_product_custom_fields); die;
        return view('category.all-product')->with("products",$products);
    }

    ///////////////////////////////////////

    public function cat_products(Request $request)
    {
        $get_products_id= DB::table('category_product')
                       ->where("category_id",$request->cat_id)
                       ->get();
        $categories= DB::table('categories')
                       ->where("id",$request->cat_id)
                       ->first();  
                                  
        $product_ids = array();               
        foreach ($get_products_id as $key => $value) {
                $product_ids[] = $value->product_id;
        }    
        $products= DB::table('products')
                       ->whereIn("id",$product_ids)
                       ->get();  
        $cat_info = array("cat_desc"=>$categories->description,"cat_name"=>$categories->name);
        foreach ($products as $value) {
            $get_product_custom_fields= DB::table('product_custom_fields')
                                       ->where("product_id",$value->id)
                                       ->first();
            $product_image= DB::table('product_images')
                       ->where("product_id",$value->id)
                       ->first();
            $value->image =  $product_image->path; 

            if(Auth::user()){
                $currency = Auth::user()->currency;
                if($get_product_custom_fields){
                    if($currency == "GBP"){
                       $value->product_price = $get_product_custom_fields->custom_price_pound;
                       $value->symbol = "£";
                    }else{
                       $value->product_price = $get_product_custom_fields->custom_price_euro;
                       $value->symbol = "€";
                    }
                }else{
                    if($currency == "GBP"){
                       $value->product_price = "";
                       $value->symbol = "£";
                    }else{
                       $value->product_price = "";
                       $value->symbol = "€";
                    }

                }   
            }else{                          
                if($get_product_custom_fields){
                    if(isset($_SESSION["currency"])) {                         
                        if($_SESSION["currency"] == "euro"){
                            $value->product_price = $get_product_custom_fields->custom_price_euro;
                               $value->symbol = "€";
                        }else{
                           $value->product_price = $get_product_custom_fields->custom_price_pound;
                               $value->symbol = "£";
                        }  
                    }else{
                        $value->product_price = $get_product_custom_fields->custom_price_pound;
                        $value->symbol = "£";
                    } 
                }else{
                    if(isset($_SESSION["currency"])) {                         
                        if($_SESSION["currency"] == "euro"){
                            $value->product_price = "";
                            $value->symbol = "€";

                        }else{
                          $value->product_price = "";
                          $value->symbol = "£";
                        }  
                    }else{
                        $value->product_price = "";
                        $value->symbol = "£";
                    } 
                }  
            }                                                          
            //echo "<pre>"; print_r($get_product_custom_fields); die;
        }
       // echo "<pre>"; print_r($products); die;  
        $data = array("products"=>$products,"cat_info"=>$cat_info);
        echo json_encode($data);         die;
        
    }
}
