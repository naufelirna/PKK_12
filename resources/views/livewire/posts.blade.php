<x-slot name="header">
    <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Manage Posts (Laravel 11 Livewire CRUD with Jetstream & Tailwind CSS - ItSolutionStuff.com)
    </h2> -->
</x-slot>

<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Post</button>

            @if($isOpen)
                @include('livewire.create')
            @endif

            <div class="flex">
                <input type="text" wire:model.lazy="search" placeholder="Search..." class="border border-gray-300 p-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button wire:click="search" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg shadow hover:bg-blue-700 transition">
                    🔍
                </button>
            </div>

            <table class="table-fixed w-full border border-gray-300 shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-gray-100 border border-blue-300">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Body</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-300">
                            <td class="border px-4 py-2">{{ $post->id }}</td>
                            <td class="border px-4 py-2">{{ $post->title }}</td>
                            <td class="border px-4 py-2">{{ $post->body }}</td>
                            <td class="border border-gray-300 p-2 flex justify-center gap-2">
                            <button wire:click="edit({{ $post->id }})" class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-700 transition">
                                ✏️
                            </button>
                            <button wire:click="delete({{ $post->id }})" class="bg-red-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-red-700 transition">
                                🗑
                            </button>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
