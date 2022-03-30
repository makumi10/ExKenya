<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('longtiude');
            $table->string('latitude');
            $table->enum('region', ['Nairobi', 'Central', 'Coast', 'Rift Valley', 'Eastern', 'Nyanza', 'Western', 'North Eastern']);
            $table->text('details');
            $table->text('weather');
            // $table->string('currency');
            $table->string('population');
            $table->text('budget');
            $table->enum('budget_flag', ['Low', 'Medium', 'Expensive']);
            $table->enum('weather_flag', ['Cold', 'Moderate', 'Hot']);
            $table->enum('known_for', ['Shopping', 'Beaches', 'Tourist Attractions']);
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
        Schema::dropIfExists('counties');
    }
}