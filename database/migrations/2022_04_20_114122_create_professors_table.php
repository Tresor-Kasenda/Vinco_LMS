<?php
declare(strict_types=1);

use App\Enums\GenderEnum;
use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('username');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('personnelEmail')->unique();
            $table->string('phoneNumber')->unique();
            $table->string('matriculate')->unique();
            $table->string('country');
            $table->string('images');
            $table->string('location');
            $table->string('identityCard')->unique();
            $table->enum('gender', [GenderEnum::$genders]);
            $table->date('birthdays');
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
