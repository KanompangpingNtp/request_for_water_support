<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'water_support_requests_id',
        'message',
    ];

    public function waterSupportRequest()
    {
        return $this->belongsTo(WaterSupportRequest::class, 'water_support_requests_id');
    }
}
