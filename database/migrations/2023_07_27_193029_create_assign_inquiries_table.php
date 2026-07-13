<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_inquiries', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('sid');
            $table->foreign('sid')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('inquiryid');
            $table->foreign('inquiryid')->references('id')->on('inquiries')->onDelete('cascade');
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
        Schema::dropIfExists('assign_inquiries');
    }
}
