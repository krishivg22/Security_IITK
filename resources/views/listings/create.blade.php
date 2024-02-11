@php
$options=['open'=>'open','closed'=>'closed',];
@endphp
<x-layout>
<x-card
                    class="p-10 max-w-lg mx-auto mt-24"
                >
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-4">
                            New Report
                        </h2>
                    </header>

                    <form method="POST" action="/listings" enctype="multipart/form-data">        {{--action means idhar form submit hoga--}}
                        @csrf       {{--koi aur website se humare yaha data store nhi krne dega--}}

                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2"
                                >Title</label
                            >
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="title"
                                placeholder="Example: Leopard in Campus"
                                value="{{old('title')}}"
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
                                value="{{old('venue')}}"
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
                            <input type="date" id="date_input" class="border border-gray-200 rounded" name="date" value="{{old('date')}}">
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
                            <input type="time" id="time_input" class="border border-gray-200 rounded" name="time" value="{{old('time')}}">
                            @error('time')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="mr-2 inline-block text-lg mb-2" for="status">Select Status:</label>
    <select name="status" id="select_field" class="border border-gray-200 rounded">
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
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
                                value="{{old('tags')}}"
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
                                padding: 50px;
                                text-align: center;
                        
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
                                
                            >{{old('description')}}</textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <button
                                class="bg-red-500 text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Create Report
                            </button>

                            <a href="/" class="text-black ml-4"> Back </a>
                        </div>
                    </form>
</x-card>
</x-layout>