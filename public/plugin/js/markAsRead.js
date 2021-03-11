$(document).ready(function() {
    function sendMarkRequest() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/item/markAsRead/',
            method: 'POST',
        });
    }

    $(function() {
        $('.mark-as-read').click(function() {
            sendMarkRequest();
        })
    });

});