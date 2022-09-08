<?php

declare(strict_types=1);

use App\Models\Guardian;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->foreignIdFor(Guardian::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->date('admission_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('student', function (Blueprint $table) {
            $table->dropForeignIdFor(Guardian::class);
        });
    }
};
