@extends('layouts.app')

@section('content')

    <div  class="block table-responsive">
        <table class="table table-bordered table-striped">
                <tr >
                    <th scope="col"></th>
                    @for($i = 0; $i < $dayCount; $i++)
                        <th scope="col" class='text-center'>{{ $i+1 }}</th>
                    @endfor
                </tr>
                @foreach($hours as $hour)
                    <tr class="{{$hour['value'] =='Lunch' ? 'bg-warning' : ''}}">
                        <th scope="row">{{ $hour['value'] }}</th>
                        @foreach($worksByDay as $day)
                            <th scope="col" class="{{ $day['hours'] + 9 >= $hour['hour'] && $hour['value'] != 'Lunch' ? 'bg-primary' : '' }}"></th>
                        @endforeach
                    </tr>
                @endforeach
        </table>
    </div>

@endsection
