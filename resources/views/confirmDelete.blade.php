@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">

                <div class="card-header">Are you sure you want to delete?</div>
                @if($userid == $item->user_id)
                <div class="card-body">
                    
                    <div class="row justify-content-center p-2">
                        <table class="table">

                            <tbody>
                                <tr>
                                    <td>
                                        <b>Name</b>
                                    </td>
                                    <td>
                                        {{$item->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Price</b>
                                    </td>
                                    <td>
                                        {{$item->price}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-center">
                    
                        <div class=" p-2 ">
                            <form action="{{ url('/item/destroy/'.$item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                             
                                <input type="submit" value="Confirm" class="btn btn-danger">
                                <input onclick="window.location='{{ url("/home") }}'"  type="button" value="Cancel" class="btn btn-secondary">
                             
                            </form>
                       
                        </div>
                    </div>
                </div>
                @else
                    You do not have permission
                @endif
            </div>
        </div>
    </div>
</div>
@endsection