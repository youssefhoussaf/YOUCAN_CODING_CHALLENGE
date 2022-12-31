@extends('layout')

@section('title', "Welcome - Homepage")

@section('main')

    <h1>Welcome</h1>

    <hr class="col-3 col-md-2 mb-5">

    <div class="col-md-6">
        <ul class="icon-list ps-0">
          <li class="d-flex align-items-start mb-1"><a href="/products">Products</a></li>
          <li class="d-flex align-items-start mb-1"><a href="/categories">Categories</a></li>
          <li class="d-flex align-items-start mb-1"><a href="/cli">CLI</a></li>
        </ul>
      </div>

@endsection