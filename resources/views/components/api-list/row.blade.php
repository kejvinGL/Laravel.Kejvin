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
            {{ $key->value }}
        </div>
    </td>

{{--    <!-- DATE CREATED -->--}}
{{--    <td class="bg-base-100 text-center">--}}
{{--        {{ $key->created_at->format('H:i @ d/m/y') }}--}}
{{--    </td>--}}


</tr>
