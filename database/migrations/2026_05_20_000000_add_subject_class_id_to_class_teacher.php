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
        Schema::table('class_teacher', function (Blueprint $table) {
            if (!Schema::hasColumn('class_teacher', 'subject_class_id')) {
                $table->unsignedBigInteger('subject_class_id')->nullable()->after('class_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_teacher', function (Blueprint $table) {
            if (Schema::hasColumn('class_teacher', 'subject_class_id')) {
                $table->dropColumn('subject_class_id');
            }
        });
    }
};
