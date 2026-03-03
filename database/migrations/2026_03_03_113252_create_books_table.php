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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete()
                ->index();

            $table->string('title')->index();
            $table->string('author')->index();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->index();
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->string('isbn')->unique();
            $table->date('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
