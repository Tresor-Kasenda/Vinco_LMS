<?php

declare(strict_types=1);

use App\Models\AcademicYear;
use App\Models\Department;
use App\Models\Professor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('professors_department', function (Blueprint $table) {
            $table->foreignIdFor(Professor::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Department::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
    }
};
