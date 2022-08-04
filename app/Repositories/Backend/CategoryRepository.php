<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use App\Services\ToastMessageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use LaravelIdea\Helper\App\Models\_IH_Category_QB;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(protected ToastMessageService $service)
    {
    }

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

    public function showCategory(string $key): Model|Builder|_IH_Category_QB|Category|null
    {
        return Category::query()
            ->select([
                'id',
                'name',
                'description',
                'institution_id',
            ])
            ->where('id', '=', $key)
            ->firstOrFail();
    }

    public function stored($attributes): Model|Builder|Category|RedirectResponse
    {
        $faculty = Category::query()
            ->create([
                'name' => $attributes->input('name'),
                'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
                'description' => $attributes->input('description'),
            ]);
        $this->service->success('A new Category as added with successfully');

        return $faculty;
    }

    public function updated(string $key, $attributes): Model|Builder|_IH_Category_QB|Category|null
    {
        $category = $this->showCategory(key: $key);
        $category->update([
            'name' => $attributes->input('name'),
            'institution_id' => $attributes->input('institution') ?? auth()->user()->institution->id,
            'description' => $attributes->input('description'),
        ]);
        $this->service->success('The Category as updated with successfully');

        return $category;
    }

    public function deleted(string $key): RedirectResponse
    {
        $category = $this->showCategory(key: $key);
        $category->delete();
        $this->service->success('The Category as trashed with successfully');

        return back();
    }
}
