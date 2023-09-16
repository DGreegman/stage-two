<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    public function index(){

        $persons = Person::all();

        if ($persons->count() > 0) {
            
            return response()->json([
                'status' => 200,
                'persons' => $persons
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Records Found"
            ], 404);
        }
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        }else{
            $person = Person::create([
                'name' => $request->name
            ]);

            if ($person) {
                return response()->json([
                    'status' => 200,
                    'message' => "Person Added Sucessfully",
                    'user_id' => $person->id
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong"
                ], 500);
            }
            
        }

    }

    public function show($id){
            
       $person = Person::find($id);

        if ($person) {
            return response()->json([
                'status' => 200,
                'message' => $person
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Person Not Exists"
            ], 404);
        }
        
    }

    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        }else{
            
            $person = Person::find($id);

            if ($person) {

                $person->update([
                    'name' => $request->name
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Person Updated Sucessfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No Such Person Found"
                ], 404);
            }
            
        }

    }

    public function destroy($id){
        $person = Person::find($id);
        
        if ($person) {
            $person->delete();
            return response()->json([
                'status' => 200,
                'message' => "Person Deleted Successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Such Person Found"
            ], 404);
        }
        

    }
}
