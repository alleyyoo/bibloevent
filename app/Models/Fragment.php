<?php

namespace App\Models;

use App\Models\Translations\FragmentTranslation;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Fragment extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = ['id'];

    public $translationModel = FragmentTranslation::class;
    public $translatedAttributes = ['value'];

    public static function getGroup(string $group, string $locale): array
    {
        return static::query()->where('key', 'LIKE', "{$group}.%")->get()
            ->map(function (Fragment $fragment) use ($locale, $group) {

                $key = preg_replace("/{$group}\\./", '', $fragment->key, 1);
                $value = $fragment->translate($locale)->value;

                return compact('key', 'value');

            })
            ->pluck('value', 'key')
            ->toArray();
    }
}
