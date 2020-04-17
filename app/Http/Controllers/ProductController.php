<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\FirebaseLib;
use App\Product;

class ProductController extends Controller
{
	public static $firebase;
    public static $defaultPath = '/';

	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        self::$firebase = new FirebaseLib('https://study-cf15c.firebaseio.com/');
    }

    public function create(){
    	return view('product');
    }

    public function store(){
    	$product = new Product;
    	$id = $product->create(request()->all())->id;

    	//create notification
    	$this->createNotification(request()->all(), $id);
    	return view('product');
    }

    public function createNotification($product, $id){
    	$notificationObject = [
            'title' => $product['title'],
            'description' => $product['description'],
            'user_id' => auth()->user()->id,
            'created_at' => now()
        ];
        self::$firebase->set(self::$defaultPath . '/users/'. auth()->user()->id .'/counter/', 1);
        self::$firebase->set(self::$defaultPath . '/users/'. auth()->user()->id .'/notifications/' . $id, $notificationObject);
    }

}
