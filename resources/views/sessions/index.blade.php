<x-app-layout>
    <x-slot name="title">
        Sessions
    </x-slot>
    <x-slot name="link">
        <a class="bg-blue-900 hover:bg-blue-800 text-gray-200 font-bold py-2 px-4 rounded inline-flex items-center"
           href="{{ route('session.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-plus-circle w-5 h-5 mr-2 ">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="16"/>
                <line x1="8" y1="12" x2="16" y2="12"/>
            </svg>
            <span> {{__("Create")}}</span>
        </a>
    </x-slot>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">{{__("Poster")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Title")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Begin")}}</th>
                {{--                <th scope="col" class="px-6 py-3">{{__("Start Time")}}</th>--}}
                <th scope="col" class="px-6 py-3">{{__("Finish at")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Cinema")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Room")}}</th>
                @auth()
                    <th scope="col" class="px-6 py-3 text-right">{{__("Actions")}}</th>
                @endauth
            </tr>
            </thead>
            <tbody>
            @foreach($sessions as $session)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-300">
                    <td class="px-6 py-4"><img src="{{asset('storage/uploads/posters/'.$session->movie->poster)}}"
                                               alt="{{$session->movie->title}}" width="200px" height="150px"></td>

                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap text-center">
                        <span class="text-lg">{{$session->movie->title}}</span>
                        <br><span>{{$session->movie->length}} min</span>

                    </td>
                    <td class="px-6 py-4 text-base text-center">{{\Carbon\Carbon::parse($session->start_time)->format('l d.m.Y H:i') }} </td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($session->start_time)->addMinutes($session->movie->length)->format('H:i')}} </td>
                    <td class="px-6 py-4">{{$session->room->cinema->name}}</td>
                    <td class="px-6 py-4">{{$session->room->name}}</td>
                    <x-buttons>
                        <x-slot name="specialLink"></x-slot>

                        <x-slot name="editLink">{{route('session.edit', $session->id)}}</x-slot>
                        <x-slot name="deleteLink">{{route('session.destroy', $session->id)}}</x-slot>
                    </x-buttons>
                   
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include("components.script")

</x-app-layout>
