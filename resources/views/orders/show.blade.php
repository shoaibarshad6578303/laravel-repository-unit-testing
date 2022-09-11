@extends('layouts.app')

@section('content')

<table>
    <thead>
        <th> Cleint </th>
        <th> Details </th>
        <!-- <th> Actions </th> -->
    </thead>
    <tbody>
        <tr>
            <td> {{$order->client}} </td>
            <td> {{$order->details}} </td>
        </tr>
    </tbody>
</table>

@endsection