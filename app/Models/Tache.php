<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    protected $table = "tasks";
    protected $fillable = [
        'name',
        'description',
        'end_task',
        'completed',
        'is_close',
        'user_id',
        'create_day',
        'created_at',
        'updated_at'
    ];

    public function getEndTaskAttribute($value)
    {
        return Carbon::create($value);
    }
}
