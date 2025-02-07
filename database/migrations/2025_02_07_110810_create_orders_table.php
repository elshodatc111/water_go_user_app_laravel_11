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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('count');
            $table->string('addres');
            $table->float('latuda');
            $table->float('longitude');
            $table->string('status')->default('new');
            $table->dateTime('create_time');
            $table->dateTime('pedding_time')->nullable();
            $table->dateTime('succes_time')->nullable();
            $table->dateTime('cancel_time')->nullable();
            $table->text('cancel_discription')->nullable();
            $table->unsignedBigInteger('currer_id')->nullable();
            $table->boolean('reyting_status')->default(false);
            $table->float('reyting')->default(5);
            $table->text('reyting_discription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
