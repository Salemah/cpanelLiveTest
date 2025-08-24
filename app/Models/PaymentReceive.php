<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentReceive extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public function appointment()
    {

        return $this->belongsTo(Appointment::class);
    }
}
