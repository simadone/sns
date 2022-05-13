@extends('layouts.login')

@section('content')

 <div class='container'>
        <h2 class='page-header'>新しく投稿をする</h2>
        {!! Form::open(['url' => 'post/create']) !!}
        <div class="form-group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
        </div>
        <button type="submit" class="btn btn-success pull-right">追加</button>
        {!! Form::close() !!}
    </div>

<table class='table table-hover'>
    <tr>
        <th></th>
        <th></th>
    </tr>
            @foreach ($lists as $list)
            <tr>
                <td><img src="/images/{{$list->images}}" alt=""></td>
                <td>{{ $list->username }}</td>
                <td>{{ $list->posts }}</td>
                <td>{{ $list->created_at }}</td>
                 <td><a class="btn btn-primary" data-target="{{$list->id}}" href="/post/{{$list->id}}/update-form">更新</a></td>
                 <td><a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
            </tr>

    <div class="update-form" id="{{$list->id}}">
            {!! Form::open(['url' => '/post/update']) !!}
        <div class="form-group">
            {!! Form::hidden('id', $list->id) !!}
            {!! Form::input('text', 'upPost', $list->posts, ['required', 'class' => 'form-control']) !!}
        </div>
        <button type="submit" class="btn pull-right">更新</button>
        {!! Form::close() !!}
    </div>

            @endforeach
        </table>

@endsection
