<?php

declare(strict_types=1);

use App\Models\Lesson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lesson_files', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Lesson::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('files');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_files');
    }
};
