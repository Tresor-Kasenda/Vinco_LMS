<?php

declare(strict_types=1);

namespace App\Repositories\Backend\Filiaire;

use App\Http\Requests\Backend\Filiaire\FiliaireStatusRequest;
use App\Models\Subsidiary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Subsidiary_QB;

class FiliaireStatusRepository
{
    public function handle(FiliaireStatusRequest $request): Model|Builder|Subsidiary|_IH_Subsidiary_QB|null
    {
        $filiaire = Subsidiary::query()
            ->where('id', '=', $request->input('filiaire'))
            ->first();
        $filiaire->update(['status' => $request->input('status')]);

        return $filiaire;
    }
}
