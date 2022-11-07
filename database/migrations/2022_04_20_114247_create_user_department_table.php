<?php

declare(strict_types=1);

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_department', function (Blueprint $table) {
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Department::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_department');
    }
};
