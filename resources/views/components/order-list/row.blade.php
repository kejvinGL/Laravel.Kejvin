<tr>
    <td class="bg-base-100">
        {{ $order->name}}
    </td>
    <td class="bg-base-100">
        {{ $order->email}}
    </td>
    <td class="bg-base-100">
        {{ $order->external_id}}
    </td>
    <td class="bg-base-100">
        {{ $order->price}}
    </td>
    <td class="bg-base-100 @if($order->status === 'Completed') bg-green-800 @elseif('Cancelled') bg-orange-600 @elseif('Failed') bg-red-700 @endif">
        {{ $order->status}}
    </td>
    <td class="bg-base-100">
        {{ $order->error_message ?? '_'}}
    </td>
    <td class="bg-base-100">
        {{ $order->updated_at->format('H:i @ d/m/y') }}
    </td>
    <td class="bg-base-100">
        {{ $order->created_at->format('H:i @ d/m/y') }}
    </td>
</tr>
