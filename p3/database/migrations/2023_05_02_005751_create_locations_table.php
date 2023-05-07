<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->bigInteger('lat')->nullable();
            $table->bigInteger('long')->nullable();
            $table->string('picture_url')->nullable();
            $table->string('loc_url')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};