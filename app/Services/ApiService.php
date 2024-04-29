<?php

namespace App\Services;


use App\Models\ApiKey;

class ApiService
{

    public function store($data)
    {
        $key = md5($data['email'].now());

        ApiKey::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'key' => $key,
        ]);
    }

    public function destroy(ApiKey $key)
    {
        $key->delete();
    }

    public function edit(ApiKey $key, $data)
    {
        $keyValue = md5($data['email'].now());
        $key->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'key' => $keyValue,
        ]);
    }

    public function getAll()
    {
        return ApiKey::latest()->paginate(10);
    }


}
