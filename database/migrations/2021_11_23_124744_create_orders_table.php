<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method', 15);
            $table->decimal('tax_price', 6,2)->nullable();
            $table->decimal('shipping_price', 8,2)->nullable();
            $table->decimal('total_price', 10, 2);
            $table->boolean('is_paid')->default(false);
            $table->dateTime('paid_at')->nullable();
            $table->boolean('is_delivered')->default(false);
            $table->dateTime('delivered_at')->nullable();
            $table->foreignId('user_id')
                    ->constrained('users')
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
        Schema::dropIfExists('orders');
    }
}
