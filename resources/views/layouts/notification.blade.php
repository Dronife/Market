<html>

    <body>
        @forelse($notifications as $notification)
        <div class="alert alert-success alert-dismissible fade show col-md-5 " role="alert">
            Cheapest item is <strong>{{$notification->data['name']}}</strong>, which costs <strong>{{$notification->data['price']}}</strong>
            <button data-id="{{$notification->id}}" type="button" class="close mark-as-read" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @empty
        @endforelse
        <script src="{{asset('plugin/js/markAsRead.js')}}"></script>
    </body>

</html>