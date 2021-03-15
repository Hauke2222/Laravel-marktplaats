<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('postcode');
            $table->string('woonplaats');
            $table->string('alternatieve_schrijfwijzen');
            $table->string('gemeente');
            $table->string('provincie');
            $table->string('netnummer');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('soort');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zip_codes');
    }
}
