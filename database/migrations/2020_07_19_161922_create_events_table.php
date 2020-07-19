<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->longText('address');
            $table->dateTime('event_start');
            $table->dateTime('event_end');
            $table->longText('description')->nullable();
            $table->string('banner')->nullable();
            $table->enum('type', ['PAID', 'FREE', 'DONATION'])->nullable()->default('FREE');
            $table->double('quantity')->default(0);
            $table->double('price')->default(0);
            $table->dateTime('start_date_of_publish')->nullable();
            $table->dateTime('end_date_of_publish')->nullable();
            $table->enum('status', ['PUBLISH', 'DRAFT'])->nullable()->default('PUBLISH');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
