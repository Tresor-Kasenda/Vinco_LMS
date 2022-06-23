<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\StatusEnum;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateUserCommand extends Command
{
    protected $signature = 'vinco:add-user';

    protected $description = 'Creates admins and stored them in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->comment('Add User Command Interactive Wizard');

        process : {
            $name = ucwords($this->anticipate('name', ['admin', 'Place manager']));
            $email = strtolower($this->ask('email'));
            $password = $this->secret('password');
            $password_confirmation = $this->secret('confirm password');

            $validator = validator(
                compact('name', 'email', 'password', 'password_confirmation'),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]
            );
        }
        if ($this->confirm('Voulez vous creer un administrateur')) {
            if (! $validator->fails()) {
                try {
                    $password = Hash::make($password);
                    $status = StatusEnum::TRUE;
                    $user = User::query()
                        ->create(compact('name', 'email', 'password', 'status'));
                    $user->save();
                    $role = Role::create(['name' => "Super Admin"]);

                    Artisan::call('db:seed');

                    $permission = Permission::query()
                        ->pluck('id', 'id')
                        ->all();

                    $role->syncPermissions($permission);

                    $user->assignRole([$role->id]);

                    Setting::query()
                        ->create([
                            'user_id' => $user->id,
                            'app_name' => $name,
                        ]);
                    $this->info(sprintf('User %s with email <%s> as created', $name, $email));
                    exit();
                } catch (\Exception $exception) {
                    $this->error('Something went wrong run the command with -v for more details');
                    dd($exception);
                }
            } else {
                $this->error('some values are wrong !');
                $this->table(['Errors'], $validator->errors()->messages());
                goto process;
            }
        }
    }
}
