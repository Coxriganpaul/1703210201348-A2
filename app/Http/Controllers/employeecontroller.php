<?php
  
namespace App\Http\Controllers;
  
use App\employee;
use Illuminate\Http\Request;
  
class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = employee::latest()->paginate(5);
  
        return view('employees.index',compact('employee'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
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
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'department' => 'required',
            
        ]);
  
        employee::create($request->all());
   
        return redirect()->route('employees.index')
                        ->with('success','employee created successfully.');
    }
   
    
     
    public function show(employee $employee)
    {
        return view('employees.show',compact('employee'));
    }
   
    
    public function edit(employee $employee)
    {
        return view('employees.edit',compact('employee'));
    }
  
   
    public function update(Request $request, employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'department' => 'required',
            
            
        ]);
  
        $employee->update($request->all());
  
        return redirect()->route('employees.index')
                        ->with('success','employee updated successfully');
    }
  
    
    public function destroy(employee $employee)
    {
        $employee->delete();
  
        return redirect()->route('employees.index')
                        ->with('success','employee deleted successfully');
    }
}