<x-app>
    <x-slot name="title">
        Rooms
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <a class="text-gray-100" href="{{ route('room.create') }}">{{__("Create")}}</a>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">{{__("Name")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Size")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Cinema")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Actions")}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($rooms as $room)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$room->name}}</td>
                    <td class="px-6 py-4">{{$room->size}} seats</td>
                    <td class="px-6 py-4">{{$room->cinema->name}}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{route('room.edit', $room->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Edit')}}</a>
                        <a class="delete" href="{{route('room.destroy', $room->id)}}">{{__("Delete")}}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app>
