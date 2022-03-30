<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('county', ["Nairobi", "Kiambu", "Nyeri", "Kirinyaga", "Nyandarua", "Muranga", "Nakuru", "Turkana",  "West Pokot",  "Samburu", "Trans Nzoia", "Uasin Gishu", "Elgeyo-Marakwet", "Nandi", "Baringo", "Laikipia", "Narok", "Kajiado" , "Kericho", "Bomet", "Mombasa","Taita Taveta", "Lamu", "Tana River", "Kilifi", "Kwale", "Wajir", "Garissa", "Mandera", "Kakamega",  "Vihiga", "Bungoma", "Busia", "Marsabit", "Isiolo", "Meru", "Tharaka-Nithi", "Embu", "Kitui", "Machakos", "Makueni", "Siaya", "Kisumu", "Homabay", "Migori", "Kisii", "Nyamira", "Not a Kenyan Citizen" ]);
            $table->string('city');
            $table->string('about');
            $table->integer('age');
            $table->string('image')->default('default.jpg')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_details');
    }
}