<!-- ACTIONS -->
<div class="flex gap-x-2 w-max">
    <x-user-list.modals.edit-user :$user/>
    <button class="btn btn-accent btn-xs rounded-md w-20"
            onclick="{{"edit_user_" . $user->id }}.showModal()">
        <i class="fa-solid fa-edit"></i> Edit
    </button>
    @if($user->trashed())
        <button class="btn btn-success btn-xs text-xs rounded-md w-20 flex-nowrap "
                onclick="{{ 'restore_user_' . $user->id }}.showModal()">
            <i class="fa-solid fa-recycle"></i>Restore
        </button>
        <x-user-list.modals.restore-user :$user/>

    @else


        <button class="btn btn-error btn-xs rounded-md w-20"
                onclick="{{ 'delete_user_' . $user->id }}.showModal()">
            <i class="fa-solid fa-trash"></i> Delete
        </button>
        <x-user-list.modals.delete-user :$user/>
    @endif
</div>
