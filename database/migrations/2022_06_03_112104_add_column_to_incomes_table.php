<?php

declare(strict_types=1);

use App\Models\IncomeType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->foreignIdFor(IncomeType::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropForeignIdFor(IncomeType::class);
        });
    }
};
