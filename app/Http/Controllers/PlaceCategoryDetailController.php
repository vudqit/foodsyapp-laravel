<?php

namespace App\Http\Controllers;

use App\PlaceCategoryDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class PlaceCategoryDetailController extends ApiController
{
    private $placeCategoryDetail; 

    public function __construct(PlaceCategoryDetailController $placeCategoryDetail) 
    {
        $this->placeCategoryDetail = $placeCategoryDetail; 
    }

}
