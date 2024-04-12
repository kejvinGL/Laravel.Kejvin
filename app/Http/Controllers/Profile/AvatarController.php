<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Storage;

class AvatarController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        Session::put('tab', 'avatar');


        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        try {
        self::deleteAvatarFile();
        return self::updateAvatar($request);

        }catch (\Exception $e) {
            Session::flash('error', 'An error occurred while updating user avatar.');
            return back();
        }



    }

    private static function deleteAvatarFile(): void
    {
        if ($current = Media::where(['user_id'=> auth()->id() , 'type' => 'avatar'])->first()) {
            Storage::delete('public/avatars/' . $current->path);
            $current->delete();
        }

    }

    private static function updateAvatar($request)
    {
        $file = $request->file('avatar');
        $ext = $file->extension();
        $hashName = Str::random(50);
        $path = auth()->id() . '/' . $hashName . "." . $ext;
        $originalName = $file->getFilename();
        $size = $file->getSize();
        Media::updateOrCreate(["user_id" => auth()->id(), 'type' => 'avatar'],
            ['path' => $path,
                'hash_name' => $hashName,
                'original_name' => $originalName,
                'ext' => $ext,
                'size' => $size,
            ]);

        $request->file('avatar')->storeAs('public/avatars', $path);
        Session::flash('success', 'User avatar updated successfully.');

        return back();
    }
}
