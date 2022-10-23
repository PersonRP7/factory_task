<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $name = $request->query('name');
        // $data1 = explode('/', $request->query('data'));
        $tags = $request->query('tags');
        $tags_split = explode(',', $tags);

        $with = $request->query('with');
        $with_split = explode(',', $with);
        // return $with_split;
        // foreach ($with_split as $w) {
        //     echo $w;
        // }
        $with_i = implode(',', $with_split);
        // return $with_i;
        $w_exp = explode(',', $with_i);
        // return $w_exp;
        foreach ($w_exp as $key) {
            echo $key;
        }
        // return $tags_split[1];
        // foreach ($tags_split as $tag) {
        //     echo $tag;
        // }
        // return $tags;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal)
    {
        //
    }
}
