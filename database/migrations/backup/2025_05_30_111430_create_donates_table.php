<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donates', function (Blueprint $table) {
            $table->id();
            
            // HANYA Donor Information (from browseA2 form)
            $table->string('donor_name', 100);
            $table->text('donor_address');
            $table->string('donor_contact', 20);
            $table->enum('pickup_method', ['delivery', 'self-pickup'])->default('self-pickup');
            
            // Status tracking
            $table->enum('status', ['pending', 'approved', 'collected', 'completed', 'cancelled'])
                  ->default('pending');
            $table->datetime('donation_date')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('status');
            $table->index('donation_date');
            $table->index('pickup_method');
        });

        Schema::table('foods', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donates');
    }
};