<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UserCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserCategoryRequest;

class UserCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserCategoryRequest $request)
    {
        $user = $request->user();
        $success = false;
        $message = "";

        $data = $request->input('categories');

        if(!$user->categories->isEmpty()) {
            $user->categories()->delete();
        }
        
        foreach ($data as $key) {
            $userCategory = new UserCategory([
                'category_id' => $key
            ]);

            $user->categories()->save($userCategory);
        }
        
        $success = true;
        $message = "Tus categorías se han guardado correctamente";


        $response = array('success' => $success, 'message' => $message);

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCategory  $userCategory
     * @return \Illuminate\Http\Response
     */
    public function show(UserCategory $userCategory)
    {
        //
    }
}
