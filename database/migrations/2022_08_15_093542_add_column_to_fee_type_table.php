<?php

declare(strict_types=1);

use App\Models\Institution;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('fee_types', function (Blueprint $table) {
            $table->foreignIdFor(Institution::class)
                ->constrained()
                ->cascadeOnDelete();
        });
        Schema::table('exam_sessions', function (Blueprint $table) {
            $table->foreignIdFor(Institution::class)
                ->constrained()
                ->cascadeOnDelete();
        });
        Schema::table('exams', function (Blueprint $table) {
            $table->foreignIdFor(Institution::class)
                ->constrained()
                ->cascadeOnDelete();
        });
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignIdFor(Institution::class)
                ->constrained()
                ->cascadeOnDelete();
        });
        Schema::table('results', function (Blueprint $table) {
            $table->foreignIdFor(Institution::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('fee_types', function (Blueprint $table) {
            $table->dropForeignIdFor(Institution::class);
        });
        Schema::table('exam_sessions', function (Blueprint $table) {
            $table->dropForeignIdFor(Institution::class);
        });
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeignIdFor(Institution::class);
        });
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeignIdFor(Institution::class);
        });
        Schema::table('results', function (Blueprint $table) {
            $table->dropForeignIdFor(Institution::class);
        });
    }
};
