<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $editing = true;
        $ideas = $user->ideas()->paginate(5);
        return view('users.edit', compact('user', 'editing', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();
        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        // $validated = request()->validate(
        //     [
        //         'name' => 'required|min:3|max:40',
        //         'bio' => 'nullable|min:1|max:255',
        //         'image' => 'image'
        //     ]
        // );

        // if (request()->has('image')) {
        //     $imagePath = request()->file('image')->store('profile', 'public');
        //     $validated['image'] = $imagePath;

        //     Storage::disk('public')->delete($user->image ?? '');
        // }


        // if (request()->has('image')) {
        //     $imagePath = request()->file('image')->store('profile', 'public');
        //     $validated['image'] = $imagePath;

        //     // Check if $user->image exists and is a string before attempting deletion
        //     if ($user->image && is_string($user->image)) {
        //         Storage::disk('public')->delete($user->image);
        //     }
        // }
        // $user->update($validated);
        // return redirect()->route('profile');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }

    public function profile()
    {
        return $this->show(auth()->user());
    }
}
