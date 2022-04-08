<x-app>
    <x-slot name="title">
        Edit room
    </x-slot>
    <form method="POST" action="{{route('room.update', $room->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{method_field("PUT")}}

        <p>
            <label class="text-gray-100" for="name">{{__("Name")}}</label>
            <input type="text" name="name" id="name" value="{{$room->name}}" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </p>
        <p>
            <label class="text-gray-100" for="size">{{__("size")}}</label>
            <input type="text" name="size" id="size" value="{{$room->size}}" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </p>
        <p>
            <label class="text-gray-100" for="cinema_id">cinema</label>
            <select name="cinema_id" id="cinema_id" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                @foreach($cinemas as $cinema)
                    <option value="{{$cinema->id}}"{{$cinema->id == $room->cinema_id ? 'selected="selected"' : ''}}>
                        {{$cinema->name}}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
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
