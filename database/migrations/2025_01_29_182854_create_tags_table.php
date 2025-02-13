<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('url_clean', 255)->unique(); // Longitud reducida a 255
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tags');
    }
};
