<?php
declare(strict_types=1);

use App\Enums\StatusEnum;
use App\Models\Department;
use App\Models\Promotion;
use App\Models\Subsidiary;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Promotion::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Department::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Subsidiary::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phoneNumber')->unique();
            $table->string('images');
            $table->string('nationality');
            $table->string('location');
            $table->string('identityCard')->unique();
            $table->date('birthdays');
            $table->string('bornCity');
            $table->string('bornTown');
            $table->string('responsibleName');
            $table->string('responsiblePhone');
            $table->boolean('status')->default(StatusEnum::FALSE);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
