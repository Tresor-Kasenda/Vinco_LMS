<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function edit(int $id): Factory|View|Application
    {
        $role = Role::query()
            ->where('id', '=', $id)
            ->firstOrFail();

        return view('backend.domain.roles.edit', compact('role'));
    }

    public function update(int $id, RoleRequest $request): RedirectResponse
    {
        $role = Role::query()
            ->where('id', '=', $id)
            ->firstOrFail();

        $role->update([
            'title' => $request->input('role')
        ]);

        return redirect()->route('admins.roles.index')->with('success', "Le role a ete modifier avec succes");
    }

    public function destroy(int $id): RedirectResponse
    {
        $role = Role::query()
            ->where('id', '=', $id)
            ->firstOrFail();

        $role->delete();
        return back()->with('success', "The role has remove with successfull");
    }
}
