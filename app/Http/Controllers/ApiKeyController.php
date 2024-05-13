<?php

namespace App\Http\Controllers;

use App\Exports\ApiKeyExport;
use App\Http\Requests\API\StoreApiKeyRequest;
use App\Imports\ApiKeyImport;
use App\Models\ApiKey;
use App\Services\ApiService;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Mockery\Exception;
use Yajra\DataTables\DataTables;

class ApiKeyController extends Controller
{
    public function __construct(private ApiService $apiService)
    {
    }

    public function dataTable()
    {

        $keys = ApiKey::all();
        return DataTables::of($keys)
            ->addColumn('actions', function ($key) {
                return view('components.api-list.actions', compact('key'));
            })
            ->toJson();
    }


    public function index()
    {
        $data = $this->apiService->getAllKeys();
        return view('pages.admin.api-keys', ['keys' => $data]);
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

    public function export()
    {
        return Excel::download(new ApiKeyExport, 'api_keys_' . now()->format('d-m-y') . '.xlsx');
    }

    public function import()
    {
        try {
            Excel::import(new ApiKeyImport, request()->apiKeys);
            return redirect(route('api_keys'))->with('success', 'New API Key/s created from import.');
        } catch (ValidationException $e) {
            foreach ($e->failures() as $failure) {
                foreach ($failure->errors() as $error)
                    $errors[] = 'Row ' . $failure->row() . ": " . $error;
            }
            return back()->with('errors', $errors);
        }
    }
    public function example()
    {
        $file= public_path(). "/storage/examples/apikeys.xlsx";
        $headers = array(
            'Content-Type: application/xlsx',
        );
        return Response::download($file, 'api_keys_import_example.xlsx', $headers);
    }

}
