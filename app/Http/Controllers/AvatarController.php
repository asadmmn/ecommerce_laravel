<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarUpdateRequest;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    //
public function updateavatar(Request $request)
{
    $path = $request->file('avatar')->store('public/avatars');
    // $path =storage_path('app') . '/' . $p;
    
    $user = auth()->user(); // Get the authenticated user
    $user->avatar = $path; // Set the avatar path
    $user->save(); // Save the user with the new avatar path

    return redirect()->route('profile.edit'); // Redirect to the profile edit page (or any other page you prefer)
}

}
