@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div>
                        <div>
                            <a>სახელი: {{$user->name}}</a>
                        </div>
                        <div>
                            <a>იმეილი: {{$user->email}}</a>
                        </div>
                        @foreach($user->products as $product)
                        @if(Auth::user()->id==$product->user_id)
                            <div class="mt-10"><br><br>
                                <a>პოსტის სახელი: {{$product->name}}</a>
                            </div>
                            <div>
                                <a>პოსტის ტექსტი: {{$product->price}}</a>
                            </div>
                            <div>
                                <a  href="{{route('post.show', $product->id)}}" >
                                        <img class="h-25 w-25" src="{{asset('uploads/product/'.$product->image)}}" alt="">
                                </a>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
