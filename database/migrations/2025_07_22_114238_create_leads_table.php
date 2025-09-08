<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {

            $table->id();
            $table->string('name');

            $table->unsignedBigInteger('assignee_id')->nullable(); // user who is assigned
            $table->foreign('assignee_id')->references('id')->on('users')->onDelete('set null');

            $table->dateTime('close_date')->nullable();

            $table->decimal('confidence', 5, 2)->nullable();

            $table->string('lead_status')->nullable()->comment('open,won,lost,cancelled,pending');

            $table->json('lead_flags')->nullable()->comment('watching, hot');

            $table->unsignedBigInteger('stage_id')->nullable()->default(1);
            $table->foreign('stage_id')->references('id')->on('lead_stages')->onDelete('set null');

            $table->unsignedBigInteger('tag_id')->nullable(); // from companies table
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
