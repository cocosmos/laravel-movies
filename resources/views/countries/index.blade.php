<x-app>
    <x-slot name="title">
       Country list
    </x-slot>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        <th scope="col" class="px-6 py-3">{{__("Name")}}</th>
        <th scope="col" class="px-6 py-3">{{__("Actions")}}</th>

    </tr>
</thead>
<tbody>
    @foreach($countries as $country)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$country->name}}</td>
        <td class="px-6 py-4 text-right">
            <a href="{{route('country.edit', $country->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Edit')}}</a> 
            <a class="delete" href="{{route('country.destroy', $country->id)}}">{{__("Delete")}}</a></td> 
    </tr>
    @endforeach
</tbody>
</table>
</div>
</x-app>