<?php

declare(strict_types=1);

use App\Models\FeeType;
use App\Models\Guardian;
use App\Models\Student;
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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FeeType::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Guardian::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Student::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('transaction_no')->unique();
            $table->string('amount');
            $table->date('due_date');
            $table->date('pay_date')->nullable();
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
