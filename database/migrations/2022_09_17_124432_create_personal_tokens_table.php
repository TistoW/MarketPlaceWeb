<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTokensTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('personal_tokens', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->default(0);
            $table->string('token')->nullable();
            $table->string('abilities')->nullable();
            $table->timestamp('lastUsedAt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('personal_tokens');
    }
}
