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
        Schema::create('app_survey', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->tinyInteger('age')->nullable();
            $table->text('description')->nullable();

            $table->bigInteger('setA')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_surveys');
    }
};
