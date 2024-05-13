@extends('layouts.app')

@section('title', 'User List')

@section('content')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200/50 transition-all h-full main">
        <div class="h-16 flex-container">
            <x-partials.messages.request-responses/>
        </div>
        <div class="flex-container px-14">
            <table id="usersTable" class="w-full table nowrap ">
                @include('components.user-list.header')
            </table>
        </div>
        <dialog id="importUsers" class="modal w-full">
            <div class="modal-box bg-base-100 w-max max-w-full p-6">
                <div class="modal-action flex-container gap-5">
                    <h3>Select XLSX file of Users</h3>
                    <form method="post" action="{{route('import.users')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="userData" class="file-input">
                        <input type="submit" name="submit" class="btn"/>
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
        $('#usersTable').DataTable({
            info: false,
            pageLength: 12,
            ajax: {
                url: '{{route('get.users.datatable')}}',
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
                    className: '',
                },
                {
                    text: 'All',
                    action: function (e, dt, node, config) {
                        dt.column(3).search("").draw();
                    },
                },
                {
                    text: 'Admins',
                    action: function (e, dt, node, config) {
                        dt.column(3).search("Admin").draw();
                    },
                },
                {
                    text: 'Clients',
                    action: function (e, dt, node, config) {
                        dt.column(3).search("Client").draw();
                    },
                },
                {
                    text: 'Export as XLSX ',
                    action: function (e, dt, node, config) {
                        window.location.href = '/export/users';
                    },
                },
                {
                    text: 'Import from XLSX ',
                    action: function () {
                        document.getElementById('importUsers').showModal();
                    },
                },
                {
                    text: 'Import Example ',
                    action: function () {
                        window.location.href = '/import/users/example';
                    },
                    className: 'btn btn-sm',
                },
            ],
            columns: [
                {data: 'username', name: 'username'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role_id', name: 'role',},
                {data: 'posts_count', name: 'posts', searchable: false},
                {data: 'comments_count', name: 'comments', searchable: false},
                {data: 'updated_at', name: 'updated_at', searchable: false},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
        });
    </script>

@endsection

