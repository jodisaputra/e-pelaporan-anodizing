<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineReport extends Model
{
    protected $fillable = [
        'user_id',
        'machine_name',
        'report_description',
        'report_date',
        'action_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }
} 