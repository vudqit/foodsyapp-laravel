<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory; 

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ProductController extends ApiController
{
    private $product;

    public function __construct(Product $product) 
    {
        $this->product = $product; 
    }

    protected $fillable = [
        'name', 
    	'description', 
    	'photo', 
    	'price', 
    	'type',
    	'status',
        'category_id', 
    	'place_id',
    ]; 

    public function getAll() 
    {
        $products = $this->product->all(); 

        return $this->listResponse($products);
    }

    public function store(Request $request) 
    {
        $this->checkUserHasOwnerPermission($request->token); 

        $rules = [
            'name'          => 'required',  
            'photo'         => 'image',
            'price'         => 'required',
            'category_id'   => 'required',
            'place_id'      => 'required'
        ]; 

        $this->validate($request, $rules);

        $photo = null; 
        if ($request->photo) {
            $photo = $request->photo->store('');
        }

        $product = new Product(); 

        $product->name          = $request->name;   
    	$product->description   = $request->description;
        $product->photo         = $photo;
        $product->price         = $request->price;
        $product->type          = $request->type;
        $product->category_id   = $request->category_id;
        $product->place_id      = $request->place_id;

        $product->save(); 

        return $this->showResponse($product);
    }

    public function update(Request $request) 
    {
        $this->checkUserHasOwnerPermission($request->token); 

        $product = $this->product->findOrFail($request->id); 

        $product->fill($request->intersect([
            'name', 
            'description', 
            'photo', 
            'price', 
            'type',
            'status',
            'category_id', 
        ]));

        if ($product->isClean()) {
            return $this->notUpdatedResponse('You need to specify different field to update!');
        }

        $rules = [
            'email' => 'email',
            'photo' => 'image'
        ]; 

        $this->validate($request, $rules);

        if ($request->photo) {
            $product->photo = $request->photo->store('');
        } 
        
        $product->save();

        return $this->showResponse($product); 
    }

    public function getPhoto($id) 
    {
        $product = $this->product->findOrFail($id); 

        if (!Storage::exists($product->photo)) {
            return $this->notAcceptQueryResponse('Image not found!'); 
        }

        $file = Storage::get($product->photo);
        $type = Storage::mimeType($product->photo);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }
}
