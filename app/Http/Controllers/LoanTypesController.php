<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoanTypes;
//Use Resources to convert into json
use App\Http\Resources\LoanTypesResouce as LoanTypesResouce;
use Illuminate\Support\Facades\Validator;

class LoanTypesController extends Controller
{
    public function getAllLoantypes()
    {
        //$loanTypes = LoanTypes::get();
        //return LoanTypesResouce::collection($loanTypes);
        $loanTypes = LoanTypes::get()->toJson(JSON_PRETTY_PRINT);
        return response($loanTypes, 200);
    }

    public function getLoanType(Request $request, $id) {

        if (LoanTypes::where('id', $id)->exists()) {
          $loanTypes = LoanTypes::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($loanTypes, 200);
        } else {
          return response()->json([
            "message" => "Loan type doesn't exist."
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
        'type' => 'required|string|max:255',
        'description' => 'string|max:255'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      }

        $loanType = new LoanTypes;
        $loanType->type = $request->type;
        $loanType->description = $request->description;
        $loanType->save();
  
        return response()->json([
          "message" => "Loan type record created"
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
        'type' => 'required|string|max:255',
        'description' => 'string|max:255'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      }


      if (LoanTypes::where('id', $id)->exists()) {
          $loanType = LoanTypes::find($id);

          $loanType->type = is_null($request->type) ? $loanType->type : $request->type;
          $loanType->description = is_null($request->description) ? $loanType->description : $request->description;
          $loanType->save();
  
          return response()->json(["message" => "records updated successfully!.."], 200);
      } else {
          return response()->json(["message" => "loan type not found to update"], 404);
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
        if(LoanTypes::where('id', $id)->exists()) {
            $loanType = LoanTypes::find($id);
            $loanType->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Loan Type not found to delete"
            ], 404);
          }
    }
}