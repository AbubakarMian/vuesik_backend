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
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->bigInteger('is_public');
            // $table->Integer('total_followers');
            // $table->Double('lat');
            // $table->Double('long');
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->rememberToken();
            // $table->timestamps();

            // $table->bigIncrements('id');
            // $table->string('device_id',50);
            // $table->string('settings_id');
            // $table->string('email')->unique();
            // $table->string('password', 255)->nullable()->default(null);
            // $table->rememberToken();
            // $table->timestamps();
            // $table->softDeletes();
            $table->bigIncrements('id');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('username', 100)->nullable()->default(null);
            $table->date('dob');
            $table->string('phone_number',20)->nullable()->default(null);
            $table->string('bio')->nullable()->default(null);
            $table->string('instagram',100)->nullable()->default(null);
            $table->string('youtube',100)->nullable()->default(null);
            $table->string('followers')->nullable()->default(0);
            $table->string('likes')->nullable()->default(0);
            $table->string('email', 100)->unique();
            $table->string('password', 255)->nullable()->default(null);
            $table->string('avatar', 255)->nullable()->default(null);
            $table->string('social_login', 255)->nullable()->default(null);
            $table->string('social_id', 25)->nullable()->default(null);
            $table->string('access_token', 50)->nullable()->default(null);
            $table->string('gcm_token', 500)->nullable()->default(null);
            $table->string('device_type', 50)->nullable()->default(null);
            $table->bigInteger('role_id')->default(2);
            $table->boolean('get_notification')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
