<?php

namespace App\Models;

use App\Models\Translations\ProductTableTranslation;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ProductTable extends Model implements TranslatableContract
{
    use Userstamps, Translatable;

    protected $guarded = [ 'id' ];

    public $translatedAttributes = [ 'title','attr' ];
    public $translationModel = ProductTableTranslation::class;
}
