<?php

namespace App\Models\Translations;

use App\Models\Page;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class PageTranslation extends Model
{
    use Sluggable;

    public $timestamps = false;
    protected $fillable = [ 'is_visible', 'is_menu', 'slug', 'title', 'body' ];

    public function sluggable()
    {
        if (in_array($this->page->front->view, Config::get('sluggable_views'))) {
            return [
                'slug' => [
                    'source' => [ 'title' ],
                    'method' => function($string, $separator) {
                        $category = $this->page->category;
                        if ($category && $category->id > 1) {
                            return Str::slug($category->title, $separator) . '/' . Str::slug($string, $separator);
                        }
                        return Str::slug($string, $separator);
                    }
                ]
            ];
        }
        return [];
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
