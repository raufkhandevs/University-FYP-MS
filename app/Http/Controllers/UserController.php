<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleNames = Role::whereNotIn('name', [Role::ROLE_STUDENT])->get()->pluck('name');
        $users = User::role($roleNames)->get();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', [
            'roles' => Role::whereNotIn('name', [Role::ROLE_STUDENT])->get(),
            'departments' => Department::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create_users');

        $avatarName = '';
        $password = Hash::make('password'); // generate a random string password

        try {
            if ($request->has('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();

                $avatar->move(public_path('assets/images/avatar/'), $avatarName);
            }

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'phone' => $request->phone,
                'lang' => 'en',
                'gender' => $request->gender,
                'avatar' => $avatarName,
                'state' => $request->state,
                'city' => $request->city,
                'country' => $request->country,
            ]);

            $department = Faculty::create([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'designation' => $request->designation,
            ]);

            $role = Role::find($request->role_id);
            $user->assignRole($role->name);

            DB::commit();

            if ($user) {
                return redirect()->route('faculty.users.index')
                    ->with('success_message', 'User created successfully');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()
                ->with('error_message', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('users.edit', [
            'user' => User::find($id),
            'roles' => Role::whereNotIn('name', [Role::ROLE_STUDENT])->get(),
            'departments' => Department::all(),
        ]);
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
        try {
            $avatarName = '';
            if ($request->has('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();

                $avatar->move(public_path('assets/images/avatar/'), $avatarName);
            }

            DB::beginTransaction();

            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'lang' => 'en',
                'gender' => $request->gender,
                'avatar' => $avatarName,
                'state' => $request->state,
                'city' => $request->city,
                'country' => $request->country,
            ]);

            $faculty = Faculty::where('user_id', $user->id)->first();
            $faculty->update([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'designation' => $request->designation,
            ]);

            $role = Role::find($request->role_id);
            $user->assignRole($role->name);

            DB::commit();

            if ($user) {
                return redirect()->route('faculty.users.index')
                    ->with('success_message', 'User updated successfully');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()
                ->with('error_message', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back()
            ->with('warning_message', 'Coming Soon');
    }
}
