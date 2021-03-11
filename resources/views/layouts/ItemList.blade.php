<table class="table ">
    <thead class="table-dark">
        <tr>
            <th>
                Name
            </th>
            <th>
                Price
            </th>
            <th style="width: 30%">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $key => $item)
        <tr>
            <td>
                {{$item->name}}
            </td>
            <td>
                {{$item->price}}
            </td>
            <td>
                @if($item->user_id == Auth::user()->id)

                <div class="row justify-content-center">
                    <form action="{{ url('/item/delete/'.$item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="pb-1 pr-1">

                            <button style="width: 35px;" type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>

                    </form>

                    <form action="{{ url('/item/edit/'.$item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="pb-1 pr-1">
                            <button style="width: 35px;" name="{{$item->id}}" type="submit" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                    </form>

                </div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

