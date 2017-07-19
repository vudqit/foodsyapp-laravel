<?php

use App\Comment; 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message'); 
            $table->string('photo')->nullable(); 
            $table->float('rating', 2, 1)->unsigned(); 
            $table->integer('like')->unsigned(); 
            $table->integer('user_id')->unsigned(); 
            $table->integer('place_id')->unsigned(); 
            $table->string('status', 15)->default(Comment::AVAILABLE); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('comments');
    }
}
