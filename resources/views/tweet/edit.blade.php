@extends('layouts.app')

@section('content')
    <div class="contents row">
        <div class="inner_container">
            @if (count($errors) > 0)
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/tweet/{{$tweet->id}}" method="post">
                {{csrf_field()}}
                {{ method_field('patch') }}
                <h3>更新する</h3>
                <input placeholder="Image URL" type="text" name="image" value="{{$tweet->image}}">
                <textarea cols="30" name="text" placeholder="text" rows="10">{{$tweet->text}}</textarea>
                <input type="submit" value="SENT">
            </form>
        </div>
    </div>
@endsection
