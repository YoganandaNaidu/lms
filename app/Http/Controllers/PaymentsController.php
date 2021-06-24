<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payments;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    public function getAllPayments()
    {
        $data = Payments::getAllPayments();
        return response($data, 200);
    }

    public function getPayment(Request $request, $id) {

      if (Payments::where('id', $id)->exists()) {
          $data = Payments::getPayment($id);
          return response($data, 200);
      } else {
          return response()->json(["message" => "Payment doesn't exist."], 404);
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
        'loan_id' => 'required|integer',
        'payee' => 'required|string|max:100',
        'amount' => 'required|digits_between:1,18',
        'penalty_amount' => 'required|digits_between:1,18',
        'description' => 'string|max:255',
        'paid_date' => 'required|date'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      } 
      
      $payment = new Payments;
      $payment->loan_id = $request->loan_id;
      $payment->payee = $request->payee;
      $payment->amount = $request->amount;
      $payment->penalty_amount = $request->penalty_amount;
      $payment->description = $request->description;
      $payment->paid_date = isset( $request->paid_date)? $request->paid_date : date('Y-m-d');
      $payment->save();

      return response()->json([
        "message" => "Payment record created"
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
        'loan_id' => 'required|integer',
        'payee' => 'required|string|max:100',
        'amount' => 'required|digits_between:1,18',
        'penalty_amount' => 'required|digits_between:1,18',
        'description' => 'string|max:255',
        'paid_date' => 'required|date'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      }
      

        if (Payments::where('id', $id)->exists()) {
            $loan = Payments::find($id);

            $loan->loan_id = is_null($request->loan_id) ? $loan->loan_id : $request->loan_id;
            $loan->payee = is_null($request->payee) ? $loan->payee : $request->payee;
            $loan->amount = is_null($request->amount) ? $loan->amount : $request->amount;
            $loan->penalty_amount = is_null($request->penalty_amount) ? $loan->penalty_amount : $request->penalty_amount;
            $loan->description = $request->description;
            $loan->paid_date = isset( $request->paid_date)? $request->paid_date : date('Y-m-d');
        
            $loan->save();
    
            return response()->json([
              "message" => "Payments record updated successfully!.."
            ], 200);
          } else {
            return response()->json([
              "message" => "Payments not found to update"
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
        if(Payments::where('id', $id)->exists()) {
            $loan = Payments::find($id);
            $loan->delete();
    
            return response()->json([
              "message" => "Payments record deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Payments not found to delete"
            ], 404);
          }
    }

}