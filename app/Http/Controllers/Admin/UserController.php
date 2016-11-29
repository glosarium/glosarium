<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\ValidationRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'ASC')
            ->paginate();

        return view('controllers.admins.users.index', compact('user'))
            ->withTitle(trans('user.index'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('controllers.admins.users.create')
            ->withTitle(trans('user.create'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        // send email to user

        // back
        return redirect()
            ->route('admin.user.edit', $user->id)
            ->withSuccess(trans('user.msg.created'));
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('controllers.admins.users.show', compact('user'))
            ->withTitle($user->name);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('controllers.admins.users.edit', compact('user'))
            ->withTitle($user->name);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationRequest $request, User $user)
    {
        $user->name = $request->name;

        return redirect()
            ->route('admin.user.edit', $user->id)
            ->withSuccess(trans('user.msg.edited'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->withSuccess(trans('user.msg.deleted'));
    }
}
