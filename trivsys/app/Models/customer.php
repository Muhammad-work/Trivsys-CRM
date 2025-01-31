<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_number',
        'customer_email',
        'price',
        'remarks',
        'status',
        'a_name',
        'regitr_date'
    ];

    public  $timestamps = true;

    public function user(){
       return $this->belongsTo(user::class,'a_name');
    }

        // Get sales for a specific agent with status 'sale' in a given month
        public static function getSalesByAgentAndMonth($agent_id, $month, $year)
        {
            return self::where('a_name', $agent_id)
                        ->where('status', 'sale')
                        ->whereMonth('regitr_date', $month)
                        ->whereYear('regitr_date', $year)
                        ->count();
        }

}
