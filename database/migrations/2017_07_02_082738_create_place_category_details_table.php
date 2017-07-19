<?php

use App\PlaceCategoryDetail; 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceCategoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_category_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id')->unsigned(); 
            $table->integer('category_id')->unsigned(); 
            $table->string('status', 15)->default(PlaceCategoryDetail::AVAILABLE); 
            $table->timestamps();

            $table->foreign('place_id')->references('id')->on('places'); 
            $table->foreign('category_id')->references('id')->on('place_categories'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_category_details');
    }
}
