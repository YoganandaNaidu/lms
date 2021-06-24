<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoanPlans;
use Illuminate\Support\Facades\Validator;

class LoanPlansController extends Controller
{
    public function getAllLoanPlantypes()
    {
        $loanPlans = LoanPlans::get()->toJson(JSON_PRETTY_PRINT);
        return response($loanPlans, 200);
    }

    public function getLoanPlanType(Request $request, $id) {

        if (LoanPlans::where('id', $id)->exists()) {
          $loanPlans = LoanPlans::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($loanPlans, 200);
        } else {
          return response()->json([
            "message" => "Loan plan doesn't exist."
          ], 404);
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
        'months' => 'required|int',
        'interest_percentage' => 'required|int',
        'penalty_rate' => 'required|int'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      }
            
      $loanPlans = new LoanPlans;
      $loanPlans->months = $request->months;
      $loanPlans->interest_percentage = $request->interest_percentage;
      $loanPlans->penalty_rate = $request->penalty_rate;
      $loanPlans->save();

      return response()->json([
        "message" => "Loan plan record created"
      ], 201);
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
        'months' => 'required|int',
        'interest_percentage' => 'required|int',
        'penalty_rate' => 'required|int'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      }

      if (LoanPlans::where('id', $id)->exists()) {
          $loanPlans = LoanPlans::find($id);

          $loanPlans->months = is_null($request->months) ? $loanPlans->months : $request->months;
          $loanPlans->interest_percentage = is_null($request->interest_percentage) ? $loanPlans->interest_percentage : $request->interest_percentage;
          $loanPlans->penalty_rate = is_null($request->penalty_rate) ? $loanPlans->penalty_rate : $request->penalty_rate;

          $loanPlans->save();
  
          return response()->json([
            "message" => "Loan plan records updated successfully!.."
          ], 200);
        } else {
          return response()->json([
            "message" => "Loan plan not found to update"
          ], 404);
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
        if(LoanPlans::where('id', $id)->exists()) {
            $loanPlans = LoanPlans::find($id);
            $loanPlans->delete();
    
            return response()->json([
              "message" => "Loan plan record deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Loan plan not found to delete"
            ], 404);
          }
    }
}