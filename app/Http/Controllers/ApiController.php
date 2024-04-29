<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\StoreApiKeyRequest;
use App\Models\ApiKey;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Mockery\Exception;

class ApiController extends Controller
{
    public function __construct(private ApiService $apiService)
    {
    }

    public function index()
    {
        $data = $this->apiService->getAll();
        return view('pages.api-keys', ['keys' => $data]);
    }

    public function store(StoreApiKeyRequest $request)
    {
        try {
            $this->apiService->store($request->validated());
            return back()->with('success', 'API Key created successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(ApiKey $key)
    {
        try {
            $this->apiService->destroy($key);
            return back()->with('success', 'API Key deleted successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(StoreApiKeyRequest $request, ApiKey $key)
    {
        try {
            $this->apiService->edit($key, $request->validated());
            return back()->with('success', 'API Key edited successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

}
