<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borrowers;
use Illuminate\Support\Facades\Validator;

class BorrowersController extends Controller
{
    public function getAllBorrowers()
    {
        $borrowers = Borrowers::get()->toJson(JSON_PRETTY_PRINT);
        return response($borrowers, 200);
    }

    public function getBorrower(Request $request, $id) {

        if (Borrowers::where('id', $id)->exists()) {
          $loanPlans = Borrowers::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($loanPlans, 200);
        } else {
          return response()->json([
            "message" => "Borrowers doesn't exist."
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
        'firstname' => 'required|string|max:100',
        'middlename' => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'contact_no' => 'required|string|max:100',
        'address' => 'string|max:255',
        'email' => 'required|email|max:50',
        'tax_id' => 'string|max:50',
        'date_created' => 'required|date'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      } 
      
        $borrower = new Borrowers;
        $borrower->firstname = $request->firstname;
        $borrower->middlename = $request->middlename;
        $borrower->lastname = $request->lastname;
        $borrower->contact_no = $request->contact_no;
        $borrower->address = $request->address;
        $borrower->email = $request->email;
        $borrower->tax_id = $request->tax_id;
        $borrower->date_created = isset( $request->date_created)? $request->date_created : date('Y-m-d');
        $borrower->save();
  
        return response()->json([
          "message" => "Borrower record created"
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
        'firstname' => 'required|string|max:100',
        'middlename' => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'contact_no' => 'required|string|max:100',
        'address' => 'string|max:255',
        'email' => 'required|email|max:50',
        'tax_id' => 'string|max:50',
        'date_created' => 'required|date'
      ]);
      
      // if there are validation errors, return the message.  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);  
      } 

      if (Borrowers::where('id', $id)->exists()) {
          $borrower = Borrowers::find($id);

          $borrower->firstname = is_null($request->firstname) ? $borrower->firstname : $request->firstname;
          $borrower->middlename = is_null($request->middlename) ? $borrower->middlename : $request->middlename;
          $borrower->lastname = is_null($request->lastname) ? $borrower->lastname : $request->lastname;
          $borrower->contact_no = is_null($request->contact_no) ? $borrower->contact_no : $request->contact_no;
          $borrower->address = is_null($request->address) ? $borrower->address : $request->address;
          $borrower->email = is_null($request->email) ? $borrower->email : $request->email;
          $borrower->tax_id = is_null($request->tax_id) ? $borrower->tax_id : $request->tax_id;
          $borrower->date_created = is_null($request->date_created) ? date('Y-m-d') : $request->date_create;
          
          $borrower->save();

          return response()->json([
            "message" => "Borrower record updated successfully!.."
          ], 200);
        } else {
          return response()->json([
            "message" => "Borrower not found to update"
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
        if(Borrowers::where('id', $id)->exists()) {
            $borrower = Borrowers::find($id);
            $borrower->delete();
    
            return response()->json([
              "message" => "Borrower record deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Borrower not found to delete"
            ], 404);
          }
    }
}