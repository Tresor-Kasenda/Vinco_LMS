<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\StatusEnum;
use App\Models\Institution;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Helper\ProgressBar;

class CreateUserCommand extends Command
{
    protected $signature = 'vinco:add-user {name?}';

    protected $description = 'Creates admins and stored them in the database 🖱';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->comment('Add User Command Interactive Wizard');

        process :
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

        if ($this->confirm('Voulez vous creer un administrateur ? [Y|N]')) {
            if (! $validator->fails()) {
                try {
                    $password = Hash::make($password);
                    $status = StatusEnum::TRUE;
                    $institution = $this->createInstitution();
                    $institution_id = $institution->id;
                    $user = User::query()
                        ->create(compact('name', 'email', 'password', 'status', 'institution_id'));
                    $user->save();
                    list($role, $results, $permission) = $this->assignRoleToUser();

                    $progressBar = $this->output->createProgressBar($results->count());
                    $progressBar->start();

                    $this->giveRoles($role, $permission, $user, $progressBar, $name);

                    $progressBar->finish();
                    $this->line('Admin create with successfully');
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

    public function createInstitution(): Model|Institution|Builder
    {
        return Institution::query()
            ->create([
                'institution_name' => 'Vinco',
                'institution_address' => '269, Kasongo NYEMBO, Q/ Baudouin, Lubumbashi',
                'institution_country' => 'Congo DR',
                'institution_phones' => '+243818045132',
                'institution_town' => 'Lubumbashi',
                'institution_images' => asset('assets/favicon.svg'),
                'institution_website' => 'https://www.vinco.digital',
            ]);
    }

    public function assignRoleToUser(): array
    {
        $role = Role::create(['name' => 'Super Admin']);

        Artisan::call('db:seed');

        $results = Permission::all();

        $permission = Permission::query()
            ->pluck('id', 'id')
            ->all();
        return array($role, $results, $permission);
    }

    public function giveRoles(
        mixed $role,
        mixed $permission,
        $user,
        ProgressBar $progressBar,
        string $name
    ): void {
        $role->syncPermissions($permission);

        $user->attachRole($role);
        $user->syncPermissions($permission);
        sleep(3);
        $progressBar->advance();

        Setting::query()
            ->create([
                'user_id' => $user->id,
                'app_name' => $name,
            ]);
    }
}
