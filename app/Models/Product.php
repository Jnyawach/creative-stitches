<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable, SluggableScopeHelpers,Searchable;
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
        'category_id','status','meta_description','keywords','total_stitches','size_id','design_size_inches',
        'design_size_mm','promotion_id'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array2=[
            'categories'=>$this->category()->pluck('name')->toArray(),
            'thumbnail' => $this->getFirstMediaUrl('mainImage','mainImage-icon')

        ];

        return array_merge($array,$array2);
    }

    public function productable(){
        return $this->morphTo();
    }

    public function category(){
        return $this->belongsTo(Category::class,);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function embroideries(){
        return $this->hasMany(Embroidery::class,'product_id');
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function promotion(){
        return $this->belongsTo(Promotion::class);

    }
    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    public function totalOrders()
    {
        return $this->orders()->where('status','Paid')->count();
    }

    public function rating()
    {
        return round($this->reviews()->avg('rating'),0);
    }
    public function totalRating(){
        return $this->reviews()->count();
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
