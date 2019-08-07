<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Codedb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('QrCode', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codes',255);
            $table->timestamp('created_at');
            $table->boolean("sent")->default(0);
            $table->timestamp("sent_at")->nullable();
            $table->boolean("used")->default(0);
            $table->timestamp("used_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('QrCode');
    }
}
