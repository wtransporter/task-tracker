<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.edit', ['user' => auth()->user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, User $user)
    {
        $attributes = $request->validated();

        if ($request->has('password')) {
            $attributes['password'] = Hash::make($request->password);
        }

        $user->update($attributes);

        return redirect()->route('user.edit')->with('message', 'User info updated successfully.');
    }
}
