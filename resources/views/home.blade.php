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
                            @include('layouts.ItemList')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('plugin/js/pusher/ReloadData.js')}}"></script>
    <script type="text/javascript">
        Reload('UpdateTableEvent', 'UpdateTable', window.location.href+ ' '+ '.ItemTable', '.ItemTable');
    </script>
    
</body>

</html>
@endsection