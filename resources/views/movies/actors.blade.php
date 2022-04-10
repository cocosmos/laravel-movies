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
                        <a href="{{route('movie.detach', ["movie"=>$movie->id, "actor"=>$actor->id])}}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Detach')}}</a>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form method="POST" action="{{route('movie.attach', $movie->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <p>
                <label class="text-gray-100" for="role">Role</label>
                <input type="text" name="role" id="role" value="" required
                       class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
            </p>
            <p>
                <label class="text-gray-100" for="artist_id">Actors</label>
                <select name="artist_id" id="artist_id" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    @foreach($artists as $artist)
                        <option
                            value="{{$artist->id}}"{{$artist->id == $movie->artist_id ? 'selected="selected"' : ''}}>
                            {{$artist->name}}
                            {{$artist->firstname}}
                        </option>
                    @endforeach
                </select>
            </p>
            <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Attach
            </button>
        </form>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if (session("ok"))
            <div>
                {{session("ok")}}
            </div>

        @endif
    </div>

</x-app>
