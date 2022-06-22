<?php

declare(strict_types=1);

namespace App\Repositories\System;

use App\Contracts\SettingRepositoryInterface;
use App\Models\Setting;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class SettingRepository implements SettingRepositoryInterface
{
    use ImageUploader;

    /**
     * @param $request
     * @param $factory
     * @return Model|Builder
     */
    public function store($request, $factory): Model|Builder
    {
        $setting = Setting::query()
            ->create([
                'app_name' => $request->input('app_name'),
                'short_name' => $request->input('short_name'),
                'app_email' =>  $request->input('app_email'),
                'app_phone' =>  $request->input('app_phone'),
                'app_address' =>  $request->input('app_address'),
                'app_icons' =>  self::uploadIcons(request: $request),
                'app_images' =>  self::uploadLogo(request: $request),
                'user_id' => auth()->id(),
            ]);
        $factory->addSuccess('Configuration enregistrer avec succes');

        return $setting;
    }

    /**
     * @param int $id
     * @param $request
     * @param $factory
     * @return Builder|Builder[]|Collection|Model|mixed|object|null
     */
    public function update(int $id, $request, $factory): mixed
    {
        $setting = Setting::query()
            ->find($id)
            ->first();
        if ($setting->app_icons !== null) {
            $this->removeIcons($setting);
        }

        if ($setting->app_images !== null) {
            $this->removeLogos($setting);
        }

        $setting->update([
            'app_name' => $request->input('app_name'),
            'short_name' => $request->input('short_name'),
            'app_email' =>  $request->input('app_email'),
            'app_phone' =>  $request->input('app_phone'),
            'app_address' =>  $request->input('app_address'),
            'app_icons' =>  self::uploadIcons(request: $request),
            'app_images' =>  self::uploadLogo(request: $request),
        ]);

        $factory->addSuccess('Configuration modifier avec succes');

        return $setting;
    }

    public function updateSystem(int $id, $request, $factory)
    {
        $setting = Setting::query()
            ->find($id)
            ->first();

        $setting->update([
            'class_start' => $request->input('class_start'),
            'class_end' => $request->input('class_end'),
            'app_time_zone' => $request->input('timezone'),
            'routine_time_difference' => $request->input('routine_time_difference'),
        ]);

        $factory->addSuccess('Configuration modifier avec succes');

        return $setting;
    }

    public function removeCache($factory)
    {
        Artisan::call('cache:clear');
        $factory->addSuccess('Configuration modifier avec succes');
    }
}
