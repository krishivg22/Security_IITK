@if(session()->has ('message'))
<div  x-data="{show : true}" x-init="setTimeout(()=> show=false,3000)" x-show ="show" class="fixed z-50 top-0 left-1/2 transform
-translate-x-1/2 bg-laravel text-white px-48 py-3">
<p>
{{session ('message')}}
</p>
</div>
 @endif                 {{--using alpine js to display messages for a particular time.
x-data se values (like show) ko value di
x-init ke andar ka function calll hua jab div initialise hua.....x-show me show value de di....jab wo true tb ye div dikhega.  --}}