<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content','task_id', 'sender_id', 'receiver_id', 'task_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
