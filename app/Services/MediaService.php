<?php

namespace App\Services;

use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    public function store($media, $post)
    {
        $path = auth()->id() . '/' . $media->hashName();
        $this->saveNewMediaFile($media, $path);
        Media::create(
            [
                'user_id' => $post->user_id,
                'post_id' => $post->id,
                'type' => 'post',
                'path' => $path,
                'hash_name' => $media->hashName(),
                'original_name' => $media->getClientOriginalName(),
                'ext' => $media->extension(),
                'size' => $media->getSize(),
            ]
        );
    }

    public function destroy(Media $media)
    {
        Storage::delete('/media/' . $media->path);

        return Media::destroy($media);
    }


    public function destroyUserMedia(User $user, bool $forceDelete = false)
    {
        if ($forceDelete) {
            $user->media()?->forceDelete();
            foreach ($user?->media as $media) {
                $this->deleteMediaFromStorage($media);
            }
        } else {
            $user->media()?->delete();
        }
    }

    public function destroyPostMedia(Post $post, bool $forceDelete)
    {
        if ($forceDelete) {
            foreach ($post?->media as $media) {
                $this->deleteMediaFromStorage($media);
            }
            return $post->media()?->forceDelete();
        } else {
            return $post->media()?->delete();
        }
    }


    public function restoreUserMedia($user)
    {
        return $user->media()?->restore();
    }


    public function updateAvatar(array $data)
    {
        $this->deleteCurrentAvatar();
        $file = $data['avatar'];

        return $this->setAvatar($file);
    }

    public function deleteCurrentAvatar()
    {
        $currentAvatar = auth()->user()->avatar;
        $this->deleteMediaFromStorage($currentAvatar);

        return $currentAvatar?->forceDelete();
    }

    private function setAvatar(mixed $file)
    {
        $path = auth()->id() . '/' . $file->hashName();
        $this->saveNewMediaFile($file, $path);

        return Media::updateOrCreate(
            ['user_id' => auth()->id(),
                'type' => 'avatar'],
            ['path' => $path,
                'hash_name' => $file->hashName(),
                'original_name' => $file->getClientOriginalName(),
                'ext' => $file->extension(),
                'size' => $file->getSize(),
            ]
        );
    }

    private function saveNewMediaFile($file, $path)
    {
        return $file->storeAs('public/media', $path);
    }

    private function deleteMediaFromStorage(Media $media = null)
    {
        if ($media)
            return Storage::delete('public/media/' . $media->path);
    }
}
