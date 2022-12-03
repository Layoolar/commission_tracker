@extends('layout')

@section('content')


{{-- <div class="row mb-3">
        <label for="address">Distributor</label>
        <input type="text" name="distr" class="form-control" id="distr">
    </div> --}}
<form method="GET">
<div class="row mb-3">
        <div class="col">
            <label for="dob">Between</label>
            <input type="date" name="start" class="form-control" id="start" required>
        </div>

        <div class="col">
            <label for="pic">And</label>
            <input type="date" name="end" class="form-control" id="end" required>
        </div>
    </div>
    <input type="submit" value="Submit">

<table class="table table-primary m-3">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Invoice</th>
      <th scope="col">Purchaser</th>
      <th scope="col">Distributor</th>
      <th scope="col">Referred</th>
      <th scope="col">Date</th>
      <th scope="col">Per</th>
      <th scope="col">Commission</th>
    </tr>
  </thead>
  <tbody>
    @php
    if (isset($_GET['page'])) {
    $j = $_GET['page'];
        $count = $j*10+1;
    } else {$count=1;}

    @endphp
    {{-- @php($count = 1) --}}

    @foreach ($orders as $p)
    @if (isset($_GET['distr']) && $p->purchaser->referral->id !=$_GET['distr'])
        @continue
    @endif

    <tr>
      {{-- <td scope="row">{{$count++}}</td> --}}
      <td scope="row">{{$count++}}</td>
      <td scope="row">{{$p->invoice_number}}</td>
      <td scope="row">{{$p->purchaser->first_name.' '.$p->purchaser->last_name}}</td>
      <td scope="row">{{$p->purchaser->referral ? $p->purchaser->referral->first_name. " ".$p->purchaser->referral->last_name : ''}}</td>
      <td scope="row">{{$p->purchaser->referral ? $p->purchaser->referral->number_referred($p->order_date) : '' }}</td>
      <td scope="row">{{$p->modified_order_date}}</td>
      <td scope="row">{{$p->percentage().'%'}}</td>
      <td scope="row">{{$p->commission()}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
    <div class="mt-4 p-4">
        {{-- {{ $orders->appends($_GET)->links() }} --}}
        {{ $orders->appends($_GET)->links() }}
    </div>
@endsection
