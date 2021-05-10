<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raws', function (Blueprint $table) {
            $table->id();
	        $table->string('name')->unique();
	        $table->string('item_code')->unique();
	        $table->decimal('amount', 6, 2)->nullable()->default('0'); //available amount
	        $table->decimal('total_purchased_amount', 6, 2)->nullable()->default('0'); // total purchased amount from the beginning
	        $table->decimal('cost', 6, 2)->nullable()->default('0');
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
        Schema::dropIfExists('raws');
    }
}
