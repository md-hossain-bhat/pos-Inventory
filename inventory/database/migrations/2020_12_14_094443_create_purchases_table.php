<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('category_id');
            $table->integer('product_id');
            $table->date('date');
            $table->longText('description');
            $table->double('buying_qty');
            $table->double('unit_price');
            $table->double('buying_price');
            $table->integer('user_id');
            $table->string('purchase_no');
            $table->tinyInteger('status')->default('0')->comment('0=Pending,1=Approved');
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
        Schema::dropIfExists('purchases');
    }
}
