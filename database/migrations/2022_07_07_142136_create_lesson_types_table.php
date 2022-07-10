<?php

declare(strict_types=1);

use App\Models\LessonType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lesson_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $types = ['video', 'aperi', 'text', 'pdf'];

        foreach ($types as $type) {
            LessonType::query()
                ->create([
                    'name' => $type
                ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('lesson_types');
    }
};
