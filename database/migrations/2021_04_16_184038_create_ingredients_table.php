<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('raw_id')->references('id')->on('raws')->onDelete('cascade');
            $table->foreignId('supplier_id');
            $table->decimal('unit_price', 15, 2);
            $table->decimal('amount', 15, 2);
            $table->string('file')->nullable();
            $table->string('qc_report');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
