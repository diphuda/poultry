<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('feed_id')->nullable();
            $table->foreignId('raw_id')->nullable();
            $table->decimal('unit_price', 15, 2);
            $table->decimal('amount', 15, 2);
            $table->string('buyer_name');
            $table->text('buyer_address');
            $table->string('buyer_phone');
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
        Schema::dropIfExists('distributions');
    }
}
