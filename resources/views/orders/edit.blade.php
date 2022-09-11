@extends('layouts.app')

@section('content')

<div> Update User </div>

<div>
    <form method="post" action="{{route('orders.update', $order->id)}}">
        @csrf
        @method('put')
        <input type="hidden" name="id" value="{{$order->id}}">
        <div>
            <lable> Client Name </label>
            <input name="client" value="{{$order->client}}">
        </div>
        @if($errors->has('client'))
            <div class="error">{{ $errors->first('client') }}</div>
        @endif
        <div>
            <lable> Details </label>
            <input name="details" value="{{$order->details}}">
        </div>
        @if($errors->has('details'))
            <div class="error">{{ $errors->first('details') }}</div>
        @endif
        <div> <input type="submit" name="save">  </div>
    </form>
</div>
@endsection