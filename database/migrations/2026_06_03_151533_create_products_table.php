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
            $table->string('name');
            $table->string('slug');
            $table->foreignId('category_id') ->constrained('categories') ->onDelete('cascade');
            $table->text('short_description') ->nullable();
            $table->longText('description') ->nullable();
            $table->decimal('original_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->integer('quantity') ->default(0);
            $table->string('warranty') ->nullable();
            $table->boolean('is_active') ->default(true);
            $table->boolean('is_featured') ->default(false);
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
