<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->string('browser');
            $table->string('status')->default('guest'); // guest hoặc logged-in
            $table->string('device_type');
            $table->string('operating_system');
            $table->string('ip_address');
            $table->string('country')->nullable();
            $table->text('log')->nullable();
            $table->timestamp('last_accessed')->nullable();
            $table->integer('total_pages_accessed')->default(0);
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
        //
    }
}
