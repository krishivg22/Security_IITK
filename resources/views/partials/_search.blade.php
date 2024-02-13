 <!-- Search -->
 <div class="p-4 flex w-full items-center justify-between lg:flex-row flex-col gap-2">
 <div class="relative lg:w-1/2 w-full border-2 border-gray-100 rounded-lg">
 <form action="">
        <div class="absolute top-4 left-3">
            <i
                class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
            ></i>
        </div>
        <input
            type="text"
            name="search"
            class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
            placeholder="Search IITK Reports..."
        />
        <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-0 pointer-events-none z-40"></div> 
        <div class="absolute top-0 h-full right-2 flex items-center justify-between">
            <button type="button" onclick="openModalI()" class=" text-gray-400 hover:text-gray-500 m-2"><i class="fa-solid fa-circle-info"></i></button>
            <div class="h-full border border-gray-200 mr-2"></div>
            <button
                type="submit"
                class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
            >
                Search
            </button>
        </div>
</form>
</div>
<div id="infoModal" class="hidden fixed rounded-md top-11 w-1/2 left-1/2 transform -translate-x-1/2  p-5 bg-white text-black border-4 border-gray-500 z-50">
    <div class="w-full flex flex-col items-center justify-between">
        <h1 class="text-xl font-bold mb-4">Search Help</h1>
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

        <ul class="list-disc pl-6 mb-4 text-sm">
            <li><strong>title:</strong> Use keywords to search for reports by title.</li>
            <li><strong>tags:</strong> Search for reports with specific tags or categories.</li>
            <li><strong>reporter:</strong> Find reports submitted by a particular reporter.</li>
            <li><strong>date:</strong> Search for reports based on the submission date.</li>
            <li><strong>status:</strong> Look for reports with a specific status (e.g., "Open," "Closed").</li>
            <li><strong>"words here":</strong> Directly search for an exact phrase.</li>
        </ul>

        <p class="text-gray-700 mb-4 text-sm">
            Search properties separately or combine them (using commas) for specific results.
        </p>

        <p class="text-gray-700 text-sm">
            Examples: 
            <code class="bg-gray-200 p-1">title:Bug Fix,status:Open,</code> ,  
            <code class="bg-gray-200 p-1">date:2023-01-15,</code>
        </p>

    </div>

    <button onclick="closeModalI()" class="mt-3 py-1 px-3 rounded-full text-lg text-white bg-red-500 hover:bg-red-600"><i class="fa-solid fa-xmark"></i></button>
</div>
</div>
<form action="/sort" method="get" class="flex items-center justify-between lg:w-1/3 w-full">
    <div class="bg-gray-200 p-2 text-sm rounded-lg h-10 flex items-center gap-1">
    <label for="sortD">Sort by Date: </label>
    <select name="sortD" id="sortD" onchange="this.form.submit()">
        <option value="0" {{ request('sortD') == 0 ? 'selected' : '' }}>None</option>
        <option value="1" {{ request('sortD') == 1 ? 'selected' : '' }}>Ascending</option>
        <option value="2" {{ request('sortD') == 2 ? 'selected' : '' }}>Descending</option>
    </select>
</div>

<div class="bg-gray-200 p-2 text-sm rounded-lg h-10 flex items-center gap-1">
        <label for="pag">Items per page: </label>
        <select name="pag" id="pag" onchange="this.form.submit()">
            <option value="5" {{ request('pag') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('pag') == 10 ? 'selected' : '' }}>10</option>
            <option value="15" {{ request('pag') == 15 ? 'selected' : '' }}>15</option>
        </select>
</div>
</form>
</div>
