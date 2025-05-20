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
        Schema::create('sports_fee_refunds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('registration_id'); // FK to sport_registers.id
            $table->string('registration_number');
            $table->unsignedBigInteger('batch_id');
            $table->unsignedBigInteger('section_id');
            $table->string('transaction_number',30);
            $table->decimal('total_fee_paid', 10, 2);
            $table->decimal('total_discount', 10, 2);
            $table->decimal('total_refunded', 10, 2);
            $table->decimal('refund_breakdown', 10, 2);
            $table->string('refund_method', 50);
            $table->date('refund_date');
            $table->text('reason');
            $table->string('approved_by');
            $table->softDeletes();
            $table->timestamps();
        
            // Foreign keys to the correct tables
            $table->foreign('registration_id')->references('id')->on('sport_registers')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('sport_batches')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sport_sections')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports_fee_refunds');
    }
};
