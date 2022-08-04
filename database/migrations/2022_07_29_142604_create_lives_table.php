<?php

declare(strict_types=1);

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lives', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Lesson::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('room_id')->unique();
            $table->string('room_name');
            $table->string('reference');
            $table->dateTime('schedule');
            $table->integer('participants')->default(0);
            $table->string('duration');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lives');
    }
};
