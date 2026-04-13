<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('first_name', 8);
            $table->string('last_name', 8);
            $table->string('gender');
            $table->string('email', 255);
            $table->string('tel1', 5);
            $table->string('tel2', 5);
            $table->string('tel3', 5);
            $table->string('address');
            $table->string('building')->nullable();
            $table->text('type');
            $table->text('detail', 120);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
