<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('region', 200);
            $table->string('country', 200);
            $table->string('item_type', 200);
            $table->string('sales_channel', 200);
            $table->string('order_priority', 200);
            $table->string('order_date');
            $table->bigInteger('order_id');
            $table->string('ship_date');
            $table->bigInteger('units_sold');
            $table->double('unit_price');
            $table->double('unit_cost');
            $table->double('total_revenue');
            $table->double('total_cost');
            $table->double('total_profit');
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
        Schema::dropIfExists('sales');
    }
}
