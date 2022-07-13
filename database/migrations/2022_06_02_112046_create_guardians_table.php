<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name_guardian', '30');
            $table->string('firstName_guardian', '30')->nullable();
            $table->string('email_guardian')->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('images')->nullable();
            $table->string('phones')->unique();
            $table->string('occupation')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guardians');
    }
};
