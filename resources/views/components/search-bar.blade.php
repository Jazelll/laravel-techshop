
<form action="{{ route($route) }}" method="GET" class="d-flex" role="search">
    <input class="form-control me-2" name="search" type="text" value="{{ request('search') }}" placeholder="{{ $placeholder }}">
    <button class="btn btn-outline-success" style="width: 8em" type="submit">Search</button>
</form>
