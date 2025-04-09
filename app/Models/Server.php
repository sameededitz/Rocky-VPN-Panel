<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Server extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'android', 'ios', 'macos', 'windows', 'longitude', 'latitude', 'type', 'status'];

    protected $casts = [
        'android' => 'boolean',
        'ios' => 'boolean',
        'macos' => 'boolean',
        'windows' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->useDisk('media')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg']);
    }

    public function getImageUrlAttribute()
    {
        $media = $this->getFirstMedia('image');
        return $media ? $media->getUrl() : null;
    }

    public function subServers()
    {
        return $this->hasMany(SubServer::class);
    }

    public function activeSubServer()
    {
        return $this->hasOne(SubServer::class)->where('status', 'active');
    }

    public function isPremium()
    {
        return $this->type === 'premium';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}
