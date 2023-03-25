<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $guarded = ['deleted_at'];

    protected static function booted()
    {
        static::creating(function ($q) {
            $q->created_by = auth()->user()->user_id ?? 0;
            $q->updated_by = auth()->user()->user_id ?? 0;
        });

        static::updating(function ($q) {
            $q->updated_by = auth()->user()->user_id ?? 0;
        });
    }

    public function user_hobbies()
    {
        return $this->hasMany(UserHobbies::class, 'user_id', 'user_id');
    }
}
