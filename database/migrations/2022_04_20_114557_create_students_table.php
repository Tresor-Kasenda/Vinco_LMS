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

return new class extends Migration {
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Department::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Subsidiary::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Promotion::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name', '30');
            $table->string('firstname', '30');
            $table->string('lastname', '30')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('matriculate')->unique()->nullable();
            $table->string('images')->nullable();
            $table->string('nationality')->nullable();
            $table->string('location')->nullable();
            $table->string('identity_card')->unique()->nullable();
            $table->date('birthdays')->nullable();
            $table->string('born_city')->nullable();
            $table->string('born_town')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('address')->nullable();
            $table->boolean('status')->default(StatusEnum::FALSE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
