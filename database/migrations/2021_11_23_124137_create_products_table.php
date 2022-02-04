<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('brand', 25)->nullable();
            $table->string('category', 25)->nullable();
            $table->text('description')->nullable();
            $table->text('images')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('num_reviews')->nullable();
            $table->decimal('price', 10,2)->nullable();
            $table->integer('count_in_stock')->nullable();
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
        Schema::dropIfExists('products');
    }
}
