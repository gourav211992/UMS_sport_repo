<?php use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsMasterTable extends Migration
{
    public function up()
    {
        Schema::create('sports_master', function (Blueprint $table) {
            $table->id();
            $table->string('sport_name', 50);
            $table->string('sport_type', 50);
            $table->string('status', 20)->index();

          
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            $table->timestamps();

            $table->index(['sport_name', 'sport_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sports_master');
    }
}
