<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::table('iad__ads', function (Blueprint $table) {
      $table->integer('country_id')->unsigned()->nullable()->change();
      $table->integer('province_id')->unsigned()->nullable()->change();
      $table->integer('city_id')->unsigned()->nullable()->change();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {

  }
};
