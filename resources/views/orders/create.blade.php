@extends('layouts.app')

@section('content')
<div> Create User </div>

<div>
    <form method="post" action="{{url('orders')}}">
        @csrf
        <div>
            <lable> Client Name</label>
            <input name="client" >
        </div>
        @if($errors->has('client'))
            <div class="error">{{ $errors->first('client') }}</div>
        @endif
        <div>
            <lable> Details</label>
            <input name="details" >
        </div>
        @if($errors->has('details'))
            <div class="error">{{ $errors->first('details') }}</div>
        @endif
        <div> <input type="submit" name="save">  </div>
    </form>
</div>
@endsection