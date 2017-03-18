<?php

namespace App\Http\Controllers\Api\Glosarium;

use App\Glosarium\Category;
use App\Http\Controllers\Controller;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $cacheTime;

    public function __construct()
    {
        $this->middleware('cors');

        $this->cacheTime = Carbon::now()->addDays(30);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')
            ->filter()
            ->withCount('words')
            ->whereIsPublished(true)
            ->paginate(10);

        return response()->json($categories);
    }

    /**
     * Show all categories
     *
     * @return string json
     */
    public function all()
    {
        $categories = Cache::remember('glosarium.index', $this->cacheTime, function () {
            return Category::orderBy('name', 'ASC')
                ->withCount('words')
                ->whereIsPublished(true)
                ->get();
        });

        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
