
<form action="{{ $action }}" method="POST">
    @method('put')
    @csrf
    <button type="submit" class="btn btn-danger" style=" display: contents;">
        <div class="btn btn-success" data-toggle="modal">تاكيد الطلب</div>
    </button>
</form>
<br>
