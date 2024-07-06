@props(['listing'])
<!-- Item 1 -->
<x-card class="transition hover:scale-105 relative w-11/12 mx-auto lg:flex lg:flex-row lg:items-center lg:justify-between lg:h-20"> 
    {{-- x-card ke andar ki cheeze slot ki jagah aayengi --}}
    <h1 class="text-lg capitalize font-semibold w-1/4 ">
        <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
    </h1>
    <div class="lg:absolute lg:left-1/3 lg:w-2/3 grid grid-cols-5 gap-2 ">
            <ul class="ml-4 flex col-span-2 items-center justify-start h-full">
            <x-listing-tags :tagscsv="$listing->tags" /> 
            </ul>
            <div class="ml-2 flex items-center justify-start gap-1 text-base h-full">
                <i class="fa-solid fa-calendar-days"></i> {{$listing->date}}
           </div>
           <div class="ml-2 flex items-center text-base h-full">
            {{$listing->reporter}}
       </div>
                @if($listing->status =='open')
            <div class="ml-2 flex items-center text-base text-green-500 font-semibold h-full">{{$listing->status}}</div>
                @else
                <div class="ml-2 flex items-center text-base text-red-500 font-semibold h-full">{{$listing->status}}</div>
                @endif
           
    </div>
</x-card>

<x-card class="lg:hidden w-11/12 mx-auto h-32 flex items-center justify-between">
    <div class="h-28 w-1/2 flex flex-col items-start justify-between">
        <h1 class="text-lg h-1/2 capitalize font-semibold w-full truncate">
            <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
        </h1>
        <ul class="flex h-1/2 items-end justify-start w-full">
            <x-listing-tags :tagscsv="$listing->tags" /> 
            </ul>
    </div>
    <div class="h-28 w-1/2 flex flex-col items-end justify-between">
        <div class="py-2 flex items-center text-base ">
            {{$listing->reporter}}
       </div>
       @if($listing->status =='open')
            <div class="py-1 flex items-center text-base text-green-500 font-semibold ">{{$listing->status}}</div>
                @else
                <div class="py-1 flex items-center text-base text-red-500 font-semibold ">{{$listing->status}}</div>
                @endif
    </div>
</x-card>