<?php

declare(strict_types=1);

use App\Models\ExamSession;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->foreignIdFor(ExamSession::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeignIdFor(ExamSession::class);
        });
    }
};
