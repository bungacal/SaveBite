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
        Schema::create('donates', function (Blueprint $table) {
            $table->id();
            
            // Donor Information (from step 1)
            $table->string('donor_name');
            $table->text('donor_address');
            $table->string('donor_contact');
            $table->enum('pickup_method', ['delivery', 'self-pickup']);
        });
    }
};