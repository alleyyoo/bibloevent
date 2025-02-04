<?php

namespace App\Models;

use App\Models\Translations\PageTranslation;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Wildside\Userstamps\Userstamps;

class Page extends Model implements TranslatableContract
{
    use Userstamps, Translatable;

    protected $guarded = [ 'id' ];

    protected $dates = [ 'date' ];

    public $this;

    public $translatedAttributes = [ 'is_visible', 'is_menu', 'slug', 'title', 'body' ];
    public $translationModel = PageTranslation::class;

    protected static $data = [];

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            $locale = App::getLocale();
            $content = Config::get('content');
            if (in_array($model->front->view, array_keys($content))) {
                foreach ($content[$model->front->view] as $name) {
                    $value = Content::wherePageId($model->id)->whereLocale($locale)->whereName($name)->value('value') ?? null;
                    $model->attributes[$name] = json_decode($value) ?? $value;
                }
            }
        });

        static::saving(function ($model) {
            $content = Config::get('content');
            if (in_array($model->front->view, array_keys($content))) {
                foreach ($content[$model->front->view] as $name) {
                    self::$data[$name] = $model->$name;
                    unset($model->$name);
                }
            }
        });

        static::saved(function ($model) {
            if (App::getLocale() == 'tr'){
                $languages = Language::all();
                foreach ($languages as $language){
                    foreach (self::$data as $name => $value) {
                        $data = [ 'page_id' => $model->id, 'locale' => $language->code, 'name' => $name ];
                        if (Content::updateOrCreate($data, $data + [ 'value' => is_array($value) || is_object($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value ])) {
                            $model->attributes[$name] = $value;
                        }
                    }
                }
            } else {
                foreach (self::$data as $name => $value) {
                    $data = [ 'page_id' => $model->id, 'locale' => App::getLocale(), 'name' => $name ];
                    if (Content::updateOrCreate($data, $data + [ 'value' => is_array($value) || is_object($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value ])) {
                        $model->attributes[$name] = $value;
                    }
                }
            }
        });

    }

    public static function createPage($data)
    {
        $model = Page::create($data);
        if (App::getLocale() == 'tr'){
            $languages = Language::all();
            foreach ($languages as $language){
                foreach ($data as $name => $value) {
                    $data = [ 'page_id' => $model->id, 'locale' => $language->code, 'name' => $name ];
                    if (Content::updateOrCreate($data, $data + [ 'value' => is_array($value) || is_object($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value ])) {
                        $model->attributes[$name] = $value;
                    }
                }
            }
        } else {
            foreach ($data as $name => $value) {
                $data = [ 'page_id' => $model->id, 'locale' => App::getLocale(), 'name' => $name ];
                if (Content::updateOrCreate($data, $data + [ 'value' => is_array($value) || is_object($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value ])) {
                    $model->attributes[$name] = $value;
                }
            }
        }

        return $model;
    }

    public function updatePage($data)
    {
        $model= $this;

        $locale = App::getLocale();
        $content = Config::get('content');
        if (in_array($model->front->view, array_keys($content))) {
            foreach ($content[$model->front->view] as $name) {
                $value = Content::wherePageId($model->id)->whereLocale($locale)->whereName($name)->value('value') ?? null;
                $model->attributes[$name] = json_decode($value) ?? $value;
            }
        }

        $content = Config::get('content');
        if (in_array($model->front->view, array_keys($content))) {
            foreach ($content[$model->front->view] as $name) {
                self::$data[$name] = $model->$name;
                unset($model->$name);
            }
        }

        foreach ($data as $name => $value) {
            $data['page_id'] = $model->id;
            $data['locale'] = App::getLocale();
            $data['name'] = $name;
            $this->update($data);
        }

        foreach ($data as $name => $value){
            $data = [ 'page_id' => $model->id, 'locale' => App::getLocale(), 'name' => $name ];
            if (Content::updateOrCreate($data, $data + [ 'value' => is_array($value) || is_object($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value ])) {
                $model->attributes[$name] = $value;
            }
        }

        return $this;

    }

    public function category()
    {
        return $this->belongsTo(Page::class);
    }

    public function childs()
    {
        return $this->hasMany(Page::class, 'category_id')->isActive()->isVisible()->orderBy('sort_id', 'asc');
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeIsVisible($query)
    {
        return $query->whereTranslation('is_visible', true, App::getLocale());
    }

    public function scopeIsMenu($query)
    {
        return $query->whereTranslation('is_menu', true, App::getLocale());
    }

    public function getFrontAttribute()
    {
        return (object) [
            'view' => (strpos($this->front_view, ',') ? explode(',', $this->front_view)[0] : $this->front_view) ?? 'show',
            'layout' => (strpos($this->front_layout, ',') ? explode(',', $this->front_layout)[0] : $this->front_layout) ?? 'content',
        ];
    }

    public function getBackAttribute()
    {
        return (object) [
            'view' => (strpos($this->back_view, ',') ? explode(',', $this->back_view)[0] : $this->back_view) ?? 'page',
            'layout' => (strpos($this->back_layout, ',') ? explode(',', $this->back_layout)[0] : $this->back_layout) ?? 'content',
        ];
    }

    public function getViewAttribute()
    {
        $front_view = strpos($this->front_view, ',') ? explode(',', $this->front_view) : $this->front_view;
        $back_view = strpos($this->back_view, ',') ? explode(',', $this->back_view) : $this->back_view;

        return (object) [
            'front' => $front_view ?? 'show',
            'back' => $back_view ?? 'page',
        ];
    }

    public function getLayoutAttribute()
    {
        $front_layout = strpos($this->front_layout, ',') ? explode(',', $this->front_layout) : $this->front_layout;
        $back_layout = strpos($this->back_layout, ',') ? explode(',', $this->back_layout) : $this->back_layout;

        return (object) [
            'front' => $front_layout ?? 'content',
            'back' => $back_layout ?? 'content',
        ];
    }

    public function getParagraphAttribute()
    {
        preg_match_all("@<\s*p[^>]*>(.*?)<\s*/\s*p>@", $this->body, $matches);

        return count($matches[1]) ? mb_substr($matches[1][0], 0, 200, 'utf-8') : null;
    }

    public function paragraph($offset = 0, $count = 1, $limit = 0)
    {
        preg_match_all("@<\s*p[^>]*>(.*?)<\s*/\s*p>@", $this->body, $matches);

        if (count($matches[1])) {
            $html = '';
            for ($i=0; $i < $count; $i++) {
                $html .= '<p>' . ( $limit ? mb_substr($matches[1][$offset], 0, $limit, 'utf-8') : $matches[1][$offset+$i] ) . '</p>';
            }
            return $html;
        }

        return null;
    }

    public function activeLink($id)
    {
        return $id == $this->id || $id == ($this->category->id ?? 0) || $id == ($this->category->category->id ?? 0);
    }

    public function breadcrumbs($page = null, $array = [])
    {
        $is_pannel = request()->route()->getPrefix() == '/pannel';

        if (!is_null($page)) {
            $link = $is_pannel ? route('admin.pages', [ 'category_id' => $page->id ]) : $page->slug;
            $array = $this->breadcrumbs($page->category, [ $link => $is_pannel ? $page->title : $page ] + $array);
        }

        if (!$array && $this->id) {
            $link = $is_pannel ? route('admin.pages', [ 'category_id' => $this->id ]) : $this->slug;
            $array = $this->breadcrumbs($this, [ $link => $is_pannel ? $this->title : $this ]);
        }

        return $is_pannel ? [ route('admin.pages') => 'Sayfalar' ] + $array : $array;
    }

    public function languages()
    {
        $languages = Config::get('languages');
        $translations_array = $this->getTranslationsArray();
        $translations = [];
        foreach ($languages as $k => $v) {
            if (array_key_exists($k, $translations_array)) {
                $translations[$k] = $v;
            }
        }
        return $translations;
    }

    public function previewImage($path)
    {
        switch (substr(strrchr($path,'.'),1)) {
            case 'pdf':
                return 'data:image/png;base64,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';
                break;
            case 'doc':
            case 'docx':
                return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAgAElEQVR4Xu29C5hlVXnnvdY6+5xqQaCbrqomKFEHEO+XeCfRZGae+cYvOpGoGDFixi8KakCEqIBWV5+uam5qRIJRAXWMd9PEyyQyl8yYb6IB72CiNCoqJoB0napu7nSdy1qzDk0jt7ar9lp7r7X2+p3n8eHx6f3efu9b+/zP3nutLQUfCEAAAhCAAASyIyCzq5iCIQABCEAAAhAQCACGAAIQgAAEIJAhAQRAhk2nZAhAAAIQgAACgBmAAAQgAAEIZEgAAZBh0ykZAhCAAAQggABgBiAAAQhAAAIZEkAAZNh0SoYABCAAAQggAJgBCEAAAhCAQIYEEAAZNp2SIQABCEAAAggAZgACEIAABCCQIQEEQIZNp2QIQAACEIAAAoAZgAAEIAABCGRIAAGQYdMpGQIQgAAEIIAAYAYgAAEIQAACGRJAAGTYdEqGAAQgAAEIIACYAQhAAAIQgECGBBAAGTadkiEAAQhAAAIIAGYAAhCAAAQgkCEBBECGTadkCEAAAhCAAAKAGYAABCAAAQhkSAABkGHTKRkCEIAABCCAAGAGIAABCEAAAhkSQABk2HRKhgAEIAABCCAAmAEIQAACEIBAhgQQABk2nZIhAAEIQAACCABmAAIQgAAEIJAhAQRAhk2nZAhAAAIQgAACgBmAAAQgAAEIZEgAAZBh0ykZAhCAAAQggABgBiAAAQhAAAIZEkAAZNh0SoYABCAAAQggAJgBCEAAAhCAQIYEEAAZNp2SIQABCEAAAggAZgACEIAABCCQIQEEQIZNp2QIQAACEIAAAoAZgAAEIAABCGRIAAGQYdMpGQIQgAAEIIAAYAYgAAEIQAACGRJAAGTYdEqGAAQgAAEIIACYAQhAAAIQgECGBBAAGTadkiEAAQhAAAIIAGYAAhCAAAQgkCEBBECGTadkCEAAAhCAAAKAGYAABCAAAQhkSAABkGHTKRkCEIAABCCAAGAGIAABCEAAAhkSQABk2HRKhgAEIAABCDReABzYNQc/TI+er415slHmKGXkY0cjM61a5gCpxQFGqQ5jAIFQBHpzbae/wanZ/sm9uc6FofInLgQgkC4Bp5NPrGVPd5efoo36Qz0S/09L6acKoRpZZ6z8yWvlBNwFwPLQiNZLFueKL688KkdCAAIQEKIxX4yHds1+g9Hg/xtJ+bqWEPZLnw8E4ifgLgAGRmt9uyrk83vdzlXxV0yGEIBALASSFwAHd82BLT38Ey1GpyrRmooFLHlAYCUEfAiAe+LcoEfFc5bOkjesJC7HQAACEEhYABg5OTt6pdGj9yqlDqGVEEiRgEcBMC7/SqGKF/S68vYUWZAzBCBQL4EkBcC6TebXW2bwUSnkv68XF9Eg4JeAZwEghNF/27umc4zYKkd+M8UbBCDQNALJCYDJ7vDFajj6S/v0/sFNawb15EfAuwCwCLWQFy7NFW/OjyYVQwACqyGQkAAwcnrTsGuMmF1NgRwLgZgJVCEAdtdr3szywJg7T24QCE8gDQHQNcX0cPQBu47/9eGRkQEE/BGoTgDoEcsD/fUJTxBoIoH4BcCxpjX1+OFnLPxjm9gAasqbQHUCwN4KYHlg3sNF9RDYB4HIBYC97D8zuohf/sxxUwlUKQDuYcbywKYOD3VBwJFA1AJgetNgM/f8HTuMedQEahAA4/pZHhj1FJAcBMIQiFYAjJ/2l9r8TRgsRIVAPQRqEgAsD6ynnUSBQFIEohQA43X+7VH/Spb6JTVLJFuCQG0CwObG8sASDcIEAg0mEKEAGO/wN/g7Nvlp8NRR2r0E6hQAu4OyPJDxgwAEdhOITgBMzg6Pk8J8mgZBIAcC9QsAlgfmMFfUCIGVEIhKAIxf7COH/R+yt/9KWscxTSBQvwBgeWAT5oYaIOCDQFQCYGp2cKYt6mwfheEDAikQCCEA7uHC8sAUBoQcIVAhgWgEwKFds9+yXr6OV/pW2G1cR0cgoAAYs2B5YHQTQUIQqI9ANAJgamP/JCHlhfWVTiQIhCcQWACwPDD8CJABBIIRiEYAHDwzuLKlxNOCkSAwBAIQCC4AbM0sDwzQeEJCIAICUQiA6e7yU4xW34uABylAoFYCMQiA3QWzPLDWxhMMAhEQiEIA2If/zrUsTo+ABylAoFYC8QgAlgfW2niCQSACArEIgO9aFk+PgAcpQKBWAvEIAJYH1tp4gkEgAgLBBcAjzjTr++1+TwgVPJcI+kEKmRGISQDcg57lgZnNIOXmSyD4l+50d3iM0eYL+baAynMmEKEAGLeD5YE5DyW1Z0MguACw+/5vtEnMZUOcQiFwHwKRCgCWBzKlEMiAQHABMD3T/6RR8g8zYE2JEHgQgWgFgM2U5YEMLASaTSC4ALArAL5pET+r2ZipDgIPTSBmAbA7Y5YHMrsQaCqB4AJgcrZ/nX3176OaCpi6IPCrCMQvAFgeyARDoKkEgguAqdnlRbsCYH1TAVMXBNIWACwPZIIh0FQCwQXA9MzyslGq01TA1AWB1AXAPfmzPJBRhkDDCAQXAPYZANMwppQDgRUTiP8WwP1KYXngijvLgRCInwACIP4ekWGDCSQmAFge2OBZpLT8CCAA8us5FUdEIDkBYNmxPDCiASIVCDgQQAA4wMMUAq4EUhQAu2tmeaBr77GHQGgCCIDQHSB+1gTSFQAsD8x6cCm+EQQQAI1oI0WkSiBdAcDywFRnjrwhsIcAAoBZgEBAAikLgHuwsTww4PwQGgIuBBAALvSwhYAjgQYIgDEBlgc6zgHmEAhBAAEQgjoxIXAPgYYIAJYHMtEQSJAAAiDBppFycwg0RgDYlrA8sDlzSSV5EEAA5NFnqoyUQJMEwG7ELA+MdNRICwIPIoAAYCggEJBA8wQAywMDjhOhIbAqAgiAVeHiYAj4JdA8AcDyQL8TgjcIVEcAAVAdWzxDYJ8EmigA7ima5YH77D4HQCAsAQRAWP5Ez5xAgwXAuLMsD8x8vik/bgIIgLj7Q3YNJ9BwAcDywIbPL+WlTQABkHb/yD5xAo0XALY/LA9MfEhJv7EEEACNbS2FpUAgBwGwuw8sD0xhHskxLwIIgLz6TbWREchHALA8MLLRIx0ICAQAQwCBgATyEQAsDww4ZoSGwEMSQAAwGBAISCAnAXAPZpYHBpw3QkPgvgQQAMwDBAISyFAAjGmzPDDgzBEaAnsIIACYBQgEJJCpAGB5YMCZIzQEEADMAAQiIJCtALDsWR4YwQCSQtYEuAKQdfspPjSBnAXAbvYsDww9g8TPlwACIN/eU3kEBBAALA+MYAxJIVMCCIBMG0/ZcRBAALA8MI5JJIscCSAAcuw6NUdDAAFwbytYHhjNVJJILgQQALl0mjqjJIAAuF9bWB4Y5ZSSVFMJIACa2lnqSoIAAuABbTL6b3vXdI4RW+UoiQaSJAQSJoAASLh5pJ4+AQTAg3vI8sD055oK0iCAAEijT2TZUAIIgL01luWBDR15yoqIAAIgomaQSn4EEAB76znLA/P7a6DiugkgAOomTjwI3IcAAmDv46C1vl0V8vm9bucqhgYCEPBPAAHgnykeIbBiAgiAfaJieeA+EXEABMoRQACU44YVBLwQQACsCCPLA1eEiYMgsDoCCIDV8eJoCHglgABYIU6WB64QFIdBYOUEEAArZ8WREPBOAAGwcqQsD1w5K46EwEoIIABWQoljIFARAQTAasGyPHC1xDgeAnsjgABgNiAQkAACYLXwWR64WmIcDwEEADMAgQgJIABW3xSWB66eGRYQeCgCXAFgLiAQkAACoDR8lgeWRochBHYTQAAwCRAISAAB4ASf5YFO+DDOnQACIPcJoP6gBBAAjvhZHugIEPOcCSAAcu4+tQcngABwbwHLA90Z4iFPAgiAPPtO1ZEQQAD4agTLA32RxE8+BBAA+fSaSiMkgADw1RSWB/oiiZ98CCAA8uk1lUZIAAHgryksD/THEk95EEAA5NFnqoyUAALAe2NYHugdKQ6bSgAB0NTOUlcSBBAAlbSJ5YGVYMVp0wggAJrWUepJigACoKJ2sTywIrC4bRIBBECTukktyRFAAFTXMpYHVscWz80ggABoRh+pIlECCICqG8fywKoJ4z9dAgiAdHtH5g0ggACouoksD6yaMP7TJYAASLd3ZN4AAgiA6pvI8sDqGRMhTQIIgDT7RtYNIYAAqK2RLA+sDTWBUiGAAEilU+TZSAIIgFrbyvLAWnETLHYCCIDYO0R+jSaAAKi5vSwPrBk44WImgACIuTvk1ngCCID6W8zywPqZEzFOAgiAOPtCVpkQQACEajTLA0ORJ248BBAA8fSCTDIkgAAI1XSWB4YiT9x4CCAA4ukFmWRIAAEQruksDwzHnshxEEAAxNEHssiUAAIgeONZHhi8BSQQigACIBR54kLAEkAARDEGLA+Mog0kUTcBBEDdxIkHgfsQ6KliQnRlvyyUqdlla6vaZe2xu4cAywMZhQwJIAAybDolx0OgMygmbzhHLpXNaHJmV0+q1mRZe+x+SYDlgUxDbgQQALl1nHqjItBSw8fc1H3YdWWTmp4dfMMI8eyy9tg9kADLA5mJfAggAPLpNZVGSMAY88zF+c53yqY2vWl4kfVxQll77B5IgOWBzEQ+BBAA+fSaSiMkYIw8bnG++GzZ1KY2Dl8hpPlcWXvsHkyA5YFMRS4EEAC5dJo6oyRgL993F+fam8smt+GtZv/hfv3tSqj9y/rA7iEJsDyQwWg8AQRA41tMgZET2GqXAr7CJcfp2eGHjDAnuvjA9iEJsDyQwWg0AQRAo9tLcbETsJebb1ra0jlU2Ov4ZXPdMHPXY4xQ1xilOmV9YLcXAiwPZDQaTAAB0ODmUloaBKwIeMLSloltLtlOzQ7OtvZnuvjA9qEJsDyQyWgqAQRAUztLXQkRcF96dsTJZmLHQcOvt5R4WkKFJ5Sqe48SKpZUMyGAAMik0ZQZNYEr7HMAR7tmOL4VMFStK5SQG1x9Yf9AAiwPZCaaRwAB0LyeUlGKBPTosb0ta37smvp0d/kpIy3/JyLAleSD7Vke6J8pHsMSQACE5U90COwhcI69CvAOHzimZ3YdrkXr81KJp/jwh4/7EWB5IAPRGAIIgMa0kkKSJqD1zaOi86gdXXmrjzoeeap52K4Dh3NypN8ilCp8+MTHvQRYHsgwNIIAAqARbaSIRhAw4szefPtcn7VMdnc91pjiTDEavVIptcan76x9sTww6/Y3pXgEQFM6SR0NIKCX+v3OkbecK3f6Lmbd6eag1sToxUaLf6+UsbcG9KNtjAN5lXB50iwPLM8OyzgIIADi6ANZQOBuAkbIDy7OFW8CBwQgAIGqCSAAqiaMfwisioA2WsnnLnU731yVGQdDAAIQWCUBBMAqgXE4BConYMQ1olU8q9eVt1ceiwAQgEC2BBAA2baewmMmYKT55OLm9mtc3hEQc33kBgEIhCeAAAjfAzKAwF4ImJN6c52/AA8EIACBKgggAKqgik8IeCGg7Uv+Wq/odYtLvbjDCQQgAIH7EEAAMA4QiJiA1LpvN/J58cJc++8iTpPUIACBBAkgABJsGinnRWAsAoxqvbo3V2zNq3KqhQAEqiSAAKiSLr4h4I2AvR0g5Cn2fQHv58FAb1BxBIGsCSAAsm4/xadGQGrzmWHRfoOvdwakVj/5QgAC/gggAPyxxBMEaiGgR/LaljKvWZhvX1FLQIJAAAKNJIAAaGRbKSoLAlJ+tNVvnXHTObKXRb0UCQEIeCWAAPCKE2cQqJmAfY2wUep9fVVceGtX7qg5OuEgAIGECSAAEm4eqUNgDwGt9e0tpS6RSn90e3fi+5CBAAQgsC8CCIB9EeLfIZAYgZEWVxVSfMYI83e9Vvt7oit1YiWQLgQgUAMBBEANkAkBgXAE9E5p1FeNEt+XWv5QtvSPzFD3ZDFxW/sWcdv154tdLCsM1x0iQyAkAQRASPrEhgAEkiZg92UIfg5NGiDJByUQfHinZgd2gxM+EIAABNIjgABIr2dk/EsCCACmAQIQgEBJAgiAkuAwi4IAAiCKNpAEBCCQIgEEQIpdI+c9BBAAzAIEIACBkgQQACXBYRYFAQRAFG0gCQhAIEUCCIAUu0bOXAFgBiAAAQg4EkAAOALEPCgBrgAExU9wCEAgZQIIgJS7R+4IAGYAAhCAQEkCCICS4DCLggACIIo2kAQEIJAiAQRAil0jZ54BYAYgAAEIOBJAADgCxDwoAa4ABMVPcAhAIGUCCICUu0fuCABmAAIQgEBJAgiAkuAwi4IAAiCKNpAEBCCQIgEEQIpdI2eeAWAGIAABCDgSQAA4AsQ8KAGuAATFT3AIQCBlAgiAlLtH7ggAZgACEIBASQIIgJLgMIuCAAIgijaQBAQgkCIBBECKXSNnngFgBiAAAQg4EkAAOALEPCgBrgAExU9wCEAgZQIIgJS7R+4IAGYAAhCAQEkCCICS4DCLggACIIo2kAQEIJAiAQRAil0jZ54BYAYgAAEIOBJAADgCxDwoAa4ABMVPcAhAIGUCCICUu0fuCABmAAIQgEBJAgiAkuAwi4IAAiCKNpAEBCCQIgEEQIpdI2eeAWAGIAABCDgSQAA4AsQ8KAGuAATFT3AIQCBlAgiAlLtH7ggAZgACEIBASQIIgJLgMIuCAAIgijaQBAQgkCIBBECKXSNnngFgBiAAAQg4EkAAOALEPCgBrgAExU9wCEAgZQIIgJS7R+4IAGagkQS00HcorX4ohfmhUPJHWsgfKmP+RQp9qzD69lax5rb9lsRt114o+kJI00gIFAUBCEDgVxBAADAejSCgtb5dKfFVadRXtDB/v3hN+yqxVY4aURxFQAACEKiAAAKgAqi4rIfA+EtftFqX2h/wn1i6sfiquFgO6olMFAhAAALpE0AApN/D7CowxvwvIdR/6bRaX7yxK+/MDgAFQwACEPBAAAHgASIu6iCg7X16dalQ5uxet3NVHRGJAQEIQKDJBBAATe5uI2qzX/xSfkJLc85Sd+KaRpREERCAAAQiIIAAiKAJpPDQBOxwflMb86bF+c53YAQBCEAAAn4JIAD88sSbFwJ6pzHyjMVW+8OiK7UXlziBAAQgAIH7EUAAMBBxETD6MtXqvHZ7Vy7ElRjZQAACEGgWAQRAs/qZbjVaD6VUZy60ivfyqz/dNpI5BCCQDgEEQDq9amymUtsd+grxB9u7na83tkgKgwAEIBAZAQRAZA3JLh0tvit18bsLZ8vt2dVOwRCAAAQCEkAABISfe2hpzFeGrfbv7+jKW3NnQf0QgAAE6iaAAKibOPH2ENh60M7i+GsvlMsggQAEIACB+gkgAOpnTkQhtva2Fcfxsh5GAQIQgEA4AgiAcOyzjGyE+d9rd7ZfxC//LNtP0RCAQEQEEAARNSODVL5jdhX/dvFd8ra6ap3smkPFaPQCJc0TjDRHCSOPtKsO1htlDhBaHCCUKurKhTgQgEDDCNhXktqdyvq2qpuNUtuVENfZL1W7Zbm8cihbV+zcLP8l5ooRADF3p0G52V/+P2+p9rPr2OBnujs42u4keJww5j9YhEc1CCOlQAACCRHQQv7EpnuZMmZrb774mhUG9qVm8XwQAPH0ormZ2E1+lJS/tX2+842qilzbNWvbevhG6/+19n9HVhUHvxCAAATKEBiN5E9bLXNxv19cfMu5cmcZH75tEAC+ieLvQQTsr//TFuc651eB5tCumRyY4Z+KkX6TvZx/YBUx8AkBCEDAFwEt9B1219O/6MvivFu7cocvv2X8IADKUMNmxQTsBa//ujBfHOP90lfXqGk9ONFoc7b94l+74oQ4EAIQgEAEBKTWO4ySsz3V/mCo7c8RABEMQnNT0EudQeeoG86RSz5rXN9dfpzS6uPW57N8+sUXBCAAgQAEvm7U6I8Wu2t+VHdsBEDdxHOKZ8wf9+Y7H/VZ8vTG4atHcvQhJdT+Pv3iCwIQgEAoAuPbAi3TepO9Wjr+YVPbBwFQG+q8AtmlMZcvqeL53i5t2Uv+U3r050KYP8mLJNVCAAIZEbigp4rTvJ039wEOAZDRZNVXqh5JJX5joTvxT15idk1n/Wj4KSXFy734wwkEIACBeAl8wW6Tflwdm6UhAOIdgnQz0/IjvS3F63wUcMTJZuKWdYO/sQ8Rjtf084EABCDQeAL2lsD/WLez85KqRQACoPGjVHOB442xCnNUr7vmWufI9rK//eX/OX75O5PEAQQgkBgBu2PQlxa3FS+r8p0pCIDEhiL2dO02u59a2NJ5tY88pzYNL7S7+Z3kwxc+IAABCKRGwO4keOHSXPHmqvJGAFRFNlO/LaOfdNP8xA9cyx8/7W/37v+Eqx/sIQABCCRNwJjX2tVUH6uiBgRAFVRz9Wn0Zb35iRe5lj9e529f1PNtlvq5ksQeAhBInYC9q3qnKMQzlroT9iVDfj8IAL88M/cmX9GbK7Y6Qbh7ud/w69YHm/w4gcQYAhBoEIFv9bYVz/P9PAACoEETErQUrW/ev+j82nVducslj+nZ/huNkB9w8YEtBCAAgcYRMOYUeyvA7oXi74MA8Mcya09SyIsW5oo3uEC4+8U+um+3w1TrXPxgCwEIQKBxBOyPrM6oc4TPrdURAI2bkkAFSfH83ua2fd91+c/UpsE5wogzynvAEgIQgEBzCdilge9enGu/3VeFCABfJLP2o2/pbeusd7k/ddAZZl2n0/+5/fV/QNYoKR4CEIDAXgiMHwgcFJ3DfL1GGAHAqDkT2P3K3/ZLXBxNbRy8Q0hxlosPbCEAAQg0noAR7+zNt8/2UScCwAfF7H2Yt/TmOhe4YFg/O7xWCXO4iw9sIQABCDSdgB6Z65ba7cN9vDAIAdD0aamhPmX0U7bPT/xz2VDTGwe/aaRwen6gbGzsIAABCCRHQInf7nXb/+CaNwLAlWDu9lrf2is661zU6NTs8P285jf3QaJ+CEBgxQSkfH9vc3Hyio/fy4EIAFeC2H+rN9d+tgsGe///h/b+/2NdfGALAQhAIBcCo5H86Y6zCudbpgiAXCamojrtfv2fXNzcOb6s+/XvNI9QreH1Ze2xgwAEIJAjgWJUPPoXZ0m7cqr8BwFQnh2WYwJGbLRPpG4pC2NydnicFObTZe2xgwAEIJAjAbtj6qsW54rPuNSOAHChh60l4Lb/v938Z96KiBlQQgACEIDAqgicZ2+/Om2chgBYFW8OfiABuwfA0XYPgCvKkpmaHfyVtT22rD12EIAABHIkYHcF/JLdFfAYl9oRAC70sBVK6Sdv7058vyyKg2cGV7aUeFpZe+wgAAEI5EhgJMT3dsy1nc6dCIAcJ8djzS01fMxN3YddV9bl9Ez/50bJXy9rjx0EIACBPAnoX/TmJg51qR0B4EIPW9EZFJMub6eaml3ewdv/GCQIQAACqyOghb5raW5iv9VZ3f9oBIALPWxFTxUTdhOgflkUUzPLA3sfoShrjx0EIACBLAnYNwP1tky0XGpHALjQw1bYp1CdZsg+BGifZQn3cc0/XOb3RD7WtDY8SqwZPFysU6PBBiXVo40xj7f/+nQh9fPs1ZVfC55j2ARu0EZcoaS4Siq5zf5qus4M2tuLZXHz9p+LXS5vsLy7LPj/6u5qcb1Q4gq70ucqKeU2Yyz/Vnt7R4ibb/yBWPbB/9Anign7M2KdVINDxvOvhXmCfTj5aTnMv+v5y+nk7ePvOvQXgI8acvbhOoCh+++af9y9N3J9t3+U1OpF468q+8f+nLjz9ZOdFuJyacxWafSXe1vW/NiP1zJecuSvjRHqcru3x1ahLP/ummvLkPNls35m+fEtaedfWqkmhNOOpb5y8unH9fyFAPDZjQx9uQ4gAqC+oZmc2XWUUq0TjdCvs1cGDqgvch2R9E4j1SVSji4J/aWzt2qbzt/O1MVSjy5Z2LLmJ3V0fLUx1neXH6eMOlEY/cdNmX/X8y8CYLVTxPH3I+A6gAiA+gdq3enmoFZneIr9hfyn9vmLA+vPwGdEvSSFOs+o4oO9rrzdp+eqfDWJv9GjRSsq3yXvLD6w/T3yjqqY+fR7N/+J4Vuk1qelPv+u518EgM/JytCX6wAiAMINzYaumdZmdJYwxl4RSOxjH4CyJ+8LB6ro3tyVNyeW/d3pJs1f6JGQ6sLhrqK78zx5S9r8R+MrAsG/C8swdD3/Bi869BdAGejY/JKA6wCG7r9r/k2Yhanu4AVGy4/Z+7aPSaSebUaZ1yx2O99OJN9fmWZq/O0DdlfbB+1eszjf+Q78wxJwPX8hAML2L/norgOIAIhjBA7umgNbZnCJMPIVcWS0lyyk/HBbtk65sSvvjDrPVSaXCn+p5SWdO1qnXH++vGuVJUZ9eCr8HwjR9fyLAIh6LONPznUAEQAx9djIqdnh221G58aU1e5c9EgaedLCfOdD8eXmK6OI+Ws9tDt2nrQ417nIV7Ux+pnaODjDLh88O5VbAq7nXwRAjFOYUE6uA4gAiK/ZkxuHr5Rm9IlYNmiyt/t3SdV6uX316Zfjo+U/o+j42x3n7IN+L+91i8v8Vxufx9j4/ypCrudfBEB885dURq4DiACIs90bZocv0Xp0aWgRMP7yL5R68fa59v+Ok1Q1WUXD33752xl48VK3/ZVqKo3T63R3eIwZjuxeBnHvUup6/kUAxDl/yWTlOoAIgHhbPTk7PM4+GPjpcBnqkRGtl+Tyy/+BnIPzt5f9RdF6SS6//B/Ef+PwVXZfiU/GfDvA9fyLAAh3dmtEZNcBRADEPQa774mKc0JkaXfze2Oz7/nvm2pI/kaYNzT9nv++OmD5v8PO/1n7Oi7Uv7uefxEAoTrXkLiuA4gAiH0Q7n4w7XM2y2PrzHT8tPnCluKEOmPGGSsQfykvXthcnBgnk3qzWj87uFQJ8bJ6o64smuv5FwGwMs4ctRcCrgOIAIh/tHbvnDb4nhTyUXVkO15n3rm9eGbTlpqVZVc3f7tn/g8eropnXteVu8rm3CS7uvmvhp3r+RcBsBraHLAroZYAACAASURBVPsgAq4DiABIY6gmu4PfkVr8feXZ2qf+TCGf05RNfnzxqo2/XW5pjOXfkE1+fPFf3x38O6VFdA+iup5/EQC+JiRTP64DiABIZ3DWzww/qpR5baUZS/G+3ub2qZXGSNR5HfztF8L5C3Pt0xJFVGnaUzP9j9kdg/+o0iCrdO56/kUArBI4h9+fgOsApi4AQuc/3iDHduRW+6TydVrK77WM+Mpyv/W3t5wrd/qe1amuOUQP+z9WSj3ct+/d/vTSQHWOqGJv/wO75uAJPfpPWorfMSPztJbSjxJaHGSXednbuy6f5vAfv9hnNJg4ooq9/eHvMmN7t3U9/yIAqulLNl5dBzD0F2jq+T/UoGmhl6WUW7U05+zoTlztcxinZwdz9h7xRp8+9/iyJ6O321+f7/bpe0N3+UlmKM8QwhxrlOr49L03X8nyN+JtC/Pt9/hk1DT+U5sG9uVZ4h0+Gbn4cj1/IQBc6GMrXAcQAVDlEI3f2Nb6oLqjdYavV7UedIZZVxT9f/F/FUDvVHd2DvOV5+TbzQFizeg8+376E91/5ZftUTr87atxdxRF5zBf71hoKv/xlYy2tvMv1P5lp8Knnev5FwHgsxsZ+nIdQARADUNjxI+00ccsbZnY5iOa/RV0gf0V9GYfvu7j4zw7S/aXuvtn/KtzqFtfVMIc7u7Ng4cU+Etxrn324kwP1drXHDed//BC+wrtk3ywcvXhev5FALh2IHN71wFEANQ1QHqnVvKFS93ON10jHrJx+Ykjqb7v6ue+9lKNDl/orvmpq88N3f5z7TqC/26fiTjI1Zdf+5j5a6O0Pnz7lof9zLXmqPkb+R+X5jvfcq9x+Ulaq3929ePD3vX8iwDw0YWMfbgOIAKgzuGxX0Ja/KaPKwG2b9+2mT/DU/ZftXP0Aldf41+etr6vxfflv6cy+Lv22M1+LMLE0UvdiWvc/Ahh5/+71sfTXf242ruefxEArh3I3N51ABEAtQ/QD9WdxTNc77X73aLWvKU317nAhcT4nrNZM7oymsv+ey8mPv7GnNKb7/x5FvyNuEbdVTzTef5nB+PbJfa1wWE/rudfBEDY/iUf3XUAEQD1j4AW8sKlucLpHv6GjctP1lL9k5fs1ejIXnfNtS6+pmeHH7J71yexdS38XTrtxfYCe956i4un6Y39pxopr3Lx4cPW9fyLAPDRhYx9uA4gAiDE8OiRvVT+ZLdbAUaun13erkRryrGCG+wMPdLFx91ixIirwj3tv9rsI+KvxfW9Le3DVlvBfY9Pkr8ST3K7FTB+R0O/Z283rXdh52rrev5FALh2IHN71wFEAAQaIGk+3tvccdrVbHJ28EV7AnmJSwX2i/vSpfm204uGpjf1P2W3r32VSx6120bC39a91f4Nv8Kl/lz5T21c/hsh1Ytd2Lnaup5/EQCuHcjc3nUAEQBhBmi8WY1e7mxw2fXNbgrUtZsCbXKsYMbOUOnXrY7XZa8Z9n9R1yY/jrXeaw5/XyTL+bGvnNilB51DXObfnru22OjvLJeBHyvX8y8CwE8fsvXiOoAIgHCjY4R89eJc8amyGdjXBP+B3WHvs2Xtx3ZSyZctdIvPl/Vhc7BXMczHytqHtIuCv5AvXZgrvlCWQ878JzcOXyWlKf33U5b5fe1cz78IAB9dyNiH6wAiAAIOj5Yf6W0pXlc2g/Xd/rOVlt8oaz+2M8o8w775b7ykqtQnxhe0rLiQCPjbDW1+w64AuHLFOT/gwJz5T28cPM9IcXlZdj7sXM+/CAAfXcjYh+sAIgCCDs93bP+eWTaDdZvMrxdm+POy9mM7PSoeuXSWvKGsj4NnBle2lHhaWfvAdsH5G1U8YrErbyzLIWf+0zO7Djeq5bR6pSz3PXau518EgGsHMrd3HUAEQLgBGr/9bXHLmtJP8Y/X3ss1Q/smwvIfuyfBw13WZE/NLu+wT2KvK59BOMsY+LdVsb/L/v8581/bNWvbeuj9rZurmUjX8y8CYDW0OfZBBFwHEAEQcqj0qDc3UZTO4ATTnjpk2C9tbw1724pCbJXjVxqX+kzNLI/SWf73wBLhX6rp3ozc+D+6a9bcoYd3eUunhCPX8y8CoAR0TH5JwHUAEQBhp8mtf+O10EPtUoFb/Lu3ZLULEdL9uNUP/3Q77ydzt/mxD+H6SaO8l9T/gMtX3gxL1wEM3f/U83edotD1h47vys/VPnT9oeO78svd3rV/CIDcJ8ixftcBRAA4NsDRPHT/Qsd3xOdsHrr+0PGdAWbuwLV/CIDMB8i1fNcBRAC4dsDNPnT/Qsd3o+duHbr+0PHdCebtwbV/CIC858e5etcBRAA4t8DJQej+hY7vBM+Dcej6Q8f3gDBrF679QwBkPT7uxbsOIALAvQcuHkL3L3R8F3Y+bEPXHzq+D4Y5+3DtHwIg5+nxULvrACIAPDTBwUXo/oWO74DOi2no+kPH9wIxYyeu/UMAZDw8Pkp3HUAEgI8ulPcRun+h45cn58cydP2h4/uhmK8X1/4hAPKdHS+Vuw4gAsBLG0o7Cd2/0PFLg/NkGLr+0PE9YczWjWv/EADZjo6fwl0HEAHgpw9lvYTuX+j4Zbn5sgtdf+j4vjjm6se1fwiAXCfHU92uA4gA8NSIkm5C9y90/JLYvJmFrj90fG8gM3Xk2j8EQKaD46ts1wFEAPjqRDk/ofsXOn45av6sQtcfOr4/knl6cu0fAiDPufFWtesAIgC8taKUo9D9Cx2/FDSPRqHrDx3fI8osXbn2DwGQ5dj4K9p1ABEA/npRxlPo/oWOX4aZT5vQ9YeO75Nljr5c+4cAyHFqPNbsOoAIAI/NKOEqdP9Cxy+BzKtJ6PpDx/cKM0Nnrv1DAGQ4ND5Ldh1ABIDPbqzeV+j+hY6/emJ+LULXHzq+X5r5eXPtHwIgv5nxWrHrACIAvLZj1c5C9y90/FUD82wQuv7Q8T3jzM6da/8QANmNjN+CXQcQAeC3H6v1Frp/oeOvlpfv40PXHzq+b565+XPtHwIgt4nxXK/rACIAPDdkle5C9y90/FXi8n546PpDx/cONDOHrv1DAGQ2ML7LdR1ABIDvjqzOX+j+hY6/Olr+jw5df+j4/onm5dG1fwiAvObFe7WuA4gA8N6SVTkM3b/Q8VcFq4KDQ9cfOn4FSLNy6do/BEBW4+K/WNcBRAD478lqPIbuX+j4q2FVxbGh6w8dvwqmOfl07R8CIKdpqaBW1wFEAFTQlFW4DN2/0PFXgaqSQ0PXHzp+JVAzcuraPwRARsNSRamuA4gAqKIrK/cZun+h46+cVDVHhq4/dPxqqObj1bV/CIB8ZqWSSl0HEAFQSVtW7DR0/0LHXzGoig4MXX/o+BVhzcata/8QANmMSjWFug4gAqCavqzUa+j+hY6/Uk5VHRe6/tDxq+Kai1/X/iEAcpmUiup0HUAEQEWNWaHb0P0LHX+FmCo7LHT9oeNXBjYTx679QwBkMihVlek6gAiAqjqzMr+h+xc6/sooVXdU6PpDx6+ObB6eXfuHAMhjTiqr0nUAEQCVtWZFjkP3L3T8FUGq8KDQ9YeOXyHaLFy79g8BkMWYVFek6wAiAKrrzUo8h+5f6PgrYVTlMaHrDx2/SrY5+HbtHwIghympsEbXAUQAVNicFbgO3b/Q8VeAqNJDQtcfOn6lcDNw7to/BEAGQ1Jlia4DiACosjv79h26f6Hj75tQtUeErj90/GrpNt+7a/8QAM2fkUordB1ABECl7dmn89D9Cx1/n4AqPiB0/aHjV4y38e5d+4cAaPyIVFug6wAiAKrtz768h+5f6Pj74lP1v4euP3T8qvk23b9r/xAATZ+QiutzHUAEQMUN2of70P0LHT8sfSFC1x86fmj+qcd37R8CIPUJCJy/6wAiAMI2MHT/QscPSx8BEJp/6vFd/34QAKlPQOD8XQcQARC2gaH7Fzp+WPoIgND8U4/v+veDAEh9AgLn7zqACICwDQzdv9Dxw9JHAITmn3p8178fBEDqExA4f9cBRACEbWDo/oWOH5Y+AiA0/9Tju/79IABSn4DA+bsOIAIgbAND9y90/LD0EQCh+ace3/XvBwGQ+gQEzt91ABEAYRsYun+h44eljwAIzT/1+K5/PwiA1CcgcP6uA4gACNvA0P0LHT8sfQRAaP6px3f9+0EApD4BgfN3HUAEQNgGhu5f6Phh6SMAQvNPPb7r3w8CIPUJCJy/6wAiAMI2MHT/QscPSx8BEJp/6vFd/34QAKlPQOD8XQcQARC2gaH7Fzp+WPoIgND8U4/v+veDAEh9AgLn7zqACICwDQzdv9Dxw9JHAITmn3p8178fBEDqExA4f9cBRACEbWDo/oWOH5Y+AiA0/9Tju/79IABSn4DA+bsOIAIgbAPd+mfk1OxQu1TgFl+I0PPjUvvY1q1++LvyT93ebX6EQACkPgGB83cdwNAn8NTzd2u/HvXmJorSPk4w7alDhv3S9uMvwG1FIbbKUVkfU7PLQyFUq6x9WDv4p8z/0V2z5g49vCtkDa7nLwRAyO41ILbrACIAwg2B0aPFxS1rpspmMPl2c4BcM7y1rP3YTt1ZPHz7e+QdZX1MzywvGaUOLmsf0i4G/m1V7H9jV95ZlkPO/Nd2zdq2Hu4sy86Hnev5FwHgowsZ+3AdQARA0OH5tu3fs8pmsG6T+fXCDH9e1n5sN1LFYTu68vqyPuz8fNfaPr2sfWC74Pz1qHjk0lnyhrIccuY/3d31b4xu/aQsOx92rudfBICPLmTsw3UAEQABh0fKD/c2F68vm8H6bv/ZSstvlLUf2xllnrXY7Xy7rI/1M8OPKmVeW9Y+qF0M/I155uJ85ztlOeTMf3rj4HlGisvLsvNh53r+RQD46ELGPlwHEAEQbniMkK9anCs+UzYD+wDgH9iv8M+Wtd9tJ1/Rmyu2lvUxPTs83gjz8bL2Ie2i4K/ksb1ucWlZDjnzn9w4fJWU5lNl2fmwcz3/IgB8dCFjH64DiAAIMzxa612m6Gywl99L38Ofnh10jRCbXCowRmxanG/PlfVx0BlmXdHp/0IJNVHWRwi7aPgLMbs4154vyyBn/lObBvPCiJmy7HzYuZ5/EQA+upCxD9cBRACEGR4t5ceWNhdOl84nNw6+IKU4xrGCL9gZeqmLj8mZ/selkse7+KjbNhr+Rny+N99+mUv9ufK3567/arn9Jxd2rrau518EgGsHMrd3HUAEQIAB0npoCvPExe6aH5WPbuT62eXtSrRKryIYx7a/hG9a2tI51N4KsBcTyn3Wzyw/Xinxz8ksB4yIv+3AL+xSUMu//CdP/kJMzuzqSdWaLE/O3dL1/IsAcO9B1h5cBxABUP/42D/68xfm2qe5RN7QXX6S1sp+6bp/Rko/cUd34moXT+tnh3+uhDnZxUddtrHxtyLsCUtbJra51J8d/43LT9ZS/ZMLMx+2rudfBICPLmTsw3UAEQD1Do/9nX110Sqe5bL2e5yxvf//NvuT/V0+srcnobdbQfJuF18b3mr21/sNx0+zH+Xip2rbKPkb8baF+fZ7XGrPjb89b51ueZ3rwsyHrev5FwHgowsZ+3AdQARAncOj7aY55mi3S/+787UC4BtWADzbU/bfsnPk7OueS9H/aG8FrPOUl2c3cfK3XwLftALsOa7F5sTfnrfGS1ef4crM1d71/IsAcO1A5vauA4gAqGuA7JePkf/RZc33nkztvc+j7L3Pa3xm7uM2wDif3XsTmP8enwiIm7+P2wC58N8tdJTTLStffzuu518EgK9OZOrHdQARALUMzjajRsf4+OV/96//TYM/s8v3nJ4heIiqL7Cz9BYfNO4+QUv1Rfumk8f68OfBR/z8pXhfb3P7VA+1iqbzt8v/zrfL/7zMqitv1/MvAsC1A5nbuw4gAqDCAbJPm0ulLixUMeN6z39Plgd3zYGtYf9fhVIH+szc/gK9fVR0Dru5K2/24Xd8T3q43+gcJUZvCrY6ICH+djXAbcPlzmE7z5O3wH/vBNadbg4qJuz8C3WAD06uPlzPvwgA1w5kbu86gAgA/wM03mRGtFqflXJ4jq9f/XuynNo4mLG/rEtvHPOrqrUno832XnTXJ5Hxr1Ep5Jn22YdX1LVZUKr87TMdXbsp0Gb4753A5Oxgk51TrzPqwtv1/IsAcKGPreP7zMO/z931Dyi0gLG/3EZGm532nvx1Qsqr7KX5r2jV+rLLDn97G+tDzjRTo3b/x/bXz0HVjL6+TQ47Ry6cLbf79j9+c1tnNHqxUeLfCmOeark92sZY6351oEH8tb5VFZ0jt3flAvwfTODu+W/1r/V99cuFtev5CwHgQh/b7AVATiNg933/kN13/8RKa5byo/YFRX9caYxEndfCX8uP9LYUr0sUUaVpT88ML7ZXkkq/PKuK5BAAVVDF54oJuA5g6F/QrvmvGFTiB9o3n/2mffPZ1+oow17F+B37foD/U0esVGLUx18b+wv3d3rd9j+kwqaOPO2Df78ljLZMVPAfzfet1/X8FbyY0F8AdQxPk2O4DmDo/rvm3+Te7qlt8u3mALNmdKXdae/wOuq1F9WvM+32U6u4jVFH/r5j1M3fvqXwZ2JX66mL75K3+a4lRX9TXfNwrUdX1TX/q2Hkev5CAKyGNsc+iIDrACIAYh8qI+2yv0/aPQReVXOmW+1rgu3rhsu/I6DmfCsKF4i/NH/V29yx/PlMz/Q/bZQ8LkYSrudfBECMXU0oJ9cBRADE3Wz7xr/T7Bv//ixQlmfY+TovUOwowobkb6XX6XaLYC/bPUcBs0QSIfmvJF3X8y8CYCWUOWavBFwHEAEQ73DZh85eZsRoa8j7nvbKw3GL88Vn46VUXWbh+dvnAUTrOHsl5nPVVRmv56nu8OViOPqcfSZCxZql6/kXARBrZxPJy3UAEQBxNnqqO3ihfVevfd+5agfN0G6mo1Tr5dvnii8FzaPm4NHwF3pgLP/FbmFnIZ/PmL8c6i8ZpToxV+16/kUAxNzdBHJzHUAEQHxNvueX52eCf/nvQWNFgJGt43O5EhAdfysC7JWA43O5EjDdHb7U/vL/TOxf/uM/D9fzLwIgvvNvUhm5DiACIKZ2Gzm5cXiqlNq+Gjau5U5jSrvvSRf2tcFNfTAwZv7argJVp7u+tjmmaX+oXO6+52/0u2O+7H/fvF3PvwiA2Ccy8vxcBxABEEeDx0vN1MMGHwrwtP/qANin00ey/fqmLRFMhr82nzP99uubtkRwvNRPmsFF0c//A/5aXM+/CIDVnX442vMAIgDCj9R4k5mRlH8Z4zrnh6IzXqculfnPTdmsJjX+o5H8aWvMf7791fDT655Bavy5AuDeczx4IuCqQBEAnhpRws14b3PdGW0xxpxQwjy8iZQfVrL1zir2rq+juLT521sCuvVhNWq986ZzZK8OXr5j/JL/yG7vG98tr5XU63r+5QrASihzzF4JuA4gAqD+4Rq/0rTVGZ5i73X+aUwvNilFwr7Axkj1Z6N+cYGvV9mWymMVRo3iL/Qtxqj36lbxvlRuy9zLX+rTqnux1SoGwuFQ1/MvAsABPqbuT6EiAOqbovXd5ce1tDrBCG1f9hLH+8z9Va9vE1J9REt90VJ34hp/fv15ajR/K8Sksvz16KLFLWt+6I+aP0/38tf6j5MXvvdgQQD4mw88lSDgOoAIgBLQV2xi5CEb+0/QQr3IPsL9cmv2rBWbpn3gt+wvm63K6Mtumu9cHW7VQJ78Lftv2vG5dDf/iR+EHKUN3eUnGa3+X7uj0bFNnH/X8y9XAEJOZwNiuw4gAsBlCOzX+gmimFwr1oweJtYpOThEafUY+8rexwkjnmakeZ4ScoNLhNRttTYLUsrLhRRXSSO3aaF/ZnT7plZb7OzdKJbFxWJYXiDAf1/zoYXZbmfwcvuGx6tsH7YZpX+mB+3t7WWxY/vDLf+utPwdPl1TTAmxZmjEwUoPNihh51+ax+cy/67nXwSAw+xham8BbCsKsVWOyrKYmlkepbLmtmyN2EEAAhDwTkBr3dsy0XLxiwBwoYetmLit2O/68+VdZVGsn1m+y261vaasPXYQgAAEciRgr2bdtTQ3sZ9L7QgAF3rYin6/OPiWc+XOsijWz/Zvyv0ydVl22EEAAjkT0L/ozU0c6kIAAeBCD1sh9eiIhS1rflIWxeTM4HtSiaeUtccOAhCAQI4ERlpctWNL++kutSMAXOhhK7Qyz1nqdsZP/Zb62F24vmQfpfq9UsYYQQACEMiXwBfsQ4AvdSkfAeBCD1v7cLV86cJc8YWyKCZnB++yQ/i2svbYQQACEMiUwDlWALzDpXYEgAs9bO1qG3Pa4lzn/LIoJmeHx0lhPl3WHjsIQAACeRKQr3R9RTMCIM/J8Ve1lB/obS7+pKzDQ7p3PXqki5+VtccOAhCAQI4ERqo4zG6/fL1L7QgAF3rYjgl81V6GeoELCnsV4Kf2KsBjXHxgCwEIQCAjAj+2593HutaLAHAlmL29vqU311lXfjc1IaY2DS8UxpyUPUoAQAACEFgZgQusAHjLyg7d+1EIAFeC2NuVAPrxLi9gmdw4+G0pxf8PSghAAAIQWAEBKZ7f29z+2gqO/JWHIABcCWJvCZjX2asAHymNomvU+sHgJ6olH13aB4YQgAAEMiAwGsmf7jirdYTLVdc9mBAAGQxM1SVKbT61sKXzapc4UxsH77BrCs9y8YEtBCAAgQwInGEv/5/no04EgA+KmfswerS4WExssG/20mVRHNg1B7d1/1/s27z2L+sDOwhAAAJNJmDf/3P7qOgcdnNX3uyjTgSAD4r4ENKIoxfm21e4oJjcNHi39fNWFx/YQgACEGgwAefNf+7LBgHQ4EmpszQ7SOcvzLVPc4n5iDPN+n6rf619PfBaFz/YQgACEGgeAb3U73eOdHn52gOZIACaNyWhKrqht614lNgqRy4JTG3sv1lIeYGLD2whAAEINI2ANOZPFuY7H/BZFwLAJ83sfcnftVtT/jcnDHZFwLQeXmGEeLaTH4whAAEINIfAFT1V/JbLc1YPhQIB0JwBCV6JMeKLi/Pt33dNZHJm11FGyO8qpfZz9YU9BCAAgZQJaKHvUNo8vbdlzY9914EA8E00Z3/2EVVZmCMXumt+6opheuPwNUaav3T1gz0EIACBlAlII49fmC8+WUUNCIAqqObsU8r325cDnewDwdSmwQX2dYNv9uELHxCAAASSIyDF++yOf6dWlTcCoCqymfq1FwF2yaJz+GJX3uiMwD4PMDka/rXdJvgYZ184gAAEIJASASM+32sVx/q+739fBAiAlAYilVw9XgU44mQzcfPa/helVC9MpXzyhAAEIOBCwN73/x9LqvN79su/7+JnX7YIgH0R4t9LENADoc0TfT20MhYBt6wbfsYm4vyAYYliMIEABCBQH4Hdv/yPq/rLf1wQAqC+tuYW6W/sftW/561oeztgSg/fa/2d4s0njiAAAQhERODuDdVU8dYqL/vft1wEQETNb1oqSshjts8VX/JZ1/Ts8PiRGH2Qdwb4pIovCEAgJIHxHv9Std6wOFd8qs48EAB10s4tlhY3DgfFE3aeJ2/xWfrUzK4jhWp93Pp8rk+/+IIABCBQNwH7BrXLlRr9Ua+75tq6YyMA6iaeWTy7lv+Ti5s7x3sve7xj4GjwBmHMvFHqYO/+cQgBCECgQgLjt6gqqTbal6hdZO/G281P6/8gAOpnnl1Eu6vfq+ylrfFDfN4/B51h1nUmhm/VI/1mu3Pgw70HwCEEIAABrwT0bUKqCweyeLev1/qWTQ8BUJYcdismMN7K0ijx7B3diatXbLTKA9d2zdrOaHjCSMoTlDCHr9KcwyEAAQhUSkAL+ZOWMRf3W8XFob/49xSKAKi05Ti/l4ARP+oPiuf6fJXlQ9M10m4jfLQVHC8XWvyuXefyWLoAAQhAIAgBe94TSlxmNzPbutAtrgh1qX9vtSMAgkxFrkHN3/dU+4V1rG/dQ/jgrnlkazQ6WijzVCsIHmcFwWPsfzfYqxJrlRITwj5NmGs3qBsCEHAlYG8+arFsVyXdbL/ot9uty39m/3uN0PJ7Wrf+cekseYNrhCrtEQBV0sX3gwhIaT69cHX7NWKrHIEHAhCAAATCEUAAhGOfbWSp5SULW1onxnY5LNuGUDgEIJAlAQRAlm2PoGgpP9y7uvUGrgRE0AtSgAAEsiSAAMiy7ZEULc1nD9rR/s/XXiiXI8mINCAAAQhkQwABkE2roy30//T7xe9Xvzog2vpJDAIQgEAQAgiAINgJel8CeiSvLdqj39/enfg+ZCAAAQhAoB4CCIB6OBNlHwTsyzDubMnWGxfmW5/g4UDGBQIQgED1BBAA1TMmwmoIaPO5/rD9Rm4JrAYax0IAAhBYPQEEwOqZYVExAS3Mdruv/0m9buuvuRpQMWzcQwAC2RJAAGTb+gQKN/p/jlri1CrfIZAABVKEAAQgUAkBBEAlWHHqj4B9RFC2PjIctrbsOEv+qz+/eIIABCCQNwEEQN79T6Z6qXXfbtv/X7Qavnexu+ZHySROohCAAAQiJYAAiLQxpLU3AtrYf7lMidYl229qXSYulgNYQQACEIDA6gkgAFbPDItICGhtFlRLXWq0+avFVvGP9i2Dw0hSIw0IQAAC0RNAAETfIhJcGQF9izbq71rSfMW++vcfF37Q+QHvGVgZOY6CAATyJIAAyLPvja/abix0u11K+H375sF/FtJca4S8TrbM9Xo4WipGEztGE+Ku3o1iWVws7FUDOb6twAcCEIBAVgQQAFm1m2IhAAGfBHpz7eDnUJ/14CsvAsGHd2p2wK+vvGaOaiHQGAIIgMa0MstCEABZtp2iIQABHwQQAD4o4iMUAQRAKPLEhQAEkieAAEi+hVkXgADIuv0UDwEIuBBAALjQwzY0AQRA6A4QHwIQSJYAAiDZ1pG4JYAAYAwgAAEIlCSAACgJDrMoCCAAomgDSUAAAikSQACk2DVy3kMAaTvr7QAACHhJREFUAcAsQAACEChJAAFQEhxmURBAAETRBpKAAARSJIAASLFr5MwVAGYAAhCAgCMBBIAjQMyDEuAKQFD8BIcABFImgABIuXvkjgBgBiAAAQiUJIAAKAkOsygIIACiaANJQAACKRJAAKTYNXLmGQBmAAIQgIAjAQSAI0DMgxLgCkBQ/ASHAARSJoAASLl75I4AYAYgAAEIlCSAACgJDrMoCCAAomgDSUAAAikSQACk2DVy5hkAZgACEICAIwEEgCNAzIMS4ApAUPwEhwAEUiaAAEi5e+SOAGAGIAABCJQkgAAoCQ6zKAggAKJoA0lAAAIpEkAApNg1cuYZAGYAAhCAgCMBBIAjQMyDEuAKQFD8BIcABFImgABIuXvkjgBgBiAAAQiUJIAAKAkOsygIIACiaANJQAACKRJAAKTYNXLmGQBmAAIQgIAjAQSAI0DMgxLgCkBQ/ASHAARSJoAASLl75I4AYAYgAAEIlCSAACgJDrMoCCAAomgDSUAAAikSQACk2DVy5hkAZgACEICAIwEEgCNAzIMS4ApAUPwEhwAEUiaAAEi5e+QeXgDMLI+EUopWQAACEEiKgNa6t2WilVTOJAuB+xAILgDWzyzfYb//96MrEIAABFIioIW+a2lugnNXSk0j1/sRCC4ApmYH19uMHkFfIAABCCRG4AZ7C+CRieVMuhC4l0AMAuDbNptn0BMIQAACiRG40gqA30gsZ9KFQDwCYP3s4FL7AMDL6AkEIACBpAgY8fnefJtzV1JNI9n7Egh+BWB6djBnhNhIWyAAAQgkRUCKs3ub2+9MKmeShcB9CIQXAN3hS402f01XIAABCKRFQL6yN1d8Lq2cyRYCvyQQXABMvsP8miyGN9IUCEAAAikRGKnisB1dOX6ImQ8EkiQQXACMqdmVAFfb/zw+SYIkDQEI5Ejgx/YBwMfmWDg1N4dAFALAPgfwHvscwJ82ByuVQAACDSdwgRUAb2l4jZTXcAJRCIANG/vP0VJ+veGsKQ8CEGgKASmebx8A/FpTyqGOPAlEIQCEMHJqdrjNtuCoPNtA1RCAQCoEjJA/W1StI0RX6lRyJk8IPBSBSASAEJOz/VOlkO+lTRCAAAQiJ/AOe/n/nMhzJD0I7JNANAJg3enmoGKi/69CqAP2mTUHQAACEAhAwL7/585B0Tns1q7cESA8ISHglUA0AmBc1dSmwbwwYsZrhTiDAAQg4ImAkeJdi5vbp3tyhxsIBCUQlQBY2zVr27p/rb0KsD4oFYJDAAIQeCABrW9uF50jb+zKReBAoAkEohIAY6D2WYAT7bMAH2oCXGqAAAQaRMCYU3rznT9vUEWUkjmB6ASA6Bo1qYf/YBP7zcx7Q/kQgEA8BL7d21Y8V2yVo3hSIhMIuBGITwDYeqa6u47QWl6lhNrfrTysIQABCLgRsA/+7bIefmNpy8R4qTIfCDSGQJQCYEx3cnb4h1KYTzaGNIVAAAKJEjCv6811PpJo8qQNgb0SiFYAjDO2WwS/124RfCr9gwAEIBCCgN3054OLc8WbQsQmJgSqJhC1ABDHmtbU44Z/JaR4adUg8A8BCEDg/gT0l3uqc4zd8W8IGQg0kUDcAsASP+JkM3Hz2v4XpVQvbGIDqAkCEIiRgPn7idvaL7r+fHlXjNmREwR8EIheAIyL3C0Chp+VUhzjo2h8QAACENg7Af3lids6x/Llz4w0nUASAuDuJoxvBzxh+F67U+Cbm94U6oMABAIRkPIDPdk6hcv+gfgTtlYC6QiAe7BMbxy+ZmRGH1RK7VcrKYJBAAKNJaCFvksZeZLd6OejjS2SwiDwAALJCYBx/pMzu44SqvWXNvnn0FEIQAACjgS+Zdf6/xHr/B0pYp4cgSQFwL23BB4/eIMQZt6+O2BdcuRJGAIQCEvA7u0vpNzUu6b9F+zwF7YVRA9DIF0BcA+vA7vm4AkzfJs2+mR2DgwzRESFQEoE7OX+O+y54v2dQfHuG86RSynlTq4Q8EkgeQGwB8bdQmA0PGGk5etbLfNvfELCFwQgkD4Bu6nPz+zuopcsq+KiW7tyR/oVUQEE3Ag0RgDci8G+TGjKDI+2//9YPZS/q1rmCDdEWEMAAgkT+LHN/TJpxNaFVnGFfbpfJ1wLqUPAK4HmCYAH4Dn4neawVmtkBYF5qv2nx420eEzL7jKslV6ntJgQdjmBV6I4gwAE6iNgn97TSizbS/rjX/QLdpnwz4QS1wgtvzdqtS7f0ZXX15cMkSCQFoHGC4C02kG2EIAABCAAgXoIIADq4UwUCEAAAhCAQFQEEABRtYNkIAABCEAAAvUQQADUw5koEIAABCAAgagIIACiagfJQAACEIAABOohgACohzNRIAABCEAAAlERQABE1Q6SgQAEIAABCNRDAAFQD2eiQAACEIAABKIigACIqh0kAwEIQAACEKiHAAKgHs5EgQAEIAABCERFAAEQVTtIBgIQgAAEIFAPAQRAPZyJAgEIQAACEIiKAAIgqnaQDAQgAAEIQKAeAgiAejgTBQIQgAAEIBAVAQRAVO0gGQhAAAIQgEA9BBAA9XAmCgQgAAEIQCAqAgiAqNpBMhCAAAQgAIF6CCAA6uFMFAhAAAIQgEBUBBAAUbWDZCAAAQhAAAL1EEAA1MOZKBCAAAQgAIGoCCAAomoHyUAAAhCAAATqIYAAqIczUSAAAQhAAAJREUAARNUOkoEABCAAAQjUQwABUA9nokAAAhCAAASiIoAAiKodJAMBCEAAAhCohwACoB7ORIEABCAAAQhERQABEFU7SAYCEIAABCBQDwEEQD2ciQIBCEAAAhCIigACIKp2kAwEIAABCECgHgIIgHo4EwUCEIAABCAQFQEEQFTtIBkIQAACEIBAPQQQAPVwJgoEIAABCEAgKgL/F8RjjsOWcJaDAAAAAElFTkSuQmCC';
                break;
            default:
                return $path;
                break;
        }
    }

    public function isVideo($path)
    {
        return filter_var($path, FILTER_VALIDATE_URL) && (preg_match("@((https?:\/\/)?(?:youtu\.be\/|(?:[a-z]{2,3}\.)?youtube\.com\/v\/)([\w-]{11}).*|https?:\/\/(?:youtu\.be\/|(?:[a-z]{2,3}\.)?youtube\.com\/watch(?:\?|#\!)v=)([\w-]{11}).*)@i", $path) || preg_match('/(http|https)?:\/\/(www\.|player\.)?vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|video\/|)(\d+)(?:|\/\?)/', $path));
    }

    public function previous()
    {
        return $this->isActive()->where('category_id', $this->category->id)->find(--$this->id);
    }

    public function next()
    {
        return $this->isActive()->where('category_id', $this->category->id)->find(++$this->id);
    }

    public function doctor()
    {
        $id = $this->doctor;
        return Page::find($id);
    }
}
