<?php

declare(strict_types=1);

use App\Models\LessonType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->foreignIdFor(LessonType::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeignIdFor(LessonType::class);
        });
    }
};
