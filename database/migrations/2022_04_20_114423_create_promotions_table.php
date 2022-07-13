<?php

declare(strict_types=1);

use App\Models\Subsidiary;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subsidiary::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name', '30')->unique();
            $table->text('description')->nullable();
            $table->string('images');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promotions');
    }
};
