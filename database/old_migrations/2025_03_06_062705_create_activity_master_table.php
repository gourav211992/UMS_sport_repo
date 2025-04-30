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
        Schema::create('activity_master', function (Blueprint $table) {
            $table->id();
            $table->string('sport_name');
            $table->string('activity_name');
            $table->string('parent_group');
            $table->json('sub_activities'); 
            $table->string('Duration(min)');
            $table->string('description');
            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_master');
    }
};
