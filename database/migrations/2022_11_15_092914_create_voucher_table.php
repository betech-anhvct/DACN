<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('condition')->default(1);
            $table->string('product_list');
            $table->string('description')->nullable();
            $table->string('quantity')->default('100');
            $table->dateTime('begin_date');
            $table->dateTime('end_date');
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('voucher');
    }
}
