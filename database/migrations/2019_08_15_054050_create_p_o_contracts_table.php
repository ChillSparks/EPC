<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePOContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('po_no');
            $table->date('po_date');
            $table->string('supplier');
            $table->string('do_no');
            $table->date('do_date');  
            $table->string('created_by'); 
            $table->string('updated_by');   
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
        Schema::dropIfExists('po_contracts');
    }
}
