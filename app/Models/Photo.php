<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Activity;

class Photo extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($photo) {
            Activity::create([
                'user_id' => auth()->id(),
                'action' => 'posted a photo',
                'date' => now()->format('Y-m-d'),
                'time' => now()->format('H:i:s'),
            ]);
        });

        static::deleted(function ($photo) {
            Activity::create([
                'user_id' => auth()->id(),
                'action' => 'deleted a photo',
                'date' => now()->format('Y-m-d'),
                'time' => now()->format('H:i:s'),
            ]);
        });
    }

    protected $fillable = [
        "user_id",
        "file_path",
        "description",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
