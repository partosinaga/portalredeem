<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Client;
use App\Roles;
use DB;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumb = [
            'Home' => route('home'),
            'User Management' => route('users.index'),
            'List' => '#'
        ];
        $data = DB::table('vw_users')->get();
        return view('users.index', compact('breadcrumb'));
    }


    public function userDatatable(Request $request)
    {
        $data = DB::table('vw_users')
            ->orderBy('id', 'DESC')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<td class="dt-left dtr-control">'.
                    '<label class="checkbox checkbox-single">'.
                        '<input type="checkbox" value="'.$data->id.'" id="'.$data->id.'" class="checkable">'.
                        '<span></span>'.
                    '</label></td>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = [
            'Home' => route('home'),
            'User Management' => route('users.index'),
            'List' => route('users.index'),
            'Create' => '#'
        ];
        $footer = [
            'assets/js/pages/crud/file-upload/image-input.js'
        ];
        if (\Auth::user()->account_type == 'client') {
            $client = Client::where('client_id', \Auth::user()->client_id)->get();
        }else {
            $client = Client::get();
        }

        $roles = Roles::get();
        return view('users.create', compact('footer', 'client', 'roles', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $isEmailExist = User::where('email', $request->email)->first();
        if($isEmailExist)
        {
            return redirect()->route('users.index')->with(['message' => 'User with email '.$request->email.' already exist.', 'type' => 'danger']);
        }

        $isPhoneExist = User::where('phone', $request->phone)->first();
        if($isPhoneExist)
        {
            return redirect()->route('users.index')->with(['message' => 'User with phone '.$request->phone.' already exist.', 'type' => 'danger']);
        }

        $user = new User;
        
        if($request->profile_pict)
        {
           
            $file = $request->file('profile_pict');
            $PATH = 'assets/images/users';
            $newName = Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move($PATH, $newName);
            $user->user_image = $newName;

        }

        $password = Str::random(10);
        $user->salutation = $request->salutation;
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->account_type = $request->user_type;
        $user->roles_id = $request->role_id;
        $user->password = Hash::make($password);
        $user->client_id = $request->client_id;
        $user->phone = $request->phone;
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->sands = $password;
        $user->save();

        if($user)
        {
            sendEmailViaSandezaPrimaryBackup($request->email, $request->phone, $password );
        }
        return redirect()->route('users.index')->with(['message' => 'Success add new user, password activation sent to '.$request->email.' ', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'User Management' => route('users.index'),
            'List' => route('users.index'),
            'Edit' => '#'
        ];
        $user = User::where('id', $id)->first();
        if(!$user)
        {
            return redirect()->route('users.index')->with(['message' => 'User not found, please select another', 'type' => 'warning']);
        }

        $footer = [
            'assets/js/pages/crud/file-upload/image-input.js'
        ];
        if (\Auth::user()->account_type == 'client') {
            $client = Client::where('client_id', \Auth::user()->client_id)->get();
        }else {
            $client = Client::get();
        }
        $roles = Roles::get();
        $user = User::where('id', $id)->first();
        return view('users.create', compact('footer', 'client', 'roles', 'user', 'breadcrumb'));
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
        $user = User::where('id', $id)->first();
        if(!$user)
        {
            return redirect()->route('users.index')->with(['message' => 'User not found, please select another data', 'type' => 'warning']);
        }
        if($request->profile_pict)
        {
            $file = $request->file('profile_pict');
            $PATH = 'assets/images/users';
            $newName = Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move($PATH, $newName);
            $user->user_image = $newName;
        }
        $user->salutation = $request->salutation;
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->account_type = $request->user_type;
        $user->roles_id = $request->role_id;
        $user->client_id = $request->client_id;
        $user->phone = $request->phone;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();

        

        return redirect()->route('users.index')->with(['message' => 'Success update user', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            User::where('id', $id)->delete();
            DB::commit();
            return response()->json(200);
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function changePassword()
    {
        return view('users.change_password');
    }
    
    public function changePasswordStore(Request $request)
    {
        if(Hash::check($request->old, \Auth::user()->password))
        {
            if($request->new == $request->new_conf)
            {
                $user = User::where('password', \Auth::user()->password)->first();
                $user->password = Hash::make($request->new);
                $user->sands = $request->new;
                $user->save();
                return redirect()->route('users.change.password')->with(['message' => 'Success update password, please re-login to access your account ', 'type' => 'success']);
            }else{
                return redirect()->route('users.change.password')->with(['message' => 'Invalid Password confirmation', 'type' => 'danger']);
            }
        }

        return redirect()->route('users.change.password')->with(['message' => 'Old password wrong','type' => 'danger']);
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user)
        {
            return redirect('/login')->with(['message' => 'Email not found','type' => 'danger']);
        }
        $password = Str::random(10);
        $user->password = Hash::make($password);
        $user->sands = $password;
        $user->save();
        if($user)
        {
            sendEmailViaSandeza($request->email, $password, '[Prezent - Portal Redeem] Reset Password');
            return redirect('/login')->with(['message' => 'New password sent to '.$request->email.' ','type' => 'success']);
        }
    }
}
