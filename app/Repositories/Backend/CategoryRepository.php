<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\CategoryRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Category;
use App\Models\Institution;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(): array|Collection
    {
        return Category::query()
            ->select([
                'id',
                'name',
                'description',
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showCategory(string $key)
    {
        return Category::query()
            ->select([
                'id',
                'name',
                'description',
                'institution_id',
            ])
            ->where('id', '=', $key)
            ->first();
    }

    public function stored($attributes, $flash): Model|Builder|Category|RedirectResponse
    {
        $faculty = Category::query()
            ->create([
                'name' => $attributes->input('name'),
                'institution_id'=> $this->institution()->institution_id,
                'description' => $attributes->input('description'),
            ]);
        $flash->addSuccess('A new Category as added with successfully');

        return $faculty;
    }

    public function updated(string $key, $attributes, $flash)
    {
        $category = $this->showCategory(key: $key);
        $category->update([
            'name' => $attributes->input('name'),
            'institution_id'=> $this->institution()->institution_id,
            'description' => $attributes->input('description'),
        ]);
        $flash->addSuccess('The Category as updated with successfully');

        return $category;
    }

    public function deleted(string $key, $flash): RedirectResponse
    {
        $category = $this->showCategory(key: $key);
        $category->delete();
        $flash->addSuccess('The Category as trashed with successfully');

        return back();
    }

    protected function institution(): Model|Professor|Builder|\Illuminate\Database\Query\Builder|null
    {
        return Professor::query()
            ->select([
                'id',
                'institution_id',
            ])
            ->where('user_id', '=', auth()->user()->id)
            ->first();
    }
}
