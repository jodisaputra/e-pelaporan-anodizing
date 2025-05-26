<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $primaryKey = 'action_id';
    protected $fillable = [
        'action_status',
        'action_description',
        'action_date',
        'technician_name',
        'spare_part_id',
        'spare_part_quantity',
    ];

    public function sparePart()
    {
        return $this->belongsTo(SparePart::class, 'spare_part_id');
    }
}
