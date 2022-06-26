<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CreateUserController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    /**
     * Generate a random string with the length defined as the argument (default to 10)
     *
     * @param $length
     * @return false|string
     */
    private function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('admin', 0)->paginate(5);

        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $password = $this->generateRandomString();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password)
        ]);

        $user_send = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password
        ];

        $message = 'User '.$user->name. ' created successfully!';

        Mail::to(env('MAIL_USERNAME'))->send(new ResetPassword("create", $user_send));

        return redirect()->route('admin.index')->with('message', $message);
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
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        $user->update($request->only('name', 'email'));

        $message = 'User '. $user->name . ' updated successfully!';

        return redirect()->route('admin.index')->with('message', $message);
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

        $temp = $user->name;

        $user->delete();

        $message = 'User '.$temp. ' deleted successfully!';

        return redirect()->route('admin.index')->with('message', $message);
    }
}
