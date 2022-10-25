<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use LaravelIdea\Helper\App\Models\_IH_Category_QB;

final class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(): array|Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Category::query()
                ->select([
                    'id',
                    'name',
                    'description',
                    'institution_id',
                ])
                ->with('institution')
                ->orderByDesc('created_at')
                ->get();
        }

        return Category::query()
            ->select([
                'id',
                'name',
                'description',
                'institution_id',
            ])
            ->where('institution_id', '=', auth()->user()->institution->id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|Category|RedirectResponse
    {
        return Category::query()
            ->create([
                'name' => $attributes->input('name'),
                'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
                'description' => $attributes->input('description'),
            ]);
    }

    public function updated(string $key, $attributes): Model|Builder|_IH_Category_QB|Category|null
    {
        $category = $this->showCategory(key: $key);
        $category->update([
            'name' => $attributes->input('name'),
            'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
            'description' => $attributes->input('description'),
        ]);

        return $category;
    }

    public function showCategory(string $key): Model|Builder|_IH_Category_QB|Category|null
    {
        return Category::query()
            ->where('id', '=', $key)
            ->firstOrFail();
    }

    public function deleted(string $key): RedirectResponse
    {
        $category = $this->showCategory(key: $key);
        $category->delete();

        return $category;
    }
}
