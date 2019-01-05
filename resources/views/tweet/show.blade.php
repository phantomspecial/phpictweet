@extends('layouts.app')

@section('content')
    <div class ="contents row">
        <div class="content_post" style="background-image: url({{$tweet->image}})">
            @auth
                @if ($tweet->user_id == Auth::user()->id)
                    <div class="more">
                        <span>
                            <img src="{{ asset('images/arrow_top.png') }}">
                        </span>
                        <ul class="more_list">
                            <li>
                                <a href="/tweet/{{$tweet->id}}/edit">編集</a>
                            </li>
                            <li>
                                <form action="/tweet/{{$tweet->id}}" method="post">
                                    {{csrf_field()}}
                                    {{ method_field('delete') }}
                                    <input class="more_list_submit_btn" type="submit" value="削除">
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            @endauth
            <p>{{$tweet->text}}</p>
    		<span class="name">
	    		<a href="/users/{{$tweet->user_id}}">
                    <span>投稿者</span>
                    <span>{{$tweet->user->name}}</span>
			    </a>
		    </span>
	    </div>
    </div>
@endsection
