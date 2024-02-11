@php
$options=['open'=>'open','closed'=>'closed',];
$defaultV=$listing['status'];
@endphp
<x-layout>
<x-card
                    class="p-10 max-w-lg mx-auto mt-24"
                >
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-4">
                            Edit Report
                        </h2>
                    </header>

                    <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">        {{--action means idhar form submit hoga--}}
                        @csrf       {{--koi aur website se humare yaha data store nhi krne dega--}}
                      @method('PUT')
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2"
                                >Title</label
                            >
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="title"
                                placeholder="Example: Leopard in Campus"
                                value="{{$listing->title}}"
                            />
                            @error('title')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label
                                for="venue"
                                class="inline-block text-lg mb-2"
                                >Venue</label
                            >
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="venue"
                                placeholder="Example: CCD, L-18, etc."
                                value="{{$listing->venue}}"
                            />
                            @error('venue')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label
                                for="date"
                                class="inline-block text-lg mb-2 mr-2"
                                >Date :</label
                            >
                            <input type="date" id="date_input" class="border border-gray-200 rounded" name="date" value="{{$listing->date}}">
                            @error('date')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label
                                for="time"
                                class="inline-block text-lg mb-2 mr-2"
                                >Time :</label
                            >
                            <input type="time" id="time_input" class="border border-gray-200 rounded" name="time" value="{{$listing->time}}">
                            @error('time')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="mr-2 inline-block text-lg mb-2" for="status">Select Status:</label>
    <select name="status" class="border border-gray-200 rounded" id="select_field">
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{$value==$defaultV ? 'selected':''}}>{{ $label }}</option>
        @endforeach
    </select>
                            @error('status')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>


                        <div class="mb-6">
                            <label for="tags" class="inline-block text-lg mb-2">
                                Tags (Comma Separated)
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="tags"
                                placeholder="Example: leopard, harassment, etc."
                                value="{{$listing->tags}}"
                            />
                            @error('tags')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="attachment" class="inline-block text-lg mb-2">
                                Attachments
                            </label>
                            <input
                                type="file"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="attachment[]"
                                id="logoInput"
                                multiple />
                                <ul class="m-4 flex items-center justify-center gap-8">
                                    @if($listing->attachment ==NULL)
                                    <li class='text-lg'>No Attachments found</li>
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
                                    <button class="text-lg text-blue-500 hover:text-blue-700">
                                    <li><a href="{{asset('storage/'.$attachment)}}">{{$i}}</a></li>
                                </button>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                    @endforeach
                                    @endif
                                </ul>
                            <div class="drag-and-drop" id="dragAndDrop">
                                <p>Drag and drop your file here</p>
                            </div>
                            <p id="fileError" class="text-red-500 text-xs mt-1"></p>
                        </div>
                        
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
                                                    <button type="button" class="bg-red-500 text-white text-xs rounded-full py-1 px-2 m-1" onclick="removeFile(${i})"> <i class="fa-solid fa-xmark"></i></button>
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
                        </script>
                        
                        <style>
                            .drag-and-drop {
                                border: 2px dashed #ccc;
                                padding:50px;
                                text-align: center;
                                cursor: pointer;
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
                        </style>
                            @error('attachment')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        

                        <div class="mb-6">
                            <label
                                for="description"
                                class="inline-block text-lg mb-2"
                            >
                                Description
                            </label>
                            <textarea
                                class="border border-gray-200 rounded p-2 w-full"
                                name="description"
                                rows="10"
                                placeholder="Include description about what happened, prime suspects etc."
                                
                            >{{$listing->description}}</textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <button
                                class="bg-red-500 text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Update Report
                            </button>

                            <a href="/" class="text-black ml-4"> Back </a>
                        </div>
                    </form>
</x-card>
</x-layout>