<?php

use App\Place; 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name', 50); 
            $table->text('description')->nullable(); 
            $table->string('address')->nullable();
            $table->string('city')->nullable(); 
            $table->string('phone_number', 15)->nullable(); 
            $table->string('email', 50)->nullable(); 
            $table->string('photo')->nullable(); 
            $table->string('price_limit', 25)->nullable(); 
            $table->string('time_open')->nullable(); 
            $table->string('time_close')->nullable();  
            $table->string('wifi_password', 50)->nullable(); 
            $table->float('latitude', 12, 9)->nullable(); 
            $table->float('longitude', 12, 9)->nullable(); 
            $table->string('status', 15)->default(Place::AVAILABLE); 
            $table->integer('user_id')->unsigned(); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
