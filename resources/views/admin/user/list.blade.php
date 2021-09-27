<x-app-layout>
    <x-slot name="header">Hosgeldiniz Efendimiz... {{$adminsayi}} admin ve {{$usersayi}} user kulunuz mevcut</x-slot>
    <div class="card">
        <div class="card-body">

            <form method="GET" action="">
                <div class="form-row">
                    <div class="col-md-2 float-left">
                        <input type="text" name="name" onchange="this.form.submit()" value="{{request()->get('name')}}"
                               placeholder="User Name" class="form-control">
                    </div>
                    <div class="col-md-2 float-left">
                        <select class="form-control" name="type" onchange="this.form.submit()">
                            <option value="">Type</option>
                            <option @if(request()->get('type')=='admin') selected @endif  value="admin">Admin</option>
                            <option @if(request()->get('type')=='user') selected @endif  value="user">User</option>
                        </select>
                    </div>
                    @if(request()->get('name') || request()->get('type'))
                        <div class="col-md-2  float-left">
                            <a href="{{route('users.index')}}" class="btn btn-secondary">Clear Filter</a>
                        </div>
                    @endif
                </div>
            </form>
            <table class="table table-bordered table-sm ">
                <thead>
                <tr>
                    <th>Foto</th>
                    <th scope="col">Siralama</th>
                    <th scope="col">Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User E-Mail</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Edit</th>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tbody>
                    <tr>
                        <td><img class="w-8 h-8 rounded-full"
                                 src="{{$user->profile_photo_url}}">
                        </td>
                        <td>{{$loop->iteration}}.</td>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->type=='admin')
                                <span class="badge btn-success badge-pill">{{$user->type}} </span>
                            @else
                                <span class="badge btn-primary badge-pill">{{$user->type}} </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-pen"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
            {{ $users->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>
