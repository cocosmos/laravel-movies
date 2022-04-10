<x-app>
    <x-slot name="title">
        Cinemas
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <a class="text-gray-100" href="{{ route('cinema.create') }}">{{__("Create")}}</a>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">{{__("Name")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Address")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Country")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Actions")}}</th>

            </tr>
            </thead>
            <tbody>

            @foreach($cinemas as $cinema)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$cinema->name}}</td>
                    <td class="px-6 py-4">{{$cinema->address}}</td>
                    <td class="px-6 py-4">{{$cinema->country->name}}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{route('cinema.edit', $cinema->id)}}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Edit')}}</a>
                        <a class="delete" href="{{route('cinema.destroy', $cinema->id)}}">{{__("Delete")}}</a></td>
                </tr>

            @endforeach


            </tbody>
        </table>
    </div>
</x-app>
