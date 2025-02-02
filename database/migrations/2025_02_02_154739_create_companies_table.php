<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone");
            $table->string("image");
            $table->string("discription");
            $table->string("work_time");
            $table->integer("price");
            $table->string("status");
            $table->integer("balans");
            $table->integer("tarif");
            $table->integer("star_count");
            $table->string("star");
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('companies');
    }
};