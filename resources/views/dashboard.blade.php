<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($isregistration === 1)
                        <table>
                            <thead>
                            <tr>
                                <th> day </th>
                                <th> auth_code </th>
                                <th> status </th>
                            </tr>
                            </thead>

                                @foreach($test as $key => $value)
                                    <tr>
                                        <td>{{$value->day}}</td>
                                        <td>{{$value->auth_code}}</td>
                                        @if($value->status === 1)
                                            <td>passed</td>
                                        @elseif($value->status === 2)
                                            <td>verified</td>
                                        @else
                                            <td>cancle</td>
                                        @endif
                                    </tr>
                                @endforeach

                        </table>
                    @else
                        <a>no registration yet</a>
                    @endif

                </div>
            </div>

        </div>
    </div>

{{--    <a>{{$test}}</a>--}}
</x-app-layout>
