<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanPlans extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loan_plans';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'months',
        'interest_percentage',
        'penalty_rate'      
    ];


}
