<x-app>
    <x-slot name="title">
        Actors for : {{$movie->title}}
    </x-slot>
    <div class="flex flex-wrap justify-center">
        <div class=" text-center">
            <h1 class="text-5xl font-normal leading-normal mt-0 mb-2 text-stone-100">Actors for : <br> {{$movie->title}}
            </h1>
            <img src="{{asset('storage/uploads/posters/'.$movie->poster)}}"
                 alt="{{$movie->title}}" width="500px" height="500px">
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">


        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">{{__("Profiles")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Actors Name")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Role")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Birthdate")}}</th>

                <th scope="col" class="px-6 py-3">{{__("Actions")}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($actors as $actor)

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"><img class="rounded-full"
                                               src="{{asset('storage/uploads/profiles/'.$actor->image)}}"
                                               alt="{{$actor->firstname. " ". $actor->name}}" width="100px"
                                               height="150px"></td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$actor->firstname. " ". $actor->name}}</td>
                    <td class="px-6 py-4">{{$actor->pivot->role}}</td>
                    <td class="px-6 py-4">{{$actor->birthdate}}</td>

                    <td class="px-6 py-4 text-right">
                        <a href="{{route('movie.edit', $movie->id)}}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Edit')}}</a>
                        <a class="delete" href="{{route('movie.destroy', $movie->id)}}">{{__("Delete")}}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-app>
