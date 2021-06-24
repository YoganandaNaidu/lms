<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanTypes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loan_types';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'type',
        'description'      
    ];


}
