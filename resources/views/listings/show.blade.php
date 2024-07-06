<x-layout>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var dragAndDrop = document.getElementById("dragAndDrop");
            var fileInput = document.getElementById("logoInput");
            var fileError = document.getElementById("fileError");
    
            dragAndDrop.addEventListener("dragover", function (e) {
                e.preventDefault();
                dragAndDrop.classList.add("drag-over");
            });
    
            dragAndDrop.addEventListener("dragleave", function () {
                dragAndDrop.classList.remove("drag-over");
            });
    
            dragAndDrop.addEventListener("drop", function (e) {
                e.preventDefault();
                dragAndDrop.classList.remove("drag-over");
    
                var files = e.dataTransfer.files;
    
                if (files.length > 0) {
                    fileInput.files = files;
                    updateFileName();
                }
            });
    
            fileInput.addEventListener("change", function () {
                updateFileName();
            });
            
            
            function updateFileName() {
                var fileList = fileInput.files;
                if (fileList.length > 0) {
                    fileError.textContent = "";
                    dragAndDrop.innerHTML = "";
    
                    for (var i = 0; i < fileList.length; i++) {
                        dragAndDrop.innerHTML += `
                            <div class="file-item">
                                <p class="text-sm">${fileList[i].name}</p>
                                <button type="button" class="bg-red-500 text-white text-xs rounded-full py-1 px-2 m-1 hover:bg-red-600" onclick="removeFile(${i})"> <i class="fa-solid fa-xmark"></i></button>
                            </div>
                        `;
                    }
                } else {
                    dragAndDrop.innerHTML = "<p>Drag and drop your file here</p>";
                }
            }

            
           // Function to remove a file
window.removeFile= function (index) {
var fileList = fileInput.files;
var newFileList = Array.from(fileList);
newFileList.splice(index, 1);

// Create a new DataTransfer object
var newDataTransfer = new DataTransfer();

// Add the remaining files to the new DataTransfer object
newFileList.forEach(function (file) {
newDataTransfer.items.add(file);
});

// Update the files property of the existing input with the new DataTransfer object
fileInput.files = newDataTransfer.files;

// Update the displayed file names
updateFileName();
};

        });
        $(document).ready(function(){
            $(".dropa").on("click",function(){
            $(".careta").toggleClass("caret-rotate");
             $(".drop1").toggleClass("hidden");
        });
        $(".dropb").on("click",function(){
            $(".caretb").toggleClass("caret-rotate");
             $(".drop2").toggleClass("hidden");
        });
        });
       
    </script>
    
    <style>
        @media(max-height: 500px){
        #dragAndDrop{
     display:none !important;
        }
    }
    
        .drag-over {
            background-color: #f0f8ff; /* Light blue background when dragging over */
        }
        .file-item {
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                margin-bottom: 5px;
                            }
        .caret{
            width: 0;
height: 0;
border-left: 5px solid transparent;
border-right: 5px solid transparent;
border-top: 6px solid black;
transition: 0.3s;
        }
        .caret-rotate {
transform: rotate(180deg);
}
    </style>
                <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-0 pointer-events-none z-40"></div>       
                <!-- Modal for choosing files -->
                <div id="attachmentModal" class="hidden fixed rounded-md  top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-2/3 p-5 bg-white text-black border-4 border-gray-500 z-50">
                    <!-- File input field -->
                    <div class="h-full w-full flex flex-col items-center justify-center">
                    <form action="/listings/attach/{{$listing->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="h-full flex flex-col gap-5 justify-between items-center">
                        <label for="attachment" class="inline-block font-bold text-lg mb-2">
                            Attachments
                        </label>
                        <input
                            type="file"
                            class="border border-gray-200 rounded p-2 w-full"
                            name="attachment[]"
                            id="logoInput"
                            multiple />
                            
                        <div class="hidden lg:block border-2 border-dashed md:border-gray-300 p-10 text-center cursor-pointer" id="dragAndDrop">
                            <p>Drag and drop your file here</p>
                        </div>
                        <p id="fileError" class="text-red-500 text-xs mt-1"></p>
                    
                        <button type="submit" class="block py-1 px-2 rounded-full text-lg text-black bg-gray-100 hover:bg-gray-400"><i class="fa-solid fa-upload"></i></button>
                    </div>
                    </form>
                    <button onclick="closeModal()" class="mt-3 py-1 px-3 rounded-full text-lg bg-red-500 hover:bg-red-600"><i class="fa-solid fa-xmark"></i></button>
                </div>
                </div>
