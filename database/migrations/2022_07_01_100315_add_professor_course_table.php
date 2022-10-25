<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\Professor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('professor_course', function (Blueprint $table) {
            $table->foreignIdFor(Professor::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Course::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        //
    }
};
