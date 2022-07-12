<?php

declare(strict_types=1);

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Institution;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', '30');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default(StatusEnum::FALSE);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
