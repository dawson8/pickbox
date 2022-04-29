<?php

namespace App\Models;

use App\Models\Traits\RelatesToTeams;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Obj extends Model
{
    use HasFactory, RelatesToTeams;

    public $table = 'objects';

    protected $fillable = [
        'parent_id'
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function objectable()
    {
        return $this->morphTo();
    }

    public function children()
    {
        return $this->hasMany(Obj::class, 'parent_id', 'id');
    }
}
