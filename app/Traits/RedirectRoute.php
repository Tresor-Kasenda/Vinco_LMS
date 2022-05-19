<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

trait RedirectRoute
{
    protected string $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo(): string
    {
        switch(Auth::user()->role_id){
            case RoleEnum::ADMIN:
                $this->redirectTo = route('admins.backend.home');
                return $this->redirectTo;
                break;
            case RoleEnum::CAMPUS:
                $this->redirectTo = route('');
                return $this->redirectTo;
                break;
            case RoleEnum::DEPARTMENT:
                $this->redirectTo = route('');
                return $this->redirectTo;
                break;
            case RoleEnum::PROFESSOR:
                $this->redirectTo = route('');
                return $this->redirectTo;
                break;
            case RoleEnum::STUDENT:
                $this->redirectTo = route('');
                return $this->redirectTo;
                break;
            case RoleEnum::CHEF_COURSES:
                $this->redirectTo = route('');
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = route('login');
                return $this->redirectTo;
        }
    }
}
