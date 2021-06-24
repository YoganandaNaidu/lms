<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loans;
use Illuminate\Support\Facades\Validator;

class LoansController extends Controller
{
    public function getAllLoans()
    {
        $data = Loans::getAllLoans();
        return response($data, 200);  
    }

    public function getLoan(Request $request, $id) {

      if (Loans::where('id', $id)->exists()) {
          $data = Loans::getLoan($id);
          return response($data, 200);
      } else {
          return response()->json(["message" => "Loan doesn't exist."], 404);
        }
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      // validate incoming request        
      $validator = Validator::make($request->all(), [
        'ref_no' => 'required|string|max:50',
        'loan_type_id' => 'required|int|max:20',
        'loan_plan_id' => 'required|int|max:20',
        'borrower_id' => 'required|int|max:20',
        'amount' => 'required|digits_between:1,18',
        'status' => 'required|string|max:50',
        'purpose' => 'string|max:255'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      }

      $loan = new Loans;
      $loan->ref_no = $request->ref_no;
      $loan->loan_type_id = $request->loan_type_id;
      $loan->loan_plan_id = $request->loan_plan_id;
      $loan->borrower_id = $request->borrower_id;
      $loan->amount = $request->amount;
      $loan->purpose = $request->purpose;
      $loan->status = $request->status;
      $loan->date_released = isset( $request->date_released)? $request->date_released : date('Y-m-d');
      $loan->save();

      return response()->json([ "message" => "Loan record created" ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // validate incoming request        
      $validator = Validator::make($request->all(), [
        'ref_no' => 'required|string|max:50',
        'loan_type_id' => 'required|int|max:20',
        'loan_plan_id' => 'required|int|max:20',
        'borrower_id' => 'required|int|max:20',
        'amount' => 'required|digits_between:1,18',
        'status' => 'required|string|max:50',
        'purpose' => 'string|max:255'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      }

      if (Loans::where('id', $id)->exists()) {
          $loan = Loans::find($id);

          $loan->ref_no = is_null($request->ref_no) ? $loan->ref_no : $request->ref_no;
          $loan->loan_type_id = is_null($request->loan_type_id) ? $loan->loan_type_id : $request->loan_type_id;
          $loan->loan_plan_id = is_null($request->loan_plan_id) ? $loan->loan_plan_id : $request->loan_plan_id;
          $loan->borrower_id = is_null($request->borrower_id) ? $loan->borrower_id : $request->borrower_id;
          $loan->amount = is_null($request->amount) ? $loan->amount : $request->amount;
          $loan->purpose = is_null($request->purpose) ? $loan->purpose : $request->purpose;
          $loan->status = is_null($request->status) ? $loan->status : $request->status;
          $loan->date_released = is_null($request->date_released) ? $request->date_released: date('Y-m-d');          
          $loan->save();

          return response()->json(["message" => "Loan record updated successfully!.."], 200);
      } else {
          return response()->json(["message" => "Loan not found to update"], 404);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Loans::where('id', $id)->exists()) {
            $loan = Loans::find($id);
            $loan->delete();
    
            return response()->json([
              "message" => "Loan record deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Loan not found to delete"
            ], 404);
          }
    }

    /** 
     * loan calculation
     * @param  int  $id
     * @return \Illuminate\Http\Response 
    */
    public function calculation($id){
       $info = Loans::getCalcInfo($id); 
       $data = json_decode($info,true);
       //return $data[0];
       $amount = $data[0]['amount'];
       $interest = $data[0]['interest'];
       $months = $data[0]['term'];
       $penalty = $data[0]['penality_rate'];

       $monthly = ($amount + ($amount * ($interest/100))) / $months;
       $penalty = $monthly * ($penalty/100);

       $totalPayableAmount = number_format($monthly * $months,2);
       $monthlyPayableAmount = number_format($monthly,2);
       $penaltyAmount = number_format($penalty,2);

       $calInfo = array(
                    'id' => $id, 
                    'ref_no' => $data[0]['ref_no'],
                    'months' => $data[0]['term'],
                    'interest' => $data[0]['interest'],
                    'penality_rate' => $data[0]['penality_rate'],
                    'amount' => $data[0]['amount'],
                    'total_payable_amount' => $totalPayableAmount,
                    'monthly_payable_amount' => $monthlyPayableAmount,
                    'penalty_amount' => $penaltyAmount
                  );
       return $calInfo;
    }
}