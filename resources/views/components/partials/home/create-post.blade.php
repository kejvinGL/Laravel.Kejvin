<div class="h-[18vh] flex-container align-middle ">
    <dialog id="create_post" class="modal">
        <div class="mx-auto w-1/2 min-h-[220px] min-w-[500px]">
            <div class="flex w-full justify-end gap-5">
                <p class="text-xs text-gray-600 my-auto">Press ESC to cancel</p>
                <form method="dialog">
                    <button class="btn btn-circle btn-outline">✕</button>
                </form>
            </div>
            <div class="modal-action w-full">
                <form method="POST" enctype="multipart/form-data"  id="add_post" action="{{route('post.store')}}" class="w-full">
                    @csrf
                    <div
                        class="flex-container w-full justify-between bg-base-200 border border-secondary rounded-2xl p-2">
                        <div class="flex w-full h-1/6 ">
                            <div class="flex rounded-xl w-full items-center">
                                <img src="{{auth()->user()->getAvatar()}}" class="size-8" alt="{{auth()->user()->avatar->original_name ?? 'avatar'}}"/>
                                <span class="m-3">
                                        {{auth()->user()->name}}
                                </span>
                            </div>
                            <div class="flex delete w-3/12 justify-end pr-2">
                                <button type="submit" name="submit" class="btn btn-success btn-sm rounded-md">
                                    <i class="fa-regular fa-paper-plane"></i>
                                    {{__('Post')}}
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between w-full">
                            <input type="text" name="title"
                                   class="input bg-base-200 w-full"
                                   placeholder="Post title...">
                        </div>
                        <div class="divider m-0"></div>
                        <div class="flex-container w-full">
                            <textarea type="text" name="body" form="add_post" placeholder="Post body..."
                                      class="input bg-base-200 h-[300px] w-full"> </textarea>
                            <input type="file" accept="image/png, image/gif, image/jpeg" class="file-input ml-auto mt-3" name="media">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </dialog>

</div>

<script>
    var loadFile = function (event) {
        var output = document.getElementById('preview_media');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
