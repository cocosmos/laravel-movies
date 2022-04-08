<x-app>
    <x-slot name="title">
        Create session
    </x-slot>
    <form method="POST" action="{{route('session.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <p>
            <label class="text-gray-100" for="movie_id">Movie</label>
            <select name="movie_id" id="movie_id" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                @foreach($movies as $movie)
                    <option value="{{$movie->id}}"{{$movie->id == $movie->movie_id ? 'selected="selected"' : ''}}>
                        {{$movie->title}}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label class="text-gray-100" for="room_id">room</label>
            <select name="room_id" id="room_id" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                @foreach($rooms as $room)
                    <option value="{{$room->id}}"{{$room->id == $room->room_id ? 'selected="selected"' : ''}}>
                        {{$room->name}}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label class="text-gray-100" for="start_time">Date and time of the session</label>
            <input type="datetime-local" name="start_time" id="start_time" value="" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </p>

        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create</button>
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
</x-app>
