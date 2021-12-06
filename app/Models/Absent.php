<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rayon()
    {
        return $this->belongsTo(Rayon::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }

    public function presence()
    {
        return $this->hasMany(Presence::class);
    }
}
