<?php

declare(strict_types=1);

namespace App\Repositories\Backend\Campus;

use App\Http\Requests\Backend\Campus\StatusCampusRequest;
use App\Models\Campus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Campus_QB;

class CampusStatusRepository
{
    public function handle(StatusCampusRequest $request): Campus|Model|Builder|_IH_Campus_QB|null
    {
        $admin = Campus::query()
            ->where('id', '=', $request->input('campus'))
            ->first();
        $admin->update(['status' => $request->input('status')]);

        return $admin;
    }
}
