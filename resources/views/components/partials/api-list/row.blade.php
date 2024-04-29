<tr class="border-b border-accent border-spacing-2">
    <!-- NAME -->
    <td class="bg-base-100 pr-0 text-center w-3/12 md:pr-1">
        <div>
            {{ $key->name }}
        </div>
    </td>

    <!-- EMAIL -->
    <td class="bg-base-100 pr-0 text-center w-3/12 md:pr-1">
        <div>
            {{ $key->email }}
        </div>
    </td>

    <!-- KEY -->
    <td class="bg-base-100 pr-0 text-center w-4/12 md:pr-1">
        <div>
            {{ $key->key }}
        </div>
    </td>

{{--    <!-- DATE CREATED -->--}}
{{--    <td class="bg-base-100 text-center">--}}
{{--        {{ $key->created_at->format('H:i @ d/m/y') }}--}}
{{--    </td>--}}


    <!-- ACTIONS -->
    <td class="bg-base-100 text-center w-max">
        <button class="btn btn-neutral btn-xs rounded-md"
                onclick="document.getElementById('edit_key_{{ $key->id }}').showModal()">
            <i class="fa-solid fa-pen"></i>{{__('Edit')}}
        </button>

        <button class="btn btn-error btn-xs rounded-md"
                onclick="document.getElementById('delete_key_{{ $key->id }}').showModal()">
            <i class="fa-solid fa-trash"></i>{{__('Delete')}}
        </button>

        <x-partials.api-list.modals.edit-api-key :$key/>

        <x-partials.api-list.modals.delete-api-key :$key/>
    </td>
</tr>
