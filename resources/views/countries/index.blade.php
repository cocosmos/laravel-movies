<x-app-layout>
    <x-slot name="title">
        Countries
    </x-slot>
    <x-slot name="link">
        <a class="bg-blue-900 hover:bg-blue-800 text-gray-200 font-bold py-2 px-4 rounded inline-flex items-center"
           href="{{ route('country.create') }}">
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
                <th scope="col" class="px-6 py-3">{{__("Name")}}</th>
                @auth()
                    <th scope="col" class="px-6 py-3 text-right">{{__("Actions")}}</th>
                @endauth

            </tr>
            </thead>
            <tbody>
            @foreach($countries as $country)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row"
                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$country->name}}</td>
                    <x-buttons>
                        <x-slot name="specialLink"></x-slot>
                        <x-slot name="editLink">{{route('country.edit', $country->id)}}</x-slot>
                        <x-slot name="deleteLink">{{route('country.destroy', $country->id)}}</x-slot>
                    </x-buttons>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include("components.script")

</x-app-layout>