<div class="mx-4 mt-10">
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
        <div class="flex w-full flex-col items-center justify-between">
        <h3 class="text-3xl mb-14 uppercase font-bold">{{$listing->title}}</h3>
            <ul class="flex justify-between my-4 items-center">
        <x-listing-tags :tagscsv="$listing->tags" /> 
        </ul>
            @if($listing->status =='open')
            <div class="text-lg text-green-500 font-semibold my-4">
                 {{$listing->status}}
            </div> 
            @else
            <div class="text-lg text-red-500 font-semibold my-4">
                {{$listing->status}}
           </div>
           @endif
           <div class=" my-4 w-full flex items-center justify-evenly">
        <div class="text-lg ">
            <i class="fa-solid fa-location-dot"></i> {{$listing->venue}}
        </div>
        <div class="text-lg ">
            <i class="fa-solid fa-calendar-days"></i> {{$listing->date}}
        </div>
        <div class="text-lg ">
            <i class="fa-regular fa-clock"></i> {{$listing->time}}
        </div>
    </div>
    </div>
        <div class="border border-gray-400 w-full mb-6"></div>
        <div class="w-full">
            <div class=" bg-gray-300 p-0.5 mb-2 dropa">
                <div class="text-xl font-bold my-2 flex justify-center items-center">
                    <span class="ml-3 mr-auto">Description</span>
                     <div class="careta caret ml-auto mr-3"></div>
                 </div>
                <p class="hidden text-base text-justify drop1 mx-3">
                    {{$listing->description}}
                </p>
            </div>
             <div class=" bg-gray-300 p-0.5 mb-6 dropb">
                <div class="text-xl font-bold my-2 flex justify-center items-center">
                   <span class="ml-3 mr-auto">Attachments</span>
                    <div class="caretb caret ml-auto mr-3"></div>
                </div>
                
                <div class="hidden drop2">
                <ul class="flex items-center justify-center gap-5 mb-1">
                    @if($listing->attachment ==NULL)
                    <li class='text-base'>No Attachments found</li>
                    @else
                    @php
                    if(strpos($listing->attachment, ',') !== false){
                    $attachments= explode(',',$listing->attachment); 
                    }
                    else{
                        $attachments=[$listing->attachment]  ;
                    }
                    $i=1;
                    
                    @endphp
                    @foreach($attachments as $attachment)
                    <button class="text-base text-blue-500 hover:text-blue-700">
                    <li><a href={{'/storage/attachments/'.$attachment}}>Attachment {{$i}}</a></li>
                </button>                  {{--whenever we write asset,w emean we are going to acccess something in public folder.--}}
                    @php
                    $i=$i+1;
                    @endphp
                    @endforeach
                    @endif
    
                </ul>
               
            
            @unless($listing->user_id != auth()->id())
            <button type="button" onclick="openModal()" class="mt-3 mb-1 py-1 px-2 rounded-lg  border border-solid border-gray-400 text-black hover:bg-gray-400">
                <i class="fa-solid fa-file-circle-plus"></i> Attach Files
            </button>
            @endunless
                </div>
            </div>   
                <h3 class="text-lg font-semibold">Reported by {{$listing->reporter}}</h3>
        </div>
    </div>
</x-card>
@unless($listing->user_id != auth()->id())
<x-card class="w-11/12 mx-auto mt-5 p-2 flex space-x-6">
    <div class="rounded-lg bg-black text-white py-2 px-4 hover:text-gray-400">
    <a href="/listings/{{$listing->id}}/edit">
    <i class="fa-solid fa-pencil"></i> Edit
    </a>
    </div>
    <div class="rounded-lg bg-black text-white py-2 px-4 hover:text-gray-400">
        <a href="/listings/{{$listing->id}}/download">
            <i class="fa-solid fa-download"></i> Download Report
            </a>
        </div>
        <button type="button" onclick="openModal1()" class="rounded-lg bg-red-500 text-white py-2 px-4 hover:bg-red-600"><i class="fa-solid fa-trash"></i>
            Delete</button>
            <div id="deleteModal" class="hidden fixed rounded-md top-11 w-1/2 left-1/2 transform -translate-x-1/2  p-5 bg-white text-black border-4 border-gray-500 z-50">
                <p class="mb-4 text-lg">Are you sure you want to delete the report - '<span class="font-semibold">{{$listing->title}}</span>' ?</p>
        <div class="flex justify-end">
            <button onclick="closeDeleteModal()" class="mr-4 px-4 py-2 text-gray-600 text-sm hover:text-gray-800">Cancel</button>
            <form method="POST" action="/listings/{{$listing->id}}">
                @csrf
                @method ('DELETE')
                <button class="rounded-lg bg-red-500 text-white py-2 px-4 text-sm hover:bg-red-600"><i class="fa-solid fa-trash"></i>
                Delete Report</button>
                </form>
        </div>
            </div>
    </x-card>
    @else
    <x-card class="w-11/12 mx-auto mt-4 p-2 flex space-x-6">
        <div class="rounded-lg bg-black text-white py-2 px-4 hover:text-gray-400">
            <a href="/listings/{{$listing->id}}/download">
                <i class="fa-solid fa-download"></i> Download Report
                </a>
            </div>
        
</x-card>
    @endunless
</div>

</x-layout>