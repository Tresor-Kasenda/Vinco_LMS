<?php

declare(strict_types=1);

use App\Enums\GenderEnum;
use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('username', '30');
            $table->string('firstname', '30')->nullable();
            $table->string('lastname', '30')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phones')->unique()->nullable();
            $table->string('matriculate')->unique();
            $table->string('country')->nullable();
            $table->string('images')->nullable();
            $table->string('location')->nullable();
            $table->string('identityCard')->unique()->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->date('birthdays')->nullable();
            $table->boolean('status')->default(StatusEnum::FALSE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('professors');
    }
};
