
<form action="{{ route($route) }}" method="GET" class="d-flex" role="search">
    <input class="form-control " name="search" type="text" value="{{ request('search') }}" placeholder="{{ $placeholder }}">
    <button class="btn" style="width: 3em" type="submit"><i class="bi bi-search"></i></button>
</form>

