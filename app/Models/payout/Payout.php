<?php

namespace App\Models\payout;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use SoftDeletes;
    protected $table="payouts";
}
