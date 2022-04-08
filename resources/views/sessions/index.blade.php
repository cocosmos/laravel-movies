<x-app>
    <x-slot name="title">
        sessions
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <a class="text-gray-100" href="{{ route('session.create') }}">{{__("Create")}}</a>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">{{__("Poster")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Movie Title")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Date")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Start Time")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Finish Time")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Room Name")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Actions")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sessions as $session)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"><img src="{{asset('storage/uploads/posters/'.$session->movie->poster)}}" alt="{{$session->movie->title}}" width="100px" height="150px"></td>

                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$session->movie->title}} <br>{{$session->movie->length}} min</td>
                    <td class="px-6 py-4">{{\Carbon\Carbon::parse($session->start_time)->format('d-m-Y') }} </td>
                    <td class="px-6 py-4">{{\Carbon\Carbon::parse($session->start_time)->format('H:i:s') }} </td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($session->start_time)->addMinutes($session->movie->length)->format('H:i:s')}} </td>
                    <td class="px-6 py-4">{{$session->room->name}}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{route('session.edit', $session->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Edit')}}</a>
                        <a class="delete" href="{{route('session.destroy', $session->id)}}">{{__("Delete")}}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app>
