<?php

namespace App\Http\Controllers;

use App\Model\userDetailsModel;
use App\Model\userModel;
use Illuminate\Http\Request;
use DataTables;

class mainController extends Controller
{

//    part1
    public function users(){
        $users = userModel::whereHas('nationality',function($q){
            $q->where('name','Austria');
        })->Active()->get();
        return response()->json($users->toArray());
    }

//    part2
    public function getUser(Request $request){
        if($request->ajax()){
            $data = userModel::/*whereHas('details')->*/with('details');
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('name',function($row){
                    return $row->details ? $row->details->first_name. ' ' .$row->details->last_name : 'N/A';
                })
                ->addColumn('active',function($row){
                    return $row->active ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('user-edit-add',['id' => $row->id]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('page.userList');
    }

    public function getUserAdd($id = null){
        if($id){
            $data = userModel::whereHas('details')->with('details')->findOrFail($id);
            $action = route('user-edit-add-post',['id' => $id]);
            return view('page.userListAdd',compact('data','action'));
        }
        abort(404);
    }

    public function getUserAddPost(Request $request,$id = null){
        $obj = userDetailsModel::where('user_id',$id)->first();
        $obj->first_name = $request->firstName;
        $obj->last_name = $request->lastName;
        $obj->phone_number = $request->phone;
        $obj->save();
        return redirect()->route('user-edit');

    }


//    part 3
    public function getDeleteUser(Request $request){
        if($request->ajax()){
            $data = userModel::/*whereDoesntHave('details')*/query();
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('name',function($row){
                    return $row->details ? $row->details->first_name. ' ' .$row->details->last_name : 'N/A';
                })
                ->addColumn('active',function($row){
                    return $row->active ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('user-delete-post',['id' => $row->id]).'" class="edit btn btn-primary btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('page.userDeleteList');
    }

    public function getDeleteUserPost($id = null){
        if($id){
            $data = userModel::whereDoesntHave('details')->findOrFail($id);
            $data->delete();
            return redirect(route('user-delete'));
        }
        abort(404);
    }
}
