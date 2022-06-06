<?php

declare(strict_types=1);

use App\Enums\FeeType;
use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->foreignIdFor(Student::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Guardian::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('amount');
            $table->date('due_date');
            $table->string('status');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incomes');
    }
};
