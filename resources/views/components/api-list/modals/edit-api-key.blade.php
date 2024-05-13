<dialog id="{{ 'edit_key_' . $key->id }}" class="modal w-full">
    <div class="modal-box bg-base-100 w-max max-w-full p-6">
        <h3>Editing an API Key: {{ $key->name }} </h3>
        <p class="text-xs text-gray-600">Press ESC to cancel</p>
        <div class="modal-action flex-container">
            <div class="flex justify-center w-full">
                <form class="w-full" id="edit_form"  action="{{route('admin.api_key.edit',$key)}}"
                      method="post"
                      class="flex-grow">
                    @method('PUT')
                    @csrf
                    <table class="table rounded-xl lg:text-lg border-separate border-spacing-2">
                        <thead>
                        <tr class="border border-accent border-spacing-2 bg-base-300">
                            <th>{{__('API Name')}}</th>
                            <th>{{__('Email')}}</th>
                        </tr>
                        </thead>
                    <tr class="border-b border-accent border-spacing-2">
                        <!-- NAME -->
                        <td class="bg-base-200 p-0 text-center w-3/12 md:pr-1">
                            <div>
                                <input class="input bg-base-200 h-10" type="text" name="name" value="{{ $key->name }}">
                            </div>
                        </td>

                        <!-- EMAIL -->
                        <td class="bg-base-200 p-0 text-center w-3/12 md:pr-1">
                            <div>
                                <input class="input bg-base-200 h-10" type="text" name="email" value="{{ $key->email }}">
                            </div>
                        </td>
                    </tr>
                    </table>

                    <input type="submit" name="edit"
                           class="btn btn-outline"
                           id="deleteButton" value="Edit"/>
                </form>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕
                    </button>
                </form>
            </div>


        </div>

    </div>
</dialog>
