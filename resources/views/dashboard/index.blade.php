@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="subheader">Friends</h2>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->friends as $friend)
                <tr>
                    <td><img src="{{url($friend->fotografiaPerfil)}}" class="img-circle" width="40px" height="40px"></img></td>
                    <td>{{ $friend->name }}</td>
                    <td>{{ $friend->email }}</td>
                    <td><a href="{{url('dashboard/remove-friend/'. $friend->id)}}">Remove friend</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="subheader">Més gent</h2>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($not_friends as $friend)
                <tr>
                    <td>{{ $friend->name }}</td>
                    <td>{{ $friend->email }}</td>
                    <td><a href="{{url('dashboard/add-friend/'. $friend->id)}}">Add friend</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
