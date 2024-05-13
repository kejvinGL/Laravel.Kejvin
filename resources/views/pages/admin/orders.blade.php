@extends('layouts.app')

@section('title', 'Order List')

@section('content')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200/50  h-full transition-all main">
        <div class="h-16 flex-container">
            <x-partials.messages.request-responses/>
        </div>
        <div class="flex-container px-14">
        <table id="ordersTable" class="display w-full lg:text-lg">
            @include('components.order-list.header')
        </table>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            $('#ordersTable').DataTable({
                info: false,
                ajax: {
                    url: '{{route('get.orders.datatable')}}',
                    type: 'get'
                },
                layout: {
                    topStart: 'buttons'
                },
                buttons: [
                    {
                        text: '<i class="fa-solid fa-rotate-right"></i>',
                        action: function (e, dt, node, config) {
                            dt.column(6).search("").draw();
                            dt.ajax.reload();
                        }
                    },
                    {
                        text: 'All',
                        action: function (e, dt, node, config) {
                            dt.column(6).search("").draw();
                        },
                        className: 'btn',
                    },
                    {
                        text: 'Completed',
                        action: function (e, dt, node, config) {
                            dt.column(6).search("Completed").draw();
                        },
                        className: 'btn',
                    },
                    {
                        text: 'Cancelled',
                        action: function (e, dt, node, config) {
                            dt.column(6).search("Cancelled").draw();
                        },
                        className: 'btn',
                    },
                    {
                        text: 'Failed',
                        action: function (e, dt, node, config) {
                            dt.column(6).search("Failed").draw();
                        },
                        className: 'btn',
                    },
                    {
                        text: 'Export as XLSX ',
                        action: function (e, dt, node, config) {
                            window.location.href = '/export/orders';
                        },
                        className: 'btn',
                    },


                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'product', name: 'product'},
                    {data: 'external_id', name: 'external_id'},
                    {data: 'price', name: 'price'},
                    {data: 'status', name: 'status'},
                    {data: 'error_message', name: 'error_message'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                ],
                order: false
            });
        });
    </script>
@endsection
