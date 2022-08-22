<?php

namespace App\Http\Middleware;

use App\Models\Group;
use Closure;
use Illuminate\Http\Request;

final class GroupMember
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $group_members_id = [];
        $group = Group::find($request->id);

        $group_members = $group->participants()->get();

        foreach ($group_members as $group_member) {
            $group_members_id[] = $group_member->id;
        }

        if (in_array(auth()->user()->id, $group_members_id)) {
            return $next($request);
        } else {
            return redirect('/home')->with('error', 'Unauthorized');
        }
    }
}
