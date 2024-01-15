<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leeds', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('fatherName')->nullable();
            $table->string('motherName')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('email')->nullable();
            $table->date('birthDate')->nullable();
            $table->text('image')->nullable();
            $table->string('contractStatus')->nullable();
            $table->string('paymentStatus')->nullable();
            $table->string('consultStatus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leeds');
    }
};
