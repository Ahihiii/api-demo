<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function add(Request $request) {
        $rules = [
            'ten_sv' => 'required|string',
            'nam_sinh' => 'required|string',
            'email' => 'required|string|email|unique:student',
            'dia_chi' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'error' => $validator->errors()->toArray()
            ]);
        }
        $student = new Student([
            "ten_sv" => $request->input('ten_sv'),
            "name_sinh" => $request->input('nam_sinh'),
            "email" => $request->input('email'),
            "dia_chi" => $request->input('dia_chi')
        ]);
        $student->save();
        return response()->json([
            "status" => 'success'
        ]);
    }
}
