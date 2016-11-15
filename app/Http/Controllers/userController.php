<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\tambahuserform;

use App\User;
use Yajra\Datatables\Datatables;
use Validator;
use Hash;
use URL;
use Form;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get(array('_id','username','email','created_at'));
        return view('user-table');
    }

    public function getUser(){
        $user = User::get(array('_id','username','email','created_at'));

        return Datatables::of($user)
        ->addColumn('action', function ($user) {
                $button = '<div class="btn-group-vertical">
                                 <a class="btn btn-warning btn-xs" href="'. URL::to('user/' . $user->_id . '/edit'). '"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                '.  Form::open(array('url' => 'user/' .$user->id . '', "class" => "pull-right")) .
                                ''. Form::hidden("_method", "DELETE") .
                                ''. Form::submit("Delete", array("class" => "btn btn-danger btn-xs btn-delete")) .
                                ''. Form::close() .
                                '</div>';
                return $button;
        })
        ->remove_column('_id')
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'jenis' => 'required|max:255',
        ]);

        $user = new User;
        $user->name = $_POST['name'];
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = Hash::make($_POST['password']);
        $user->jenis = $_POST['jenis'];
        $user->save();

        flash('Data Berhasil Ditambahkan !', 'success');
        return redirect('/user');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user-show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user-create')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'min:6|confirmed',
            'jenis' => 'required|max:255',
        ]);

        $user = User::find($id);
        $user->name = $_POST['name'];
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        if (isset($_POST['password'])) {
            $user->password = Hash::make($_POST['password']);
        }
        $user->jenis = $_POST['jenis'];
        $user->save();

        flash('Data Berhasil Diubah !', 'success');
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        flash('Data Berhasil Dihapus !', 'success');
        return redirect('/user');
    }
}
