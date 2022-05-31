<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Enums\StatusEnum;
use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(): array|Collection
    {
        return Category::query()
            ->orderByDesc('created_at')
            ->with('academic')
            ->get();
    }

    public function showCategory(string $key)
    {
        $category = Category::query()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();

        return $category->load('academic');
    }

    public function stored($attributes, $flash): Model|Builder|Category|RedirectResponse
    {
        $category = Category::query()
            ->where('name', '=', $attributes->input('name'))
            ->first();
        if (! $category) {
            $faculty = Category::query()
                ->create([
                    'name' => $attributes->input('name'),
                    'status' => StatusEnum::FALSE,
                    'description' => $attributes->input('description'),
                    'academic_year_id' => $attributes->input('academic'),
                ]);
            $flash->addSuccess('Une nouvelle categorie a ete ajouter');

            return $faculty;
        }
        $flash->addError('Le nom de categorie existe deja');

        return back();
    }

    public function updated(string $key, $attributes, $flash)
    {
        $category = $this->showCategory(key: $key);
        $category->update([
            'name' => $attributes->input('name'),
            'description' => $attributes->input('description'),
            'academic_year_id' => $attributes->input('academic'),
        ]);
        $flash->addSuccess('La categorie a ete modifier avec succes');

        return $category;
    }

    public function deleted(string $key, $flash): RedirectResponse
    {
        $category = $this->showCategory(key: $key);
        if ($category->status !== StatusEnum::FALSE) {
            $flash->addError('Veillez desactiver la categorie avant de le mettre dans la corbeille');

            return back();
        }
        $category->delete();
        $flash->addSuccess('la categorie a ete mis dans la corbeille');

        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $personnel = $this->showCategory(key: $attributes->input('key'));
        if ($personnel != null) {
            return $personnel->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
