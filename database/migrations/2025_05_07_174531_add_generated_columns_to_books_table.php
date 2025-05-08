<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->text('name_en')->storedAs("JSON_UNQUOTE(JSON_EXTRACT(`name`, '$.en'))")->persistent();
            $table->text('name_ar')->storedAs("JSON_UNQUOTE(JSON_EXTRACT(`name`, '$.ar'))")->persistent();
            $table->text('description_en')->storedAs("JSON_UNQUOTE(JSON_EXTRACT(`description`, '$.en'))")->persistent();
            $table->text('description_ar')->storedAs("JSON_UNQUOTE(JSON_EXTRACT(`description`, '$.ar'))")->persistent();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->fullText(['name_en', 'description_en'])->language('english');
            $table->fullText(['name_ar', 'description_ar'])->language('arabic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropFullText(['name_en', 'description_en']);
            $table->dropFullText(['name_ar', 'description_ar']);

            $table->dropColumn(['name_en', 'name_ar', 'description_en', 'description_ar']);
        });
    }
};
