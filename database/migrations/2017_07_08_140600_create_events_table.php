<?php

use App\Event;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('photo')->nullable(); 
            $table->string('sale')->nullable();   
            $table->string('time_start')->nullable(); 
            $table->string('time_end')->nullable(); 
            $table->string('status')->default(Event::PENDING); 
            $table->integer('place_id')->unsigned(); 
            $table->timestamps();

            $table->foreign('place_id')->references('id')->on('places'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
