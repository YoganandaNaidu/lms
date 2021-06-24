<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Loans extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loans';

    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'ref_no',
        'loan_type_id',
        'loan_plan_id',
        'borrower_id',      
        'amount',      
        'purpose',      
        'status',      
        'date_released'      
    ];

    
    public static function getAllLoans() {
        $data = DB::table('loans')
          ->leftJoin('loan_plans', 'loan_plans.id','=', 'loans.loan_plan_id')
          ->join('loan_types', 'loan_types.id','=', 'loans.loan_type_id')
          ->select('loans.id as id',
                   'loans.ref_no',
                   'loan_plans.months as term',
                   'loan_plans.interest_percentage as interest',
                   'loan_plans.penalty_rate as penality_rate',
                   'loan_types.type as loantype',
                   'loans.amount as amount',
                   'loans.purpose as purpose',
                   'loans.status as status',
                   'loans.date_released as date_released'
                   )
          ->get();
          return $data;
    }

    public static function getLoan($id){
         
        $data = DB::table('loans')
        ->leftJoin('loan_plans', 'loan_plans.id','=', 'loans.loan_plan_id')
        ->join('loan_types', 'loan_types.id','=', 'loans.loan_type_id')
        ->select('loans.id as id',
               'loans.ref_no',
               'loan_plans.months as term',
               'loan_plans.interest_percentage as interest',
               'loan_plans.penalty_rate as penality_rate',
               'loan_types.type as loantype',
               'loan_types.description as description',
               'loans.amount as amount',
               'loans.purpose as purpose',
               'loans.status as status',
               'loans.date_released as date_released'
               )
        ->where('loans.id', '=', $id)->get();       
        return $data;
    }

    public static function getCalcInfo($id) {
        $data = DB::table('loans')
        ->leftJoin('loan_plans', 'loan_plans.id','=', 'loans.loan_plan_id')
        ->join('loan_types', 'loan_types.id','=', 'loans.loan_type_id')
        ->select('loans.id as id',
               'loans.ref_no',
               'loan_plans.months as term',
               'loan_plans.interest_percentage as interest',
               'loan_plans.penalty_rate as penality_rate',
               'loans.amount as amount',
               'loan_types.type as loantype'
               )
        ->where('loans.id', '=', $id)->get();       
        return $data;
    }
    
}
