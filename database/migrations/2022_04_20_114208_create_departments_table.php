<?php

declare(strict_types=1);

use App\Enums\StatusEnum;
use App\Models\Campus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Campus::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name')->unique();
            $table->string('images');
            $table->boolean('status')->default(StatusEnum::FALSE);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
