<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('institution_name', 40);
            $table->string('institution_country')->nullable();
            $table->string('institution_town')->nullable();
            $table->string('institution_address')->nullable();
            $table->string('institution_phones', 15)->nullable();
            $table->string('institution_website')->nullable();
            $table->string('institution_images')->nullable();
            $table->time('institution_start_time')->nullable();
            $table->time('institution_end_time')->nullable();
            $table->integer('institution_routine_time')->nullable(); //Différence horaire de routine
            $table->text('institution_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institutions');
    }
};
