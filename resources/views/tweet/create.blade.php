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

            <form action="/tweet" method="post">
                {{csrf_field()}}
                <h3>投稿する</h3>
                <input placeholder="Image URL" type="text" name="image" value="{{old('image')}}">
                <textarea cols="30" name="text" placeholder="text" rows="10">{{old('text')}}</textarea>
                <input type="submit" value="SENT">
            </form>
        </div>
    </div>
@endsection
