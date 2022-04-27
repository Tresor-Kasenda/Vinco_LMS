<?php
declare(strict_types=1);

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        $users = ['Student', 'Professor', 'Chef Student', 'Department', 'Campus', 'Admin'];
        foreach ($users as $user){
            Role::query()
                ->create([
                    'name' => $user
                ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
