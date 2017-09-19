<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','creater_id', 'assigned_to_id', 'project_name', 'due_date', 'description','comments','priority','progress','reminder',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
