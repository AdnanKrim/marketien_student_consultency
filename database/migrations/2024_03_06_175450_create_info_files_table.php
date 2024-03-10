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
        Schema::create('info_files', function (Blueprint $table) {
            $table->id();
            $table->string('documentType')->nullable();
            $table->integer('leedId')->nullable();
            $table->string('documentName')->nullable();
            $table->string('institutionName')->nullable();
            $table->text('certificates')->nullable();
            $table->text('markSheet')->nullable();
            $table->text('docFile')->nullable();
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
        Schema::dropIfExists('info_files');
    }
};
