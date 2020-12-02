@extends('layouts.app')

@section('content')


    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active h3" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Новые</a>
            <a class="nav-item nav-link h3" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">В работе</a>
            <a class="nav-item nav-link h3" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Завершенные</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active border" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <table class="table">
            <tbody>
            @foreach ($projectsNew as $project)
                <tr>
                    <td>
                        <div class= "d-flex justify-content-between">
                        <a class ="h3" href="/project/{{ $project->id }}">{{ $project->name }}</a>
                            <h3 class="mr-5">{{$project->budget}} тг</h3>
                        </div>
                        <h6>{{ $project->description }} </h6>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <table class="table">
                <tbody>
                @foreach ($projectsInProgres as $project)
                    <tr>
                        <td>
                            <div class= "d-flex justify-content-between">
                            <a class ="h3" href="/project/{{ $project->id }}">{{ $project->name }}</a>
                                <h3 class="mr-5">{{$project->budget}} тг</h3>
                            </div>
                            <h6>{{ $project->description }} </h6>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <table class="table">
                <tbody>
                @foreach ($projectsDone as $project)
                    <tr>
                        <td>
                            <div class= "d-flex justify-content-between">
                            <a class ="h3" href="/project/{{ $project->id }}">{{ $project->name }}</a>
                                <h3 class="mr-5">{{$project->budget}} тг</h3>
                            </div>
                            <h6>{{ $project->description }} </h6>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
