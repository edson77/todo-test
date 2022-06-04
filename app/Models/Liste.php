<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{
    use HasFactory;
    protected $table = "lists";

    // protected $primaryKey = 'commit';

    // public $incrementing = false;

    // protected $keyType = 'string';

    protected $fillable = [
        'commit',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function copyTasks(){
        return $this->hasMany(TacheCopy::class,'list_id');
    }
}
