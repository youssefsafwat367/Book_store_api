
<form action="{{ $action }}" method="POST">
    @method('delete')
    @csrf
    <button type="submit" class="btn btn-danger" style="    display: contents;">
        <div class="btn btn-danger" data-toggle="modal"><i class="material-icons" style="">&#xE15C;</i></div>
    </button>
</form>
