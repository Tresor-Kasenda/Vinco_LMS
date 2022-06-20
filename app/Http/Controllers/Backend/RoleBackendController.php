<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Cache;

class RoleBackendController extends Controller
{
    public function index(): Renderable
    {
        $roles = Cache::remember('roles', 3600, function () {
            return Role::query()
               ->orderByDesc('created_at')
               ->get();
        });
        return view('backend.domain.roles.index', compact('roles'));
    }
}
