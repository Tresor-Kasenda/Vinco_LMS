<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\Professor;
use App\Models\Promotion;
use App\Models\Subsidiary;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Promotion::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Subsidiary::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Professor::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
    }
};
