<tr class="border-b border-accent border-spacing-2">
    <!-- USERNAME & BADGE -->
    <td class="inline-flex w-full bg-base-100 pr-0 md:pr-1">
        <div class="avatar mask mask-circle size-6 mr-5">
            <img src="{{ $user->getAvatar()}}" alt="avatar">
        </div>
        <div>
            {{ $user->username}}
        </div>
    </td>

    <!-- FULL NAME -->
    <td class="bg-base-100 text-center">
        <div>
            <div class>{{$user->name}}</div>
        </div>
    </td>
    <!-- EMAIL -->
    <td class="bg-base-100 pr-0 md:pr-1">
        <div>
            <div class="text-xs text-wrap">{{$user->email}}</div>
        </div>
    </td>
    <!-- LAST LOGIN -->
    <td class="bg-base-100 hidden md:table-cell text-center">
        {{$user->updated_at->format('d/m/y @ H:i')}}
    </td>
    <!-- POSTS -->
    <td class="bg-base-100 text-center ">
        {{$user["role_id"] == 2 ? $user->posts_count : " _"}}
    </td>
    <td class="bg-base-100 text-center ">
        {{$user["role_id"] == 2 ? $user->comments_count : " _"}}
    </td>
    <!-- ACTIONS -->
    <td class="bg-base-100 text-nowrap p-1 text-center ">
        <x-partials.user-list.modals.edit-user :$user/>

        @if($user->trashed())
            <button class="btn btn-accent btn-xs rounded-md"
                    onclick="{{"edit_user_" . $user->id }}.showModal()">
                <i class="fa-solid fa-edit"></i> Edit
            </button>

            <button class="btn btn-success btn-xs rounded-md mx1"
                    onclick="{{ 'restore_user_' . $user->id }}.showModal()">
                <i class="fa-solid fa-recycle"></i> Restore
            </button>
            <x-partials.user-list.modals.restore-user :$user/>

        @else
            <button class="btn btn-accent btn-xs rounded-md"
                    onclick="{{"edit_user_" . $user->id }}.showModal()">
                <i class="fa-solid fa-edit"></i> Edit
            </button>

            <button class="btn btn-error btn-xs rounded-md mx1"
                    onclick="{{ 'delete_user_' . $user->id }}.showModal()">
                <i class="fa-solid fa-trash"></i> Del
            </button>
            <x-partials.user-list.modals.delete-user :$user/>
        @endif


    </td>
</tr>
