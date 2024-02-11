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
            placeholder="Search IITK Reports using filters: title:__ ,status:__ ,date:__ ,etc."
        />
        <div class="absolute top-2 right-2">
            <button
                type="submit"
                class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
            >
                Search
            </button>
        </div>
</form>
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