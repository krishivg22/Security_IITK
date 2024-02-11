<x-layout>
@include('partials._hero')
@auth
@include('partials._search')
<div
class="flex flex-col gap-2 mx-4"      {{----}}
>   
  <div class="relative w-11/12 px-6 mx-auto lg:flex lg:flex-row lg:items-center lg:justify-between lg:h-8 hidden">
    <h1 class=" w-1/4 font-semibold text-gray-600 ">Title</h1>
    <div class="lg:absolute lg:left-1/3 lg:w-2/3 grid grid-cols-5 gap-2 ">
        <div class="ml-4 flex col-span-2 items-center justify-start h-full font-semibold text-gray-600">
        Tags 
        </div>
        <div class="ml-2 flex items-center justify-start gap-1 text-base font-semibold text-gray-600 h-full ">
            Date
       </div>
       <div class="ml-2 flex items-center text-base text-gray-600 font-semibold h-full">
        Reporter
   </div>
           
        <div class="ml-2 flex items-center text-base font-semibold text-gray-600 h-full">Status</div>
       
</div>
</div>              
@foreach($listings as $listing)
 <x-listing-card :listing="$listing" />    {{--This is self closing--}}   {{--Colon is for variable passing--}}
@endforeach
 @if(count($listings)==0)         {{--  Conditional (cana also have else in it--}}
<p>No listings found</p>
@endif
</div>
{{-- We have directives here that can be used for loops,conditions(start with @) --}}
{{-- We have a php directive also, in which you can write php code------->  @php   @endphp 
    We also have unless directive 
    
    Now pagination--}}
<div class="mt-6 p-4">{{$listings->links()}}</div>                              {{--diff pages can be accessed by passing queries page=2--}}
@else

<p class="text-2xl text-center mt-10 mb-0 text-blue-500 ">This portal is for security purposes of IITK.</p>

@endauth
</x-layout>
