<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable, SluggableScopeHelpers;
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

    protected $fillable=[
       'name','price', 'description','stock','sku', 'mpn','productable_id','productable_type',
        'category_id','status','meta_description','keywords'
    ];

    public function productable(){
        return $this->morphTo();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('mainImage')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('mainImage-icon')
                    ->width(300)
                    ->height(300);
                $this->addMediaConversion('mainImage-thumb')
                    ->width(500)
                    ->height(500);
            });
        $this
            ->addMediaCollection('secondImage')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('secondImage-icon')
                    ->width(300)
                    ->height(300);
                $this->addMediaConversion('secondImage-thumb')
                    ->width(500)
                    ->height(500);
            });
        $this
            ->addMediaCollection('thirdImage')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thirdImage-icon')
                    ->width(300)
                    ->height(300);
                $this->addMediaConversion('thirdImage-thumb')
                    ->width(500)
                    ->height(500);
            });

        $this
            ->addMediaCollection('fourthImage')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('fourthImage-icon')
                    ->width(300)
                    ->height(300);
                $this->addMediaConversion('fourthImage-thumb')
                    ->width(500)
                    ->height(500);
            });
    }


}
