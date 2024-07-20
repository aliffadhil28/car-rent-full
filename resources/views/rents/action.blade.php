<a href="javascript:void(0)" data-id="{{ $id }}" onclick="getData({{$id}})" id="editBtn" class="btn btn-sm btn-primary editBtn"><i class="bi bi-pencil-square"></i></a>
<a href="{{ route('rents.destroy', $id) }}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
