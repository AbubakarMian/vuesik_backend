<?php

namespace App\Models\payout;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payout extends Model
{
    use SoftDeletes;
    protected $table="payouts";
}
