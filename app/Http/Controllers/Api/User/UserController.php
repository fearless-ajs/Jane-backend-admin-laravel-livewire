<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->showAll(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'lastname'     => 'required|string|max:255',
            'firstname'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users',
            'image'        => 'image',
            'password'     => 'required|min:6|confirmed'
        ]);

        // Store the contact data in the database
        $data = $request->all();
        $data['verification_token'] = Str::random(50);

        if ($request->hasFile('image')){
            $data['image'] = $request->image->store('/', 'images');
        }

        $user  = User::create($data);
//        $contact->attachRole('new-contact');

        // Return response as json to the client
        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'lastname'     => 'string|max:255',
            'firstname'    => 'string|max:255',
            'email'        => 'email|unique:users,' . $user->id, // Don't check the contact with tha id
            'image'        => 'image',
        ]);

        $user->fill($request->only([
            'lastname',
            'firstname',
            'email',
            'image',
        ]));

        // to what is the database record
        if (!$user->isDirty()){
            return $this->errorResponse([
                'errorCode' => 'DATA_ERROR',
                'message'   => 'You need to specify a different value to update'
            ], 422);
        }

        if ($request->hasFile('image')){
            Storage::delete($user->image);
            $request->image = $request->image->store('/', 'images');
        }

        return $this->showOne($user, 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        Storage::delete($user->image);
        return $this->successResponse([
            'errorCode' => 'SUCCESS',
            'message'   => 'User deleted successfully'
        ], 202);
    }
}
