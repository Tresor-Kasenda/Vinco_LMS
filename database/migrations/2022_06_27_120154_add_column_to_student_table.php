<?php

declare(strict_types=1);

use App\Models\Guardian;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->foreignIdFor(Guardian::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->date('admission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('student', function (Blueprint $table) {
            $table->dropForeignIdFor(Guardian::class);
        });
    }
};
