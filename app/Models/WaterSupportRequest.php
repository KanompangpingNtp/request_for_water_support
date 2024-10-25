<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterSupportRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_date',
        'salutation',
        'first_name',
        'last_name',
        'occupation',
        'house_number',
        'village',
        'subdistrict',
        'district',
        'province',
        'phone_number',
        'subject',
        'reason',
        'support_address',
        'quantity',
        'capacity',
        'status',
        'user_name_verifier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replyforms()
    {
        return $this->hasMany(ReplyForm::class, 'water_support_requests_id');
    }
}
