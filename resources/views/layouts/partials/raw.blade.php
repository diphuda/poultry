<table class="table align-items-center table-flush" id="datatable-buttons">
    <thead class="thead-light">
    <tr>
        <th scope="col">Item Name</th>
        <th scope="col" class="text-center">Item Code</th>
        <th scope="col" class="text-center">Available</th>
        <th scope="col" class="text-center">Total Purchased</th>
        <th scope="col" class="text-center">Total Cost</th>
        <th scope="col" class="text-center">Avg. Cost</th>
        <th scope="col" class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>

    @foreach($item as $item)
        <tr>
            <th scope="row">
                {{ $item->name }}
            </th>
            <td class="text-center">
                {{ $item->item_code }}
            </td>
            <td class="text-center">
                {{ $item->amount }} kg
            </td>
            <td class="text-center">
                {{ $item->total_purchased_amount }} kg
            </td>
            <td class="text-center">
                ৳ {{ $item->cost }}
            </td>
            <td class="text-center">
                @if($item->total_purchased_amount!=0)
                    ৳ {{ number_format(($item->cost / $item->total_purchased_amount ), 2, '.', ',') }}
                @else
                    ৳ 0.00
                @endif
            </td>
            <td class="text-center">
                @if(Gate::check('app.raw.edit'))
                    <a href="{{ route('raw-item.edit', [$item]) }}"
                       class="btn btn-sm btn-primary"><i class="fas fa-edit"
                                                         data-toggle="tooltip" data-placement="top" title="Edit"
                                                         style="margin-right: 0"></i></a>
                @endif

                @if(Gate::check('app.raw.destroy'))
                    <form id="delete-form-{{$item->id}}"
                          action="{{ route('raw-item.destroy', [$item]) }}" style="display: inline-block;"
                          method="POST" data-toggle="tooltip" data-placement="top" title="Delete">
                        @method('DELETE')
                        @csrf
                        <button type="button" onclick="deleteData({{$item->id}})"
                                class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>