<x-app-layout>
    <x-slot name="header">Hosgeldiniz Efendimiz. {{$users->name}} guncellemeye hazir </x-slot>
    <div class="card">
        <div class="card-body">
                deneme
            <form method="POST" action="{{route('users.update',$users->id)}}" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div class="form-group">
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User E-Mail</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Tamam</th>
                </tr>
                </thead>
                    <tbody>
                    <tr>
                        <td>{{$users->id}}</td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->email}}</td>
                        <td>{{$users->type}}</td>
                        <td>
                        <div class="form-group">
                            <button type="submit" name="type" value="admin" onclick="this.form.submit()" class="btn btn-success btn-sm btn-block" style="width: 100%"> Make Admin</button>
                            <button type="submit" name="type" value="user" onclick="this.form.submit()" class="btn btn-warning btn-sm btn-block" style="width: 100%"> Make User</button>
                        </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
