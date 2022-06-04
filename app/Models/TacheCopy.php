<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TacheCopy extends Model
{
    use HasFactory;
    protected $table = "tasks_copy";
    protected $fillable = [
        'id',
        'name',
        'description',
        'end_task',
        'completed',
        'user_id',
        'list_id',
        'created_at',
        'updated_at'
    ];
    public function getEndTaskAttribute($value)
    {
        return Carbon::create($value);
    }

    public function liste(){
        return $this->belongsTo(Liste::class,'list_id');
    }
}
