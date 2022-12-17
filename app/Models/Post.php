<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, Sluggable, SluggableScopeHelpers, InteractsWithMedia;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable=[
       'title','summary','content','status', 'tags', 'author','credit','index_status'
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('blogImage')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('blog-icon')
                    ->width(300);
                $this->addMediaConversion('blog-thumb')
                    ->width(650);
            });
    }
}
