<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('user_type')->default('student');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('registration_no')->nullable()->unique();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        User::create(['first_name' => 'Super', 'last_name' => 'Admin', 'user_type' => 'admin', 'email' => 'admin@admin.com', 'email_verified_at' => now(), 'password' => bcrypt('secret')]);
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
