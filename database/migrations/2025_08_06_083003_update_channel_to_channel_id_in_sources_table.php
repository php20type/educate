<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            $table->dropColumn('channel');

            // Add new column as unsignedBigInteger
            $table->unsignedBigInteger('channel_id')->nullable()->after('name');

            // Add foreign key constraint explicitly
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            $table->dropForeign(['channel_id']);

            // Then drop the channel_id column
            $table->dropColumn('channel_id');

            // Re-add the old string column
            $table->string('channel')->after('name');
        });
    }
};
