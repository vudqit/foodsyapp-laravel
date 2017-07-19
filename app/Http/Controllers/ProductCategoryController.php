<?php

namespace App\Http\Controllers;

use App\ProductCategory; 

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductCategoryController extends ApiController
{
    private $productCategory;

    public function __construct(ProductCategory $productCategory) 
    {
        $this->productCategory = $productCategory; 
    }

    public function getAll()
    {
        $productCategories = ProductCategory::all(); 

        return $this->listResponse($productCategories);
    }

    public function store(Request $request) 
    {
        $rules = [
            'name'      => 'required', 
            'place_id'  => 'required'
        ]; 

        $this->validate($request, $rules); 

        $productCategory = new ProductCategory(); 

        $productCategory->name = $request->name; 
        $productCategory->description = $request->description; 
        $productCategory->place_id = $request->place_id; 

        $productCategory->save(); 

        return $this->showResponse($productCategory); 
    }
}
