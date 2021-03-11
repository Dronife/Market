@extends('layouts.app')

@section('content')

<html>

<body>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">{{$header}} </div>
                    <div class="card-body">

                        <div class="ItemTable">


                            <form action="{{ url('/item/delete') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="p-2">
                                        <button type="button" class="btn btn-secondary selectAll">Select All</button>
                                    </div>
                                    <div class="p-2 ">
                                        <input onClick="return confirm('Are you sure you want to delete selected elements?')" type="submit" class="btn btn-danger" value='Delete selected'>
                                    </div>
                                </div>
                                @include('layouts.ItemList')
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('plugin/js/pusher/ReloadData.js')}}"></script>
    <script src="{{asset('plugin/js/tableControl.js')}}"></script>
    <script type="text/javascript">
        Reload('UpdateTableEvent', 'UpdateTable', window.location.href + ' ' + '.ItemTable', '.ItemTable');
    </script>

</body>

</html>
@endsection