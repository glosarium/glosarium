<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth::user()->can('show', User::class), 403, trans('global.http.403'));

        $users = User::orderBy('name')
            ->withCount('glosariumWords')
            ->filter()
            ->paginate();

        if (request('keyword')) {
            $users->appends(request()->all());
        }

        return view('admin.user.index', compact('users'))
            ->withTitle(trans('user.index'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        abort_if(!Auth::user()->can('history', User::class), 403, trans('global.http.403'));

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
        abort_if(!Auth::user()->can('restore', User::class), 403, trans('global.http.403'));

        $user = User::whereId($id)
            ->onlyTrashed()
            ->restore();

        return redirect()->back()
            ->with('success', trans('user.msg.restored'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        abort_if(!Auth::user()->can('edit', $user), 403, trans('global.http.403'));

        return view('admin.user.edit', compact('user'))
            ->withTitle(trans('user.edit', ['name' => $user->name]));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        abort_if(!Auth::user()->can('edit', $user), 403, trans('global.http.403'));

        $user->name      = $request->name;
        $user->is_active = $request->active;
        $user->type      = $request->type;
        $user->save();

        return redirect()->back()
            ->with('success', trans('user.msg.updated'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        abort_if(!Auth::user()->can('delete', $user), 403, trans('global.http.403'));

        $deleted = $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', trans('user.msg.deleted'));
    }
}
