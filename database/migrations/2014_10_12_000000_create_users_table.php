<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            ['name'=>'kurniawan',
             'email'=>'kurniawan@mail.com',
             'email_verified_at'=>date('y-m-d h:i:s'),
             'password'=>bcrypt('kurniawan'),
             'remember_token'=>'ONE'],
             ['name'=>'admin',
              'email'=>'admin@mail.com',
              'email_verified_at'=>date('y-m-d h:i:s'),
              'password'=>bcrypt('admin'),
              'remember_token'=>'ADMN',]
        ]);
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
