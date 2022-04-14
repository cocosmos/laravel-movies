<x-app>
    <x-slot name="title">
        Filmography
    </x-slot>
    <x-slot name="link">

    </x-slot>
    <div class="flex flex-wrap justify-center">
        <div class=" text-center">
            {{--            <h1 class="text-5xl font-normal leading-normal mt-0 mb-2 text-stone-100">Movies--}}
            {{--                where {{$artist->firstname }} {{$artist->name }} as played--}}
            {{--            </h1>--}}
            <img src="{{asset('storage/uploads/profiles/'.$artist->image)}}"
                 alt="{{$artist->firstname }} {{$artist->name }}" width="200px" height="200px"
                 class="mb-5 rounded-full">
            <h2 class="mb-5 text-xl">{{$artist->firstname }} {{$artist->name }}</h2>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">


        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">{{__("Posters")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Title")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Role")}}</th>
                <th scope="col" class="px-6 py-3">{{__("Country of production")}}</th>

                {{--                <th scope="col" class="px-6 py-3">{{__("Actions")}}</th>--}}

            </tr>
            </thead>
            <tbody>
            @foreach($movies as $movie)

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"><img class=""
                                               src="{{asset('storage/uploads/posters/'.$movie->poster)}}"
                                               alt="{{$movie->title}}" width="100px"
                                               height="150px"></td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$movie->title}}</td>
                    <td class="px-6 py-4">{{$movie->pivot->role}}</td>
                    <td class="px-6 py-4">{{$movie->country->name}}</td>

                {{--                    <td class="px-6 py-4 text-right">--}}
                {{--                        <a href="{{route('movie.detach', ["movie"=>$movie->id, "actor"=>$actor->id])}}"--}}
                {{--                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Detach')}}</a>--}}
                {{--                </tr>--}}
            @endforeach
            </tbody>
        </table>


    </div>

</x-app>
