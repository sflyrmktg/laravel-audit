@extends('layouts.app')
@section('content')

    <table>
        @foreach($methods as $method)
            <tr>
                <td>{{$method->id}}</td>
                <td><a href="{{route('methods.records.index',['method'=>$method->id])}}">{{$method->name}}</a></td>
                <td>{{$method->mustbezero}}</td>
            </tr>
        @endforeach
    </table>

@endsection
