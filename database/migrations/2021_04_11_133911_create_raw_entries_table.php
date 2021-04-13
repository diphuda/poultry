<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_entries', function (Blueprint $table) {
            $table->id();
//	        $table->foreignId('user_id')->index();
//	        $table->foreignId('raw_id')->index();
//	        $table->foreignId('vendor_id')->index();
	        $table->string('item_name');
	        $table->string('vendor_name');
	        $table->float('unit');
	        $table->float('unit_price');
	        $table->mediumText('qc_report');
	        $table->string('document')->nullable();
	        $table->boolean('is_approved')->default(false);
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
        Schema::dropIfExists('raw_entries');
    }
}
