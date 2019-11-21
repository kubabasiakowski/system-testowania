<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function admin()
    {
    	return view('admin.admin');
    }

    public function allUsers()
    {
    	$users = User::orderBy('surname', 'asc')->paginate(10);
    	return view('admin.allUsers')->with('users', $users);
    }

    public function allTests()
    {
    	return view('admin.allTests');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit')->with('user', $user);
    }

    public function searchUser(Request $request)
    {
        $searchBy = $request->searchBy;
        $searchValue = $request->search;
        if($searchBy==1)
            $users = DB::table('users')->select(DB::raw("*"))->where('surname', '=', $searchValue)->paginate(20);
        elseif($searchBy==2)
            $users = DB::table('users')->select(DB::raw("*"))->where('index_number', '=', $searchValue)->paginate(20);
        elseif($searchBy==3)
            $users = DB::table('users')->select(DB::raw("*"))->where('email', '=', $searchValue)->paginate(20);

        return view('admin.searchUser')->with('users', $users);
    }

    public function editUserStatus($id, Request $request)
    {
        $userId = $request->id;
        $user = User::findOrFail($userId);
        $status = $request->status;
        $active = $request->is_active;

        if(Auth::user()->status=='administrator' && Auth::user()->id == $userId)
        {
            Session::flash('admin_status_error', 'Nie możesz odebrać sobie praw administratora lub dezaktywować swojego konta.');
        }
        else
        {
            DB::table('users')->where('id', $userId)->update(['status' => $status, 'is_active' => $active]);
            Session::flash('user_status_changed', 'Zmiany zostały wprowadzone prawidłowo.');
        }

        
        return view('admin.edit')->with('user', $user);
    }

    public function deleteUser(Request $request)
    {   
        $userId = $request->id;
        $user = User::findOrFail($userId);
        $allUsers = User::orderBy('surname', 'asc')->paginate(10);

        if(Auth::user()->status=='administrator' && Auth::user()->id == $userId)
        {
            Session::flash('admin_delete_error', 'Nie możesz usunąć swojego konta.');
            return view('admin.edit')->with('user', $user);
        }
        else
        {
            DB::table('users')->where('id', $userId)->delete();
            Session::flash('user_deleted', 'Użytkownik został usunięty.');
            return redirect('/allUsers')->with('users', $allUsers);
        }
    }
}
