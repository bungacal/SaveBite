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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('reviewer_photo')->nullable();
            $table->enum('reviewing_as', [
                'Food Donor', 
                'Food Receiver'
            ]); // UPDATED: lebih banyak opsi
            $table->date('submission_date');
            $table->text('letter');
            $table->boolean('is_approved')->default(false); 
            $table->timestamps();

            // Indexes untuk performa
            $table->index('submission_date');
            $table->index('reviewing_as');
            $table->index('is_approved');
            $table->index(['is_approved', 'submission_date']); // Compound index
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};