<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory,Sluggable, SluggableScopeHelpers,InteractsWithMedia;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable=['name','tags','description','status'];

    public  function products(){
        return $this->hasMany(Product::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('categoryImage')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('category-icon')
                    ->width(300)
                    ->height(300);

            });
    }
}
