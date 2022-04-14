<x-app>
    <x-slot name="title">
        Test
    </x-slot>
    <x-slot name="link">

    </x-slot>
    <form method="POST" action="{{route('artist.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <p>
            <label class="text-gray-100" for="name">Name</label>
            <input type="text" name="name" id="name" value="" required
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </p>
        <p>
            <label class="text-gray-100" for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname" value="" required
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </p>
        <p>
            <label class="text-gray-100" for="birthdate">Birthdate</label>
            <input type="number" name="birthdate" id="birthdate" value="" max="2010" min="1910"
                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </p>
        <p>
            <label class="text-gray-100" for="country_id">Country</label>
            <select name="country_id" id="country_id" required
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                @foreach($countries as $country)
                    <option
                        value="{{$country->id}}"{{$country->id == $artist->country_id ? 'selected="selected"' : ''}}>
                        {{$country->name}}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="image" class="form-label inline-block mb-2 text-gray-100">Select a profile image</label>
            <input type="file" id="image" name="image"
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
</x-app>
