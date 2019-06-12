<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Database\User;
use DB;

class SearchController extends Controller
{
    public function result(Request $request)
    {
        $queryParam = $request->get('q');

        $products = Product::where('name', 'like', '%' . $queryParam . '%')
            ->where('status', '=', 1)->paginate(9);

        return view('search.results')
            ->with('queryParam', $queryParam)
            ->with('products', $products);
    }

    public function index()
    {
        return view('search');
    }
 
    public function searchProducts(Request $request)
    {
        DB::enableQueryLog();
          $search = $request->get('q');
      
          $result = Product::where('name', 'LIKE', '%'. $search. '%')->get();
          // dd(DB::getQueryLog());
          //$result = array(array('name' => 'A4 Booklets Self Cover', 'link' => 'http://122.160.12.75:3044/quinnstheprinters/product/a4-booklets-self-cover-printing'), array('name' => 'A4 BOOKLETS HEAVY COVER GLOSS LAMINATED', 'link' =>'http://122.160.12.75:3044/quinnstheprinters/product/a4-booklets-heavy-cover-gloss-laminated-printing'));
 
          return response()->json($result);
            
    }
}
