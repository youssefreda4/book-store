<div class="d-flex justify-content-between ">

    <a href="{{ route("dashboard.$route.edit", $model) }}" class="btn btn-warning">
        <i class="fas fa-edit"></i>
    </a>

    <a href="{{ route("dashboard.$route.show", $model) }}" class="btn btn-info">
        <i class="fas fa-eye"></i>
    </a>
    <form action="{{ route("dashboard.$route.destroy", $model) }}" method="post">
        @csrf
        @method('DELETE')
        <x-adminlte-button type="submit" theme="danger" icon="fas fa-trash-alt" />
    </form>
</div>
