<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function store(Request $request)
    {
      try {
          $user = Auth::user();
          $file = $request->file;
          $extension = $file->extension();
          $path = "avatars/user-{$user->id}/avatar.$extension";
          Storage::disk('public')
              ->put($path, file_get_contents($file));
          $user->avatar = env('SPA_URL').'/storage/'.$path;
          $user->save();
      } catch (Exception $exception) {
          return response()->json(['message' => $exception->getMessage()], 409);
      }
           return new UserResource($user);
    }
}
