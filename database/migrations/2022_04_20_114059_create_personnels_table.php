<?php
declare(strict_types=1);

use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('username');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('personnelEmail')->unique();
            $table->string('phoneNumber')->unique();
            $table->string('nationality');
            $table->string('images');
            $table->string('location');
            $table->string('identityCard')->unique();
            $table->boolean('status')->default(StatusEnum::FALSE);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personnels');
    }
};
