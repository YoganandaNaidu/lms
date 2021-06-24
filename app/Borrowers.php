<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrowers extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'borrowers';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'firstname',
        'middlename',
        'lastname',
        'contact_no',      
        'address',      
        'email_id',      
        'tax_id',      
        'date_created'      
    ];


}
