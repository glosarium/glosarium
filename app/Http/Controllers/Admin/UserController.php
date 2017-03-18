<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('show', User::class)) {
            abort(403, trans('user.notAuthorized'));
        }

        $users = User::orderBy('name')
            ->withCount('glosariums')
            ->filter()
            ->paginate();

        if (request('keyword')) {
            $users->appends(request()->all());
        }

        return view('admin.user.index', compact('users'))
            ->withTitle(trans('user.index'));
    }

    public function history()
    {
        $users = User::onlyTrashed()
            ->orderBy('name', 'ASC')
            ->filter()
            ->paginate();

        if (request('keyword')) {
            $users->appends(request()->all());
        }

        return view('admin.user.history', compact('users'))
            ->withTitle(trans('user.history'));
    }

    public function restore($id)
    {
        $user = User::whereId($id)
            ->onlyTrashed()
            ->restore();

        return redirect()->back()
            ->with('success', trans('user.msg.restored'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'))
            ->withTitle(trans('user.edit', ['name' => $user->name]));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name      = $request->name;
        $user->is_active = $request->active;
        $user->type      = $request->type;
        $user->save();

        return redirect()->back()
            ->with('success', trans('user.msg.updated'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();

        return redirect()->route('admin.user.index')
            ->with('success', trans('user.msg.deleted'));
    }
}
