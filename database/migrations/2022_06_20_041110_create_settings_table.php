<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('app_name')->default('Vinco LMS')->unique();
            $table->string('short_name')->nullable();
            $table->string('app_email')->unique()->nullable();
            $table->string('app_phone')->unique()->nullable();
            $table->string('app_address')->nullable();
            $table->string('app_icons')->nullable();
            $table->string('app_images')->nullable();
            $table->string('class_start')->nullable();
            $table->string('class_end')->nullable();
            $table->string('app_time_zone')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
