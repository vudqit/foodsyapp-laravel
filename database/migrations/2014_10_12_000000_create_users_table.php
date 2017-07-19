<?php

use App\User; 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50)->unique(); 
            $table->string('display_name', 50); 
            $table->string('email', 50)->nullable();
            $table->string('password'); 
            $table->string('phone_number', 15)->nullable(); 
            $table->string('address')->nullable();
            $table->string('photo')->default('user_image.png');
            $table->char('gender', 1)->default(User::GENDER_NONE); 
            $table->string('role', 15)->default(User::ROLE_USER);  
            $table->string('status', 15)->default(User::AVAILABLE);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
