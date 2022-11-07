<?php

declare(strict_types=1);

use App\Enums\StatusEnum;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Chapter::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->float('rating')->nullable(); // cote d'examen
            $table->date('date')->nullable();
            $table->time('duration')->nullable();
            $table->boolean('status')->default(StatusEnum::FALSE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
