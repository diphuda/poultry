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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('raw_id')->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained();
            $table->string('unit');
            $table->decimal('unit_price',6, 2);
            $table->decimal('amount', 6, 2);
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
