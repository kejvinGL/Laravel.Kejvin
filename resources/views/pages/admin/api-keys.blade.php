@extends('layouts.app')

@section('title', 'API Keys')

@section('content')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200/50  h-full transition-all main">
        <div class="h-16 flex-container">
            <x-partials.messages.request-responses/>
        </div>
        <div class="h-[18vh] flex-container align-middle ">
            <button class="mx-auto btn rounded-md bg-base-100 m-10 h-16 text-xl" onclick="create_api_key.showModal()">
                {{__('Create')}} <i class="ml-3 fa-solid fa-key scale-150"></i>
            </button>
        </div>
        <x-api-list.modals.create-api-key/>
        <table id="apiKeysTable" class="display">
            @include('components.api-list.header')
        </table>
        <dialog id="importApiKeys" class="modal w-full">
            <div class="modal-box bg-base-100 w-max max-w-full p-6">
                <div class="modal-action flex-container gap-5">
                    <h3>Select XLSX file of API Keys</h3>
                    <form method="post" action="{{route('import.api_keys')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="apiKeys" class="file-input">
                        <input type="submit" name="submit" class="btn" />
                    </form>
                </div>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕
                    </button>
                </form>
            </div>
        </dialog>

        @if(session('errors'))
            <dialog id="errorMessages" class="modal w-full" open>
                <div class="modal-box bg-base-100 w-max max-w-full p-8">
                    <h1 class="text-center text-xl text-error mb-5"> User/s could not be imported. </h1>
                    <div class="text-start gap-5">
                        @foreach(session('errors') as $message)
                            <div class="text-neutral-500">
                                {{ $message }}
                            </div>
                        @endforeach
                    </div>
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕
                        </button>
                    </form>
                </div>
            </dialog>
        @endif
    </main>
    <script>
        $(document).ready(function () {
            $('#apiKeysTable').DataTable({
                info: false,
                ajax: {
                    url: '{{route('get.api_keys.datatable')}}',
                    type: 'get'
                },
                layout: {
                    topStart: 'buttons'
                },
                buttons: [
                    {
                        text: '<i class="fa-solid fa-rotate-right"></i>',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload();
                        },
                        className: 'btn',
                    },
                    {
                        text: 'Export as XLSX ',
                        action: function (e, dt, node, config) {
                            window.location.href = '/export/api_keys';
                        },
                        className: 'btn',
                    },
                    {
                        text: 'Import from XLSX ',
                        action: function (e, dt, node, config) {
                            document.getElementById('importApiKeys').showModal();

                        },
                        className: 'btn',
                    },
                    {
                        text: 'Import Example',
                        action: function () {
                            window.location.href = '/import/api_keys/example';
                        },
                        className: 'btn btn-sm',
                    },


                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'value', name: 'value'},
                    {data: 'actions', name: 'actions', orderable: false},
                ],
                order: false
            });
        });
    </script>
@endsection
