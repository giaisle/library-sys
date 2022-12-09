<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;
use Alert;

class CompanyCRUD extends Controller
{
    public function index()
    {
        $data['companies']= Company::orderBy('id','desc')->paginate(5);
        return view('companies.index',$data);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject'=> 'required',
            'title'=> 'required',
            'author'=> 'required',
            'status'=>'required'
        ]);
        $company = new Company;
        $company -> subject = $request->subject;
        $company -> title = $request->title;
        $company -> author = $request->author;
        $company -> status = $request->status;
        $company->save();
        return redirect()->route('companies.index')
            ->with('success','A book has been created successfully');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'title' => 'required',
            'author' => 'required',
            'status'=>'required'
        ]);
        $company = Company::find($id);
        $company -> subject = $request->subject;
        $company -> title = $request->title;
        $company -> author = $request->author;
        $company -> status = $request->status;
        $company->save();
        return redirect()->route('companies.index')
            ->with('info','A book has been updated successfully');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')
            ->with('delete','A book has been deleted successfully');
    }
}
