<?php

namespace App\Http\Controllers\Glosarium;

use App\Glosarium\Description;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function up(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:glosarium_descriptions,id',
        ]);

        $description = Description::find(request('id'));

        $description->increment('vote_up', 1);
        $description->save();

        return response()->json($description);
    }

    public function down(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:glosarium_descriptions,id',
        ]);

        $description = Description::find(request('id'));

        $description->increment('vote_down', 1);
        $description->save();

        return response()->json($description);
    }
}
