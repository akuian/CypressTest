<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $student = DB::table('student')->paginate(3);
        $paginate = Student::orderBy('id_student','asc')->paginate(3);
        return view('student.index', ['student'=>$student],['paginate'=>$paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    public function search(Request $request){
        $search = $request->search;
        $student = Student::where('name','like','%'.$search.'%')->paginate();
        return view('student.index', ['student' => $student]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Name'=> 'required',
            'Class'=> 'required',
            'Major' => 'required',
            'Address' => 'required',
            'date_of_birth' => 'required'
        ]);

        //eloquent function to add data
        Student::create($request->all());

        //if the date is added succesfully, returned to the main page
        return redirect()->route('student.index')
        ->with('success','Student Succesfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //displays detailed data by finding/ by Student Nim
        $Student = Student::where('nim',$nim)->first();
        return view('student.detail', compact('Student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //displays detail data by finding on Student nim
        $Student = Student::where('nim',$nim)->first();
        return view('student.edit', compact('Student'));
        return redirect()->route('student.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //validate the data
        $request->validate([
            'Nim' => 'required',
            'Name'=> 'required',
            'Class'=> 'required',
            'Major'=> 'required',
            'Address' => 'required',
            'date_of_birth' => 'required'
        ]);

        //Eloquent function to update the data
        Student::where('nim',$nim)
        ->update([
            'nim'=>$request->Nim,
            'name'=>$request->Name,
            'class'=>$request->Class,
            'major'=>$request->Major,
            'address'=>$request->Address,
            'date_of_birth'=>$request->date_of_birth
        ]);
        return redirect()->route('student.index')
        ->with('success', 'Student Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //Eloquent function to delete the data
        Student::where('nim',$nim)->delete();
        return redirect()->route('student.index')
        -> with('success'.'Student Successfully Deleted');
    }
}
