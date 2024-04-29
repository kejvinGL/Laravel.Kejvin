<x-mail::message>
Hey {{ $admin->name }},<br>
Here is the report from today's activity on Laravel.Kejvin.<br>
Each Column represents the number of new entries:

<x-mail::table>
| Users | Posts | Comments |
|:----------|:-----------|:-------------|
|{{$users}} | {{$posts}} | {{$comments}}|
</x-mail::table>

</x-mail::message>
