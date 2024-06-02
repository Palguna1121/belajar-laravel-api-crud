<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        //retun json response
        return response()->json([
            'result' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try{
            //create user
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            //return response
            return response()->json([
                'message' => "User successfully created."
            ], 200);
        } catch (\Exception $e) {
            //return json response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //user detail
        $users = User::find($id);
        //check user
        if(!$users) {
          return response()->json([
            'message' => 'Users not found'
          ], 404);
        }

        //return response
        return response()->json([
            'users' => $users
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, $id)
    {
        try{
            //user detail
            $users = User::find($id);
            //check user
            if(!$users) {
            return response()->json([
                'message' => 'Users not found'
            ], 404);
            }
            //update user
            $data = $request->only(
                'nama',
                'email',
                'password'
            );
            $users->update($data);
            //return response
            return response()->json([
                'message' => "User successfully updated."
            ], 200);
        } catch (\Exception $e) {
            //return json response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //detail
        $users = User::find($id);
        //check user
        if(!$users) {
        return response()->json([
            'message' => 'Users not found'
        ], 404);
        }
        
        //delete user
        $users->delete();

        //return response
        return response()->json([
            'message' => "User successfully deleted."
        ], 200);
    }
}
