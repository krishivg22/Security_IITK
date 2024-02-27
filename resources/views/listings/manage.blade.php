<x-layout>
    <div class="mx-4">
        <x-card class='p-10'>
            <header>
                <h1
                    class="text-2xl text-center font-bold my-6 uppercase"
                >
                    Manage Reports
                </h1>
            </header>

            <table class="w-full table-auto rounded-sm">
                <tbody>
                    @unless($listings->isEmpty())
                    @foreach($listings as $listing)
                    <tr class="border-gray-300">
                        <td
                            class="px-4 py-8 capitalize border-t border-b border-gray-300 text-lg font-semibold"
                        >
                            <a href="/listings/{{$listing->id}}">
                                {{$listing->title}}
                            </a>
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-sm"
                        >
                        <div class="flex justify-center items-center ">
                        <div class="inline rounded-lg bg-black text-white py-2 px-4 hover:text-gray-400">
                            <a href="/listings/{{$listing->id}}/edit">
                            <i class="fa-solid fa-pencil"></i> Edit
                            </a>
                            </div>
                        </div>
                        </td>
                        <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-0 pointer-events-none z-40"></div>  
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-sm"
                        >
                        <div class="flex justify-center items-center ">
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
                        </div>
                        </td>
                    </tr>
@endforeach
@else
<tr class="border-gray-300">
<td class="px-4 py-8 border-t border-b
border-gray-300 text-lg">
<p class="text-center">No Listings Found</p>
</td>
</tr>
@endunless
                </tbody>
            </table>
        </x-card>
    </div>
</x-layout>