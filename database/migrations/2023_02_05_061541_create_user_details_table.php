<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_category_id');
            $table->string('firstname');
            $table->string('surname');
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('picture')->nullable();
            $table->string('resume');
            $table->text('summary');
            $table->text('job_level');
            $table->text('education');
            $table->text('employment_type');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_category_id')->references('id')->on('company_categories');
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
        Schema::dropIfExists('user_details');
    }
}
