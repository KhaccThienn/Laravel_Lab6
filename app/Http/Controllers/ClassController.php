<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function index(Request $req)
    {
        $query = DB::table('lop_hoc')
        ->select('lop_hoc.id', 'lop_hoc.name', 'lop_hoc.status', DB::raw("CASE WHEN lop_hoc.status = 1 THEN 'Online' ELSE 'Offline' END AS ClassStatus"), DB::raw("COUNT(sinh_vien.class_id) AS total"))
        ->leftJoin('sinh_vien', 'lop_hoc.id', '=', 'sinh_vien.class_id')
        ->groupBy('lop_hoc.id', 'lop_hoc.name', 'lop_hoc.status');
        
        $classes = $query->paginate(3);
        
        if ($req->search) {
            $query = $query->where('lop_hoc.name', 'LIKE', "%$req->search%");
            $totalClasses = $query->count('lop_hoc.*');
            $classes = $query->paginate($totalClasses);
        }
        $totalClasses = $query->get()->count();
        return view('class.index', compact('classes', 'totalClasses'));
    }

    public function add()
    {
        return view('class.add');
    }

    public function edit($id)
    {
        $class = DB::table('lop_hoc')->where('id', $id)->get()->first();
        return view('class.update', compact('class'));
    }

    public function update(Request $req, $id)
    {
        $rules = [
            'name' => 'required|min:4|max:30'
        ];
        $message = [
            'name.required' => "Name is Required",
            'name.min' => "At least 4 characters",
            'name.max' => "At max 30 characters"
        ];

        $req->validate($rules, $message);
        DB::table('lop_hoc')->where('id', $id)->update([
            'name' => $req->name,
            'status' => $req->status,
        ]);

        return redirect()->route('class.index')->with('success', "Update $req->name Successfully");
    }

    public function delete($id)
    {
        DB::table('lop_hoc')->delete($id);
        return redirect()->route('class.index')->with('success', "Delete Successfully");
    }


    public function store(Request $req)
    {
        $rules = [
            'name' => 'required|unique:lop_hoc|min:4|max:30'
        ];
        $message = [
            'name.required' => "Name is Required",
            'name.unique' => "This name is already taken",
            'name.min' => "At least 4 characters",
            'name.max' => "At max 30 characters"
        ];

        $req->validate($rules, $message);
        DB::table('lop_hoc')->insert([
            'name' => $req->name,
            'status' => $req->status,
        ]);

        return redirect()->route('class.index')->with('success', "Insert Successfully");
    }
}