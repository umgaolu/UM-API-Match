@extends('layouts.master')

@section('data')
<h2>Data</h2>
<div class="table-responsive">
<table class="table table-striped table-sm">
  <thead>
    <tr>
    @foreach($fields as $field)
          <th>{{ucwords($field)}}</th>
    @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach($collections as $c)
<!--       <tr>
        <td>{{$c->}}</td>
        <td>{{$c->}}</td>
        <td>{{$c->}}</td>
        <td>{{json_encode($c->)}}</td>
        <td>{{json_encode($c->)}}</td>
      </tr> -->
  @endforeach
  </tbody>
</table>
</div>
@endsection
