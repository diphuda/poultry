<table class="table table-flush table-hover" id="datatable-buttons">
    <thead class="thead-light">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Chalan</th>
        <th scope="col">Project</th>
        <th scope="col" class="text-center">Supplier</th>
        <th scope="col" class="text-center">Unit (kg/ltr)</th>
        <th scope="col" class="text-center">Unit Price(tk)</th>
        <th scope="col" class="text-center">Cost(tk)</th>
        <th scope="col" class="text-center">Approved</th>
        <th scope="col" class="text-center">Date</th>
        <th scope="col" class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>

    @foreach($ingredients as $key=>$ingredient)
        <tr>
            <th>
                {{ $key+1 }}
            </th>
            <th>
                {{ $ingredient->raw->name }}
            </th>
            <th>
                {{ $ingredient->chalan}}
            </th>
            <th>
                {{ $ingredient->project_name}}
            </th>
            <td class="text-center">
                {{ $ingredient->supplier->name }}
            </td>
            <td class="text-center">

                {{ $ingredient->amount }}
            </td>
            <td class="text-center">
                {{ $ingredient->unit_price }}
            </td>
            <td class="text-center">
                {{ $ingredient->unit_price * $ingredient->amount }}
            </td>
            <td class="text-center">
                @if($ingredient->is_approved)
                    <span class="badge badge-pill badge-success">Yes</span>
                @else
                    <span class="badge badge-pill badge-warning">No</span>
                @endif
            </td>
            <td class="text-center">
                {{ $ingredient->created_at->format('d M Y') }}
            </td>
            <td class="text-center">
                @if(Gate::check('app.entry.index'))
                    <a href="{{ route('ingredient.show', [$ingredient]) }}" class="btn btn-sm btn-success"><i class="fas fa-eye" data-toggle="tooltip"
                                                                                                              data-placement="top"
                                                                                                              title="View Detail" style="margin-right: 0"></i></a>
                @endif

                @if(Gate::check('app.entry.edit'))
                    <a href="{{ route('ingredient.edit', [$ingredient]) }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right: 0"></i></a>
                @endif

                    @if(Gate::check('app.entry.destroy'))
                        <form id="delete-form-{{ $ingredient->id }}"
                              action="{{ route('ingredient.destroy', [$ingredient]) }}"
                              style="display: inline-block;" method="POST" data-toggle="tooltip" data-placement="top"
                              title="Delete">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="btn btn-sm btn-danger"
                                    onclick="deleteData({{$ingredient->id}})"><i class="fas fa-trash"></i>
                            </button>
                        </form>
                    @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>