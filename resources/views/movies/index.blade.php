<x-app>
    <x-slot name="title">
         Movies
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <a class="text-gray-100" href="{{ route('movie.create') }}">{{__("Create")}}</a>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        <th scope="col" class="px-6 py-3">{{__("Movie Poster")}}</th>
        <th scope="col" class="px-6 py-3">{{__("Movie Name")}}</th>
        <th scope="col" class="px-6 py-3">{{__("Year")}}</th>
        <th scope="col" class="px-6 py-3">{{__("Director Name")}}</th>
        <th scope="col" class="px-6 py-3">{{__("Country Name")}}</th>
        <th scope="col" class="px-6 py-3">{{__("Movie Length")}}</th>
        <th scope="col" class="px-6 py-3">{{__("Actions")}}</th>

    </tr>
</thead>
<tbody>
    @foreach($movies as $movie)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td class="px-6 py-4"><img src="{{asset('storage/uploads/posters/'.$movie->poster)}}" alt="{{$movie->title}}" width="100px" height="150px"></td>
        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$movie->title}}</td>
        <td class="px-6 py-4">{{$movie->year}}</td>
        <td class="px-6 py-4">{{$movie->director->firstname}} {{$movie->director->name}}</td>
        <td class="px-6 py-4">{{$movie->country->name}}</td>
        <td class="px-6 py-4">{{$movie->length}} min</td>
        <td class="px-6 py-4 text-right">
            <a href="{{route('movie.edit', $movie->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Edit')}}</a>
            <a class="delete" href="{{route('movie.destroy', $movie->id)}}">{{__("Delete")}}</a></td>
    </tr>
    @endforeach
</tbody>
</table>
</div>

</x-app>
