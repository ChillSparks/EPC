<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDOItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('do_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('p_o_contract_id')->unsigned();
            $table->string('item_name');
            $table->decimal('unit', 6, 0);
            $table->decimal('qty', 8, 3);
            $table->decimal('price', 10, 3);
            $table->decimal('amt', 12, 3);
            $table->string('brand',255);  
            $table->string('mfg_country',255);
            $table->string('mfg_company',255);
            $table->string('mfg_date');
            $table->foreign('p_o_contract_id')->references('id')->on('po_contracts')
                   ->onDelete('cascade');
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
        Schema::dropIfExists('do_items');
    }
}
