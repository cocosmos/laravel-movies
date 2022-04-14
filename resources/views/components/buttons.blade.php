@auth()
    <td class="px-6 py-4 text-right">

        <div class="flex align-items-center justify-end">
            {{$specialLink}}
            <a
                href="{{$editLink}}"
                class=" text-blue-600 dark:text-blue-500 hover:underline mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="25px"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round"
                     class="feather feather-edit text-xs">
                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                    <title>Edit</title>

                    <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                </svg>
            </a>
            <a class="delete text-red-700" href="{{$deleteLink}}">
                {{__("Delete")}}
                {{--                Need to change script js if we want the scg works--}}
                {{--                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 58.67" width="25px">--}}
                {{--                    <defs>--}}
                {{--                        <style>.cls-1 {--}}
                {{--                                fill: #9e0300;--}}
                {{--                            }</style>--}}
                {{--                    </defs>--}}
                {{--                    <title>Delete</title>--}}
                {{--                    <g id=" Layer_2--}}
                {{--                 " data-name="Layer 2">--}}
                {{--                        <g id="Layer_1-2" data-name="Layer 1">--}}
                {{--                            <path class="cls-1"--}}
                {{--                                  d="M61.33,5.33H48V2.67A2.66,2.66,0,0,0,45.33,0H18.67A2.66,2.66,0,0,0,16,2.67V5.33H2.67a2.67,2.67,0,0,0,0,5.34H8v40a8,8,0,0,0,8,8H48a8,8,0,0,0,8-8v-40h5.33a2.67,2.67,0,1,0,0-5.34ZM50.67,50.67A2.67,2.67,0,0,1,48,53.33H16a2.67,2.67,0,0,1-2.67-2.66v-40H50.67Z"/>--}}
                {{--                            <path class="cls-1"--}}
                {{--                                  d="M24,45.33a2.67,2.67,0,0,0,2.67-2.66V21.33a2.67,2.67,0,0,0-5.34,0V42.67A2.67,2.67,0,0,0,24,45.33Z"/>--}}
                {{--                            <path class="cls-1"--}}
                {{--                                  d="M40,45.33a2.67,2.67,0,0,0,2.67-2.66V21.33a2.67,2.67,0,0,0-5.34,0V42.67A2.67,2.67,0,0,0,40,45.33Z"/>--}}
                {{--                        </g>--}}
                {{--                    </g>--}}
                {{--                </svg>--}}
            </a>
        </div>
    </td>
@endauth
