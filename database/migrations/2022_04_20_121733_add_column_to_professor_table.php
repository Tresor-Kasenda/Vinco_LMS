<?php
declare(strict_types=1);

use App\Models\Department;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('professors', function (Blueprint $table) {
            $table->foreignIdFor(Department::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('professor', function (Blueprint $table) {
            $table->dropForeignIdFor(Department::class);
        });
    }
};
