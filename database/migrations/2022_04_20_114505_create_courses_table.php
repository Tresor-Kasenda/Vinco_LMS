<?php

declare(strict_types=1);

use App\Enums\StatusEnum;
use App\Models\Category;
use App\Models\Professor;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Professor::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('sub_description')->nullable();
            $table->text('description')->nullable();
            $table->string('images')->nullable();
            $table->integer('weighting')->nullable(); // ponderation
            $table->boolean('status')->default(StatusEnum::FALSE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
