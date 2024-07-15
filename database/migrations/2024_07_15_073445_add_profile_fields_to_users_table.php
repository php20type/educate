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
        Schema::table('users', function (Blueprint $table) {
            $table->string('country')->after('instagram')->nullable();
            $table->string('city')->after('country')->nullable();
            $table->date('date_of_birth')->after('city')->nullable();
            $table->text('about_me')->after('date_of_birth')->nullable();
            $table->string('educate_community_profile')->after('about_me')->nullable();
            $table->string('instagram_profile')->after('educate_community_profile')->nullable();
            $table->string('twitter_profile')->after('instagram_profile')->nullable();
            $table->string('time_zone')->after('twitter_profile')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'country',
                'city',
                'date_of_birth',
                'about_me',
                'educate_community_profile',
                'instagram_profile',
                'twitter_profile',
                'time_zone'
            ]);
        });
    }
};
