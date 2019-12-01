<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('user_id')->nullable(true);
			$table->string('type')->nullable(true);
			$table->string('title')->nullable(true);
			$table->longText('description')->nullable(true);
			$table->string('bread')->nullable(true);
			$table->string('year')->nullable(true);
			$table->string('month')->nullable(true);
			$table->string('state')->nullable(true);
			$table->string('district')->nullable(true);
			$table->string('locality')->nullable(true);
			$table->string('edited')->nullable(true);
			$table->string('status')->nullable(true);		
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
        Schema::dropIfExists('ads');
    }
}
