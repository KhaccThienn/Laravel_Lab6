<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SinhVienController extends Controller
{
    public function index(Request $req)
    {
        $query = DB::table('sinh_vien')
            ->join('lop_hoc', 'sinh_vien.class_id', '=', 'lop_hoc.id')
            ->select('sinh_vien.*', 'lop_hoc.name AS className');
        $students = $query->paginate(4);
        if ($req->search) {
            $query = $query->where('sinh_vien.name', 'LIKE', "%$req->search%");
            $totalStudents = $query->count();
            $students = $query->paginate($totalStudents);
        }

        $totalStudents = $query->count();
        return view('student.index', compact('students', 'totalStudents'));
    }

    public function add()
    {
        $classes = DB::table('lop_hoc')->get();
        return view('student.add', compact('classes'));
    }

    public function edit($id)
    {
        $classes = DB::table('lop_hoc')->get();
        $student = DB::table('sinh_vien')->find($id);
        return view('student.edit', compact('classes', 'student'));
    }

    public function update(Request $req, $id)
    {
        $rules = [
            'name' => 'required|min:6|max:100',
            'email' => 'required|min:15|max:100|email',
            'password' => 'required|min:8|max:20',
            'phone' => 'required|min:10|max:50'
        ];

        $message = [
            'name.required' => "Name Is Required",
            'name.min' => "At Least 6 Characters",
            'name.max' => "At Max 100 Characters",
            'email.required' => "Email Is Required",
            'email.min' => "At Least 15 Characters",
            'email.max' => "At Max 100 Characters",
            'email.email' => "Invalid Email Address",
            'password.required' => "Password Is Required",
            'password.min' => "At Least 8 Characters",
            'password.max' => "At Max 20 Characters",
            'phone.required' => "Phone Number Is Required",
            'phone.min' => "At Least 10 Characters",
            'phone.max' => "At Max 50 Characters",
        ];

        $req->validate($rules, $message);

        DB::table('sinh_vien')->where('id', $id)->update($req->only('name', 'email', 'password', 'phone', 'address', 'class_id'));
        return redirect()->route('student.index')->with('success', 'Update Student Successfully');
    }

    public function delete($id)
    {
        DB::table('sinh_vien')->delete($id);
        return redirect()->route('student.index')->with('success', 'Delete Student Successfully');
    }

    public function store(Request $req)
    {
        $rules = [
            'name' => 'required|min:6|max:100',
            'email' => 'required|min:15|max:100|unique:sinh_vien|email',
            'password' => 'required|min:8|max:20',
            'phone' => 'required|min:10|max:50|unique:sinh_vien'
        ];

        $message = [
            'name.required' => "Name Is Required",
            'name.min' => "At Least 6 Characters",
            'name.max' => "At Max 100 Characters",
            'email.required' => "Email Is Required",
            'email.min' => "At Least 15 Characters",
            'email.max' => "At Max 100 Characters",
            'email.unique' => "This Email is Already Taken",
            'email.email' => "Invalid Email Address",
            'password.required' => "Password Is Required",
            'password.min' => "At Least 8 Characters",
            'password.max' => "At Max 20 Characters",
            'phone.required' => "Phone Number Is Required",
            'phone.min' => "At Least 10 Characters",
            'phone.max' => "At Max 50 Characters",
            'phone.unique' => "This Phone Number is Already Taken",
        ];

        $req->validate($rules, $message);

        DB::table('sinh_vien')->insert($req->only('name', 'email', 'password', 'phone', 'address', 'class_id'));
        return redirect()->route('student.index')->with('success', 'Insert Student Successfully');
    }
}
