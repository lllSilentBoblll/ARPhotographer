<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('albums', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->string('title', 150);
            $table->string('album_img', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('customer',150)->nullable();
            $table->string('model',255)->nullable();
            $table->string('camera', 100)->nullable();
            $table->integer('category_id')->unsigned()->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
