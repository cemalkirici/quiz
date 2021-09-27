<x-app-layout>
    <x-slot name="header"> {{$quiz->title}} </x-slot>
    <div class="card">
        <div class="card-body">
            <p class="card-text">

            <h5 class="card-title">
                <a href="{{Route('quizzes.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Go Back To Quizzes</a>
            </h5>

            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Soru sayisi
                            <span class="badge btn-secondary badge-pill" >{{$quiz->questions_count}}</span>
                        </li>

                        @if($quiz->details)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Katilimci sayisi
                                <span class="badge btn-warning badge-pill">{{$quiz->details['join_count']}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ortalama Puan
                                <span class="badge btn-warning badge-pill">{{$quiz->details['average']}}</span>
                            </li>
                        @endif
                    </ul>

                    @if(count($quiz->topTen)>0)
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title"> Ilk 10 </h5>
                                <ul class="list-group">
                                    @foreach($quiz->topTen as $result)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong class="h5">{{$loop->iteration}}.</strong>
                                            <img class="w-8 h-8 rounded-full" src="{{$result->user->profile_photo_url}}">

                                            <span @if(auth()->user()->id==$result->user_id) class="text-danger" @endif>{{$result->user->name}}</span>
                                            <span class="badge btn-success badge-pill">{{$result->point}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    {{$quiz->description}}

                    <table class="table table-bordered table-mt-3">
                        <thead>
                        <tr>
                            <th scope="col">Ad Soyad</th>
                            <th scope="col">Puan</th>
                            <th scope="col">Dogru</th>
                            <th scope="col">Yanlis</th>
                            <th scope="col">Islem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quiz->results as $result)
                        <tr>
                            <td>{{$result->user->name}}</td>
                            <td>{{$result->point}}</td>
                            <td>{{$result->correct}}</td>
                            <td>{{$result->wrong}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    </p>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
