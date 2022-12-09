<?php

namespace App\Http\Controllers;
use App\Models\issueModel;
use Illuminate\Http\Request;
use Alert;

class issueCRUD extends Controller
{
    public function index()
    {
        $data['issue_models']= issueModel::orderBy('id','desc')->paginate(5);
        return view('issue_models.index',$data);
    }

    public function create()
    {
        return view('issue_models.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patron'=> 'required',
            'book_title'=> 'required',
            'issue_date'=> 'required',
            'return_date'=> 'required',
            'status'=> 'required',
        ]);
        $issue_model = new issueModel;
        $issue_model -> patron = $request->patron;
        $issue_model -> book_title = $request->book_title;
        $issue_model -> issue_date = $request->issue_date;
        $issue_model -> return_date = $request->return_date;
        $issue_model -> status= $request->status;
        $issue_model->save();
        return redirect()->route('issue_models.index')
            ->with('success','A book has been issued successfully');
    }

    public function show(issueModel $issue_model)
    {
        return view('issue_models.show', compact('issue_model'));
    }

    public function edit(issueModel $issue_model)
    {
        return view('issue_models.edit', compact('issue_model'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patron'=> 'required',
            'book_title'=> 'required',
            'issue_date'=> 'required',
            'return_date'=> 'required',
            'status'=> 'required',
        ]);
        $issue_model = issueModel::find($id);
        $issue_model -> patron = $request->patron;
        $issue_model -> book_title = $request->book_title;
        $issue_model -> issue_date = $request->issue_date;
        $issue_model -> return_date = $request->return_date;
        $issue_model -> status= $request->status;
        $issue_model->save();
        return redirect()->route('issue_models.index')
            ->with('info','An issue has been updated successfully');
    }

    public function destroy(issueModel $issue_model)
    {
        $issue_model->delete();
        return redirect()->route('issue_models.index')
            ->with('delete','An issue has been deleted successfully');
    }
}
