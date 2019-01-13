@extends('layouts.app')

@section('content')
    <div class ="contents row">
        @foreach($tweets as $tweet)
            <div class="content_post" style="background-image: url({{$tweet->image}})">
                <div class="more">
                    <span>
                        <img src="{{ asset('images/arrow_top.png') }}">
                    </span>
                    <ul class="more_list">
                        <li>
                            <a href="/tweet/{{$tweet->id}}">詳細</a>
                        </li>
                        @auth
                            @if ($tweet->user_id == Auth::user()->id)
                                <li>
                                    <a href="/tweet/{{$tweet->id}}/edit">編集</a>
                                </li>
                                <li>
                                    <form action="/tweet/{{$tweet->id}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <input class="more_list_submit_btn" type="submit" value="削除">
                                    </form>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
                <p>{{$tweet->text}}</p>
                <span class="name">
                    <a href="/users/{{$tweet->user_id}}">
                        <span>投稿者</span>
                        <span>{{$tweet->user->name}}</span>
                    </a>
                </span>
            </div>
        @endforeach
    </div>
@endsection
