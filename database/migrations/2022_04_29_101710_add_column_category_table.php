<?php

declare(strict_types=1);

use App\Models\AcademicYear;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignIdFor(AcademicYear::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeignIdFor(AcademicYear::class);
        });
    }
};
