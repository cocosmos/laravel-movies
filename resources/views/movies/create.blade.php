<x-app-layout>
    <x-slot name="title">
        Create Movie
    </x-slot>
    <x-slot name="link">

    </x-slot>
    <form method="POST" action="{{route('movie.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <p>
            <label class="text-gray-100" for="title">Title</label>
            <input type="text" name="title" id="title" value="" required
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </p>
        <p>
            <label class="text-gray-100" for="year">Year</label>
            <input type="number" name="year" id="year" value="" max="2022" min="1900" required
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </p>
        <p>
            <label class="text-gray-100" for="length">Length</label>
            <input type="number" name="length" id="length" value="" max="500" min="20" required
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </p>
        <p>
            <label class="text-gray-100" for="director_id">Director</label>
            <select name="director_id" id="director_id" required
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                @foreach($artists as $artist)
                    <option value="{{$artist->id}}"{{$artist->id == $movie->artist_id ? 'selected="selected"' : ''}}>
                        {{$artist->name}}
                        {{$artist->firstname}}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label class="text-gray-100" for="country_id">Country</label>
            <select name="country_id" id="country_id" required
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                @foreach($countries as $country)
                    <option value="{{$country->id}}"{{$country->id == $movie->country_id ? 'selected="selected"' : ''}}>
                        {{$country->name}}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="poster" class="form-label inline-block mb-2 text-gray-100">Select a poster</label>
            <input type="file" id="poster" name="poster"
                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
        </p>


        <button type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Create
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
</x-app-layout>
