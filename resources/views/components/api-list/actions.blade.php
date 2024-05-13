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

    <x-api-list.modals.edit-api-key :$key/>

    <x-api-list.modals.delete-api-key :$key/>
</td>
