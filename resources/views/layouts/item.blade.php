<div class="form-group">

    <input class="form-control" name="name" type="text" placeholder="Name of item" value='@if($name != null) {{$name}} @endif'>

</div>


<div class="form-group">

    <input class="form-control" name="price" min="0" type="number" step="0.01" placeholder="Price" value='@if($price != null) {{$price}} @endif'>

</div>