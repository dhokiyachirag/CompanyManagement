<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;
class EmployeeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = config('constant.ITEMS_PER_PAGE');
        $employees = Employee::orderBy('created_at','desc')->paginate($itemsPerPage);
        $companies = Company::pluck('name', 'id');
        return view('employee.index',compact('employees','companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::pluck('name', 'id');
        $companies[0]=($companies->count())? "Please select company":"Please add company first";
        return view('employee.create',compact('companies'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email'=>'required|email|unique:employees',
        ]);
 
        $input = $request->all();
        $newCompany = Employee::create($input);
        if ($newCompany) {
            return redirect()->route('employee.index')->with('success', 'Employee added Successfully.');
        } else {
            return redirect()->route('employee.index')->with('error', 'Oops something went wrong. Employee not added');
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        
        $employee = Employee::find($id);
        $company = Company::pluck('name', 'id');
        return view('employee.view',[
            'employee' => $employee,
            'company' =>$company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = employee::find($id);
        $companies = Company::pluck('name', 'id');
        $companies[0]=($companies->count())? "Please select company":"Please add company first";
        if(isset($employee) && !empty($employee)) {
            return view('employee.edit',compact('employee','companies'));
        } else {
            return redirect('/admin/employee')->with('error','employee not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|unique:employees,email,' . $id,
        ]);
        
        $employee = Employee::find($id);
        
        $input = $request->all();

        if(isset($employee) && !empty($employee)) {
            $employee->first_name = $input['first_name'];
            $employee->last_name = $input['last_name'];
            $employee->phone = $input['phone'];
            $employee->email = $input['email'];
            $employee->company_id = $input['company_id'];
            $employee->save();
            return redirect()->route('employee.index')->with('success','Employee updated successfully.');
        } else {
            return redirect()->route('employee.index')->with('error','Employee not found.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if(isset($employee) && !empty($employee)) {
            $employee->delete();
            return redirect()->route('employee.index')->with('success','Employee Deleted Successfully.');
        } else {
            return redirect()->route('employee.index')->with('error','Employee not found.');
        }
    }
}
