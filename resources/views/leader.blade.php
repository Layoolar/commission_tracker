@extends('layout');

@section('content')
<table class="table table-primary m-3">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col" colspan="2">Name</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td colspan="2">Mark</td>
      <td>Otto</td>
    </tr>
    {{-- @foreach ($results as $r)
    <tr>
      <th scope="row">2</th>
      <td colspan="2">{{$r['fname']}}. " ". {{$r['lname']}}</td>
      <td>{{$r['amount']}}</td>
    </tr>
    @endforeach --}}
  </tbody>
</table>
@endsection
