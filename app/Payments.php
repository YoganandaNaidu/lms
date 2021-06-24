<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'loan_id',
        'payee',
        'amount',
        'penalty_amount',      
        'paid_date',      
        'description'     
    ];
    
    public static function getAllPayments() {
        $data = DB::table('payments')
          ->leftJoin('loans', 'loans.id','=', 'payments.loan_id')
          ->select('payments.id as payment_id',
                   'payments.loan_id as payment_loan_id',         
                   'payments.payee as paid_person_name',
                   'payments.amount as paid_amount',
                   'payments.penalty_amount as penalty_paid_amount',
                   'payments.paid_date as paid_date',
                   'payments.description as description',
                   'loans.id as loan_id',
                   'loans.ref_no as ref_no',
                   'loans.amount as amount',
                   'loans.purpose as purpose',
                   'loans.status as status',
                   'loans.date_released as date_released'
                   )
          ->get();
          return $data;
    }

    public static function getPayment($id){
        
        $data = DB::table('payments')
          ->leftJoin('loans', 'loans.id','=', 'payments.loan_id')
          ->select('payments.id as payment_id',
                   'payments.loan_id as payment_loan_id',         
                   'payments.payee as paid_person_name',
                   'payments.amount as paid_amount',
                   'payments.penalty_amount as penalty_paid_amount',
                   'payments.paid_date as paid_date',
                   'payments.description as description',
                   'loans.id as loan_id',
                   'loans.ref_no as ref_no',
                   'loans.amount as amount',
                   'loans.purpose as purpose',
                   'loans.status as status',
                   'loans.date_released as date_released'
                   )->where('payments.id', '=', $id)->get();

          return $data;
    }
}