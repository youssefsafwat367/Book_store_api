<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name') ;
            $table->enum('status' , ['appear' , 'disappear'])->default('appear') ;
            $table->text('description') ;
            $table->string('author') ;
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->string('bestseller') ;
            $table->string('image');
            $table->string('stock') ;
            $table->string('price') ;
            $table->string('discount') ;
            $table->string('number_of_pages') ;
            $table->string('code') ;
            $table->string('price_after_discount') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
