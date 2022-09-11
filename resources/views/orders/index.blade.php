@extends('layouts.app')

@section('content')

<div> Index Order </div>
<table>
    <thead>
        <th> Cleint </th>
        <th> Details </th>
        <th> Actions </th>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td> {{$order->client}} </td>
            <td> {{$order->details}} </td>
            <td> 
                <a href="{{url('orders/'.$order->id)}}" > Show </a> 
                <form action="{{route('orders.edit', $order->id)}}" method="get">
                    @csrf
                    @method('EDIT')
                  <button type="submit" > Edit </button>
                </form>
            
                <form action="{{route('orders.destroy', $order->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                  <button type="submit" > Delete </button>
                </form>
                  
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection