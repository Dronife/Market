@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Create item</div>

                <div class="card-body">
                    <form action="{{ url($redirect) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('layouts.item')
                        <input type="submit" class="btn btn-success float-right">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection