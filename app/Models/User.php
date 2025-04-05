<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomVerifyEmailNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasSlug;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
        'last_login',
        'registration_date'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmailNotification);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function activePlan()
    {
        return $this->hasOne(Purchase::class)->where('status', 'active')->where('end_date', '>', now())->latest();
    }
}
