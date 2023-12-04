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
        if (Schema::hasColumn('products', 'image_id')) {
            Schema::table('products', function ($table) {
                $table->dropForeign(['image_id']);
                $table->dropColumn('image_id');
            });
        }

        Schema::table('products', function ($table) {
            $table->unsignedBigInteger('image_id')->nullable()->after('category_id');
            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
