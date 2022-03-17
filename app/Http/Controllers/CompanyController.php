<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use Storage;
use DB;
class CompanyController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = config('constant.ITEMS_PER_PAGE');
        $companies = Company::orderBy('created_at','desc')->paginate($itemsPerPage);
        return view('company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Companies DB table consists of these fields: Name (required), email, logo (minimum 100×100), website
        return view('company.create');
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
            'website' => 'required|url',
            'logo' => 'required|file|image|mimes:jpeg,png,gif,jpg|dimensions:min_width=100,min_height=100',
            'email'=>'required|email|unique:companies',
        ]);
 
        $input = $request->all();

        $file = $request->file('logo');
 
        if(isset($file) && $file != "") {
            $destinationPath = 'public';
            $fileName = time().$file->getClientOriginalName();
            $file->storeAs($destinationPath, $fileName);
            $input['logo'] = $fileName;
        }
       
        $newCompany = Company::create($input);
        if ($newCompany) {
            return redirect('/admin/company')->with('success', 'Company added Successfully.');
        } else {
            return redirect('/admin/company')->with('error', 'Oops something went wrong. Company not added');
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $company = Company::find($id);
        return view('company.view',[
            'company' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = company::find($id);
        if(isset($company) && !empty($company)) {

            return view('company.edit',compact('company'));

        } else {
            return redirect('/admin/company')->with('error','company not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required',
            'website' => 'required|url',
            'logo' => 'file|image|mimes:jpeg,png,gif,jpg|dimensions:min_width=100,min_height=100',
            'email' => 'required|email|unique:companies,email,' . $id,
        ]);
        $company = Company::find($id);
        $input = $request->all();

        if(isset($company) && !empty($company)) {
            $company->name = $input['name'];
            $company->website = $input['website'];
            $company->email = $input['email'];
           
            $file = $request->file('logo');
            $oldFile =$company->logo;
            //delete old file
            if($oldFile != "" && $request->has('logo') && Storage::disk('public')->exists($oldFile) == TRUE) {
                Storage::disk('public')->delete($oldFile);
            }    

            if($request->has('logo')){
                $destinationPath = 'public';
                $fileName = time().$file->getClientOriginalName();
                $file->storeAs($destinationPath, $fileName);
                $company->logo = $fileName;
            }

            $company->save();
            return redirect('/admin/company')->with('success','Company updated successfully.');
        } else {
            return redirect('/admin/company')->with('error','Company not found.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $company = Company::find($id);
        if(isset($company) && !empty($company)) {
            $oldFile =$company->logo;
            if( $oldFile != "" && Storage::disk('public')->exists($oldFile) == TRUE){
              Storage::disk('public')->delete($oldFile);
            }
            //child table query    
            Employee::where('company_id', $id)->update(['company_id' => null]);
            $company->delete();

            return redirect('/admin/company')->with('success','Company Deleted Successfully.');
        } else {
            return redirect('/admin/company')->with('error','Company not found.');
        }
    }
}
