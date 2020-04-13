@extends('emails.layouts.layout')
@section('content')
    <h1>Un usuario a comentado tu post</h1>
    <p>{{ $comment->content }}</p>
@endsection
