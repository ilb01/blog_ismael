@extends('layouts.app')
@section('content')
    <h1>Comentarios</h1>
    <ul>
        @foreach($comments as $comment)
            <li>{{ $comment->comment }}</li>
        @endforeach
    </ul>
@endsection
