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
        Schema::table('posts', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id')->after('id');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete();


            // 1. creo la colonna dell FK
            $table->unsignedBigInteger('category_id')->nullable()->after('user_id');
            // 2. assegno la FK alla colonna creata
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('set null'); // quando viene eliminata una categoria nella tabella posts category_id = null


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // 1. elimino la FK
            $table->dropForeign(['user_id']);
            // 2. drop della colonna
            $table->dropColumn('user_id');
            // 1. elimino la FK
            $table->dropForeign(['category_id']);
            // 2. drop della colonna
            $table->dropColumn('category_id');
        });

    }
};
