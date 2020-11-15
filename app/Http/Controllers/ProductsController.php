<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    //getallproducts
    //getproductbyid
    //store
    //update
    //delete

    public function __construct()
    {
        $this->middleware('auth:api' , ['except' => ['getallproducts' , 'getproductbyid']]);

    }

    public function SuccededRequest($body)
    {
        return Response()->json(['status'=>'succeded' , 'body' => $body]);
    }
    public function FailedRequest()
    {
        return Response()->json(['status'=>'succeded' , 'body' => '']);
    }


    public function getallproducts()
    {
        $allrpoducts = Product::get();
        if(!$allrpoducts)
            return $this->FailedRequest();
        return $this->SuccededRequest($allrpoducts);
    }


    public function getproductbyid(Request $request)
    {
        $product = Product::find($request->id);
        if(!$product)
            return $this->FailedRequest();
        return $this->SuccededRequest($product);
    }

    public function getmyproduucts()
    {
        $products = Product::get()->where('user_id' , auth()->user()->id);
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $product = new Product() ;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->user_id = auth()->user()->id;
        // $product->user_id = $this->myproduct->id;
        $product->save();
        return response()->json(['msg'=>'added new prodect']);
    }

    protected function guard(){
        return Auth::guard('api');
    }
}
