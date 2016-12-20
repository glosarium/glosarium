<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request\UserRequest;
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
            ->when(request('query'), function ($query) {
                return $query->where('name', 'like', '%' . request('query') . '%')
                    ->orWhere('email', 'like', '%' . request('query') . '%');
            })
            ->paginate();

        $title = request('query') ? trans('user.searchFor', ['keyword' => request('query')]) : trans('user.index');

        return view('admin.users.index', compact('users'))
            ->withTitle($title);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
    }

    /**
     * Update the specified column and value user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateable()
    {
        $user = User::find(request('pk'));
        if (empty($user)) {
            return [
                'isSuccess' => false,
                'message' => trans('user.notFound')
            ];
        }

        $field = request('name');
        $user->$field = request('value');
        $user->save();

        return [
            'isSuccess' => true,
            'message' => trans('user.msg.updateable', [
                'field' => $field,
                'value' => request('value')
            ]),
            'data' => [
                'id' => $user->id,
                'updated' => \Carbon\Carbon::parse($user->updated_at)->format(config('backpack.base.default_datetime_format'))
            ]
        ];

    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
