<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHobbies extends Model
{
    use HasFactory;
    protected $table = 'user_hobbies';
    protected $primaryKey = 'user_hobby_id';
    protected $guarded = [];

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
