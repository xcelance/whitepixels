<?php
namespace App\Helpers;
use View;
use Session;
use DB;
use Auth;
use AvoRed\Framework\Models\Database\Order;

class Apphelper
{
      public function bladeHelper($someValue)
      {
             return "increment $someValue";
      }

     public function show_categories()
     {    
           $prefix = \DB::getTablePrefix(); 
            $tablename = 'categories'; 

            //$result= DB::table($tablename)
                                //->get();               
           /* foreach ($get_categories as $value) {
                $get_subcategory =  DB::select("select cat.* , subcat.* from avored_categories as cat inner join avored_categories as subcat on cat.id = subcat.parent_id where cat.id=$value->id");
                if(!empty($get_subcategory)){
                  $value->subcategory = $get_subcategory;
                }else{
                  $value->subcategory = array();
                }  
            }*/
            $result = DB::select("select * from avored_categories ORDER BY name ASC");
           

            # Add each item to its parent's children list
           
            return $tree = $this->buildTree($result);  

     }
     public function cart_count()
     {    
           $prefix = \DB::getTablePrefix(); 
           if(Auth::user()){
            $cart= DB::table('cart')
                         ->where("user_id",Auth::user()->id)
                         ->count();
           }else{
            $cart = 0;
           }              

            # Add each item to its parent's children list
           
            return $cart;  

     }
     public function all_jobs_status()
     {    
         $orders = Order::whereUserId(Auth::user()->id)->whereNotIn("order_status_id",[5])->count();
         $completed_orders = Order::whereUserId(Auth::user()->id)->where("order_status_id",5)->count();
         $dispatch_orders = Order::whereUserId(Auth::user()->id)->where("order_status_id",4)->count();

         return $data = array("orders"=>$orders,"completed_orders"=>$completed_orders,"dispatch_orders"=>$dispatch_orders);


     }
     function buildTree($items) {/*
      echo "<pre>"; print_r($items); die;
*/
          $childs = array();

          foreach($items as &$item) 
            if($item->parent_id == null){
              $childs[0][] = &$item;
            }else{
              $childs[$item->parent_id][] = &$item;
            }
          unset($item);

          foreach($items as &$item) if (isset($childs[$item->id]))
                  $item->childs = $childs[$item->id];
                 return $childs[0];
      }


      function showCat($cat, $id) {
                  $aray[] = $cat[$id]['name'];
                  $children = $cat[$id]['children'];
                  if ($children) {
                      echo "<ul>";
                      foreach($children as $child_id) {
                          echo "<li>";
                          $this->showCat($cat, $child_id);
                          echo "</li>";
                      }
                      echo "</ul>";
                  }
              }

     public function showQueries()
     {
          dd(\DB::getQueryLog());
     }

     public static function instance()
     {
         return new AppHelper();
     }
}
?>