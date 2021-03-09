@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">@if($header != '') {{$header}} @else Items @endif</div>
                <div class="card-body">
                   @include('layouts.ItemList')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
