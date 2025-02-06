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
            $table->string("time");
            $table->float("price")->default(0);
            $table->float("tarif")->default(0);
            $table->longText("description");
            $table->integer("balans");
            $table->float("reyting")->default(5.0);
            $table->integer("reyting_count");
            $table->string("image_url");
            $table->boolean("status_admin")->default(true);
            $table->boolean("status_drektor")->default(true);
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('companies');
    }
};