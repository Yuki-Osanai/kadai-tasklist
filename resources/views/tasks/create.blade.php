@extends('layouts.app')

@section('content')

    <h1>新しいタスクの作成ページ</h1>

    {!! Form::model($task, ['route' => 'tasks.store']) !!}

        {!! Form::label('content', 'メッセージ:') !!}
        {!! Form::text('content') !!}

        {!! Form::submit('作成') !!}

    {!! Form::close() !!}

@endsection