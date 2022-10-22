<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\StatusEnum;
use App\Events\AdministrationEvent;
use App\Models\Institution;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

final class CreateUserCommand extends Command
{
    protected $signature = 'vinco:add-user {name?}';

    protected $description = 'Creates admins and stored them in the database 🖱';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->alert('Add User Command Interactive Wizard');

        process :
            $name = ucwords((string) $this->anticipate('name', ['admin', 'Place manager']));
        $email = strtolower((string) $this->ask('email'));
        $password = $this->secret('password');

        $validator = validator(
            compact('name', 'email', 'password'),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
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
                    Artisan::call('db:seed');

                    $role = $this->assignRoleToUser();

                    $this->giveRoles($role, $user, $name);
                    AdministrationEvent::dispatch($user);
                    $this->alert('Admin create with successfully');
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

    private function createInstitution(): Model|Institution|Builder
    {
        return Institution::query()
            ->create([
                'institution_name' => 'Vinco',
                'institution_country' => 'Congo DR',
                'institution_town' => 'Lubumbashi',
                'institution_address' => '269, Kasongo NYEMBO, Q/ Baudouin, Lubumbashi',
                'institution_phones' => '+243818045132',
                'institution_website' => 'https://www.vinco.digital',
                'institution_email' => 'information@vinco.com',
                'institution_images' => 'favicon.svg',
                'institution_description' => "Vinco LMS une plateforme d'etude en ligne",
            ]);
    }

    private function assignRoleToUser()
    {
        return Role::where('name', 'Super Admin')->first();
    }

    private function giveRoles(
        $role,
        $user,
        string $name
    ): void {
        $permission = Permission::query()
            ->pluck('id', 'id')
            ->all();
        $user->assignRole([$role->id]);
        $role->syncPermissions($permission);

        Setting::query()
            ->create([
                'user_id' => $user->id,
                'app_name' => $name,
            ]);
    }
}
