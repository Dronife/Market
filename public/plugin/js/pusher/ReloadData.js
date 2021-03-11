
function Reload(channelName, bindTo,getDataFromUrl, classToUpdate){
       
    $(document).ready(function(){
        var pusher = new Pusher('f9367fd66b20fc4181a9', {
            cluster: 'eu',
        })
        var channel = pusher.subscribe(channelName);
        channel.bind(bindTo, function(data) {
            $(classToUpdate).load(getDataFromUrl);
        });
    })
}