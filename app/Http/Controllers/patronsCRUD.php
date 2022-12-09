<?php

namespace App\Http\Controllers;
use App\Models\patronsModel;
use Illuminate\Http\Request;
use Alert;

class patronsCRUD extends Controller
{
    public function index()
    {
        $data['patrons_models']= patronsModel::orderBy('id','desc')->paginate(5);
        return view('patrons_models.index',$data);
    }

    public function create()
    {
        return view('patrons_models.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'address'=> 'required',
            'expiration_date'=> 'required',
            'status'=> 'required',
        ]);
        $patrons_model = new patronsModel;
        $patrons_model -> name = $request->name;
        $patrons_model -> email = $request->email;
        $patrons_model -> address = $request->address;
        $patrons_model -> expiration_date = $request->expiration_date;
        $patrons_model -> status= $request->status;
        $patrons_model->save();
        return redirect()->route('patrons_models.index')
            ->with('success','A new patron has been created successfully');
    }

    public function show(patronsModel $patrons_model)
    {
        return view('patrons_models.show', compact('patrons_model'));
    }

    public function edit(patronsModel $patrons_model)
    {
        return view('patrons_models.edit', compact('patrons_model'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'address'=> 'required',
            'expiration_date'=> 'required',
            'status'=> 'required',
        ]);
        $patrons_model = patronsModel::find($id);
        $patrons_model -> name = $request->name;
        $patrons_model -> email = $request->email;
        $patrons_model -> address = $request->address;
        $patrons_model -> expiration_date = $request->expiration_date;
        $patrons_model -> status= $request->status;
        $patrons_model->save();
        return redirect()->route('patrons_models.index')
            ->with('info','Information has been updated successfully');
    }

    public function destroy(patronsModel $patrons_model)
    {
        $patrons_model->delete();
        return redirect()->route('patrons_models.index')
            ->with('delete','A patron has been deleted successfully');
    }
}
