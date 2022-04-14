<x-app>
    <x-slot name="title">
        Artists
    </x-slot>
    <x-slot name="link">
        <a class="bg-blue-900 hover:bg-blue-800 text-gray-200 font-bold py-2 px-4 rounded inline-flex items-center"
           href="{{ route('artist.create') }}">
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
                <th scope="col" class="px-6 py-3">{{__("Profile")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Name")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Country")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Birthdate")}}</th>
                <th scope="col" class="px-6 py-3 text-right">{{__("Actions")}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($artists as $artist)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                    <td class="px-6 py-4">
                        @if($artist->image)
                            <img src="{{asset('storage/uploads/profiles/'.$artist->image)}}"
                                 alt="{{$artist->firstname." ".$artist->name }}" width="100px"
                                 height="100px" class="rounded-full">
                        @else
                            <img src="{{asset('storage/uploads/profiles/placeholder.jpg')}}"
                                 alt="placeholder" width="100px"
                                 height="100px" class="rounded-full">
                        @endif

                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$artist->firstname}} {{$artist->name}}</td>
                    <td class="px-6 py-4">{{$artist->country->name}}</td>
                    <td class="px-6 py-4">{{$artist->birthdate}}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{route('artist.filmography', $artist->id)}}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Filmography')}}</a>
                        <a href="{{route('artist.edit', $artist->id)}}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Edit')}}</a>
                        <a class="delete" href="{{route('artist.destroy', $artist->id)}}">{{__("Delete")}}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app>
