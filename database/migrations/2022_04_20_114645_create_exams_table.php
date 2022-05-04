<?php
declare(strict_types=1);

use App\Enums\StatusEnum;
use App\Models\Course;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->foreignIdFor(Course::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('condition');
            $table->integer('weighting');
            $table->date('date');
            $table->timestamp('schedule');
            $table->string('duration');
            $table->boolean('status')->default(StatusEnum::FALSE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exams');
    }
};
