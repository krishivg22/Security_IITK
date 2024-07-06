@props(['tagscsv'])
@php
$tags= explode(',',$tagscsv);   #cuts at , and returns array of strings.
@endphp

    @foreach($tags as $tag)
    <li
        class="h-6 in bg-black text-white rounded-xl py-1 px-3 m-1 text-xs"
    >
        <a href="/?tag={{$tag}}">{{$tag}}</a>    {{--Ye query hai jisse humne tag request kiya hai--}}
    </li>
    @endforeach
