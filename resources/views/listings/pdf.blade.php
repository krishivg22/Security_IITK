<div class="mx-4">
    <x-card class="w-11/12 mx-auto">
        <div
            class="flex flex-col items-center justify-center text-center"
        >
            {{-- <img
                class="w-48 mr-6 mb-6"
                {{-- src="{{asset({{'images/no-image.png'}})}}"     #asset is for public image paths. 
                @if($listing->logo == NULL)
                src="{{asset('images/no-image.png')}}"
                @else
                src={{asset('storage/'.$listing->logo)}}   {{--for accessing like this you'll have to create a sim link between public and storage->public   php artisan storage:link--}}                     {{--we can do this(asset) also for accesing images from public folder.--}}
              {{--}}  alt=""
                @endif
                alt=""
            /> --}}
            
            <h1 >{{$listing->title}}</h1>
            <hr>
            <ul>
            <li><h3>Tags</h3></li>
                <ul class="flex flex-row justify-between items-center">
            <x-listing-tags :tagscsv="$listing->tags" /> 
            </ul>
            <li><h3>Status</h3></li>
                @if($listing->status =='open')
                <div class="text-lg text-green-500 my-4">
                     {{$listing->status}}
                </div> 
                @else
                <div class="text-lg text-red-500 my-4">
                    {{$listing->status}}
               </div>
               @endif
               <li><h3>Venue</h3></li>
            <div class="text-lg my-4">
                <i class="fa-solid fa-location-dot"></i>{{$listing->venue}}
            </div>
            <li><h3>Date</h3></li>
            <div class="text-lg my-4">
                <i class="fa-solid fa-calendar-days"></i>{{$listing->date}}
            </div>
            
               <li><h3 >
                    Description
                </h3></li>
                    <p class="text-lg">
                        {{$listing->description}}
                    </p>
    
                    <li><h3 class="text-lg font-semibold">Reported by {{$listing->reporter}}</h3></li>
                    <li><h3>Attachments</h3></li>
                    <p>See from Website.</p>
            </ul>
        </div>
    </x-card>
</div>
