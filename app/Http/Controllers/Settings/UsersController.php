<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.users.index', [
            'users' => User::orderBy('deactivated_at', 'asc')
                           ->orderBy('name', 'asc')
                           ->with([
                               'roles',
                           ])
                           ->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'username' => [
                'required',
                'max:255',
                Rule::unique('users'),

            ],
            'email'    => [
                'required',
                'max:255',
                Rule::unique('users'),
            ],
            'password' => [
                'bail',
                'required',
                'confirmed',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
            ],
            'active'   => 'required',
            'roles'    => [
                'required',
                'min:1',
            ],
        ]);

        $user = User::create(
            $request->only([
                'name',
                'username',
                'email',
                'password',
                'active',
            ])
        );

        $user->syncRoles($request->get('roles'));

        flash('User Created!')->success();

        return redirect()->route('settings.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('settings.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User    $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'username' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($user->id),

            ],
            'email'    => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => [
                'nullable',
                'bail',
                'confirmed',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
            ],
            'active'   => 'required',
            'roles'    => [
                'required',
                'min:1',
            ],
        ]);

        $user->update(
            $request->only([
                'name',
                'username',
                'email',
                'password',
                'active',
            ])
        );

        $user->syncRoles($request->get('roles'));

        flash('User Updated!')->success();

        return redirect()->route('settings.users.index');
    }
}
