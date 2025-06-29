<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_donates', function (Blueprint $table) {
            $table->id();
            // Food Information (from step 2)
            $table->string('food_name');
            $table->string('food_photo')->nullable();
            $table->integer('portion_quantity')->default(1);
            $table->string('best_within'); // MM/DD/YYYY format
            
            // Additional fields
            $table->enum('status', ['available', 'claimed', 'completed', 'expired'])->default('available');
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }
};