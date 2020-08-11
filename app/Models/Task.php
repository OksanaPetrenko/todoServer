<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   	protected $table = 'task';
    public $timestamps = false;
	protected $fillable = ['id', 'name', 'user_id', 'priority', 'status', 'date'];
}
