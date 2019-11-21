<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['administrator','prowadzacy','student'])->default('student');
            $table->string('name');
            $table->string('surname');
            $table->string('email',50)->unique();
            $table->string('login',20)->unique();
            $table->string('password');
            $table->string('index_number')->nullable();
            $table->boolean('is_active')->default('true');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
