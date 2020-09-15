<form method="POST" action="{{ route('statuses.store') }}">
    @include('shared._errors')
    {{ csrf_field() }}
    <textarea name="content" id="content" rows="3" class="form-control">{{ old('content') }}</textarea>
    <div class="text-right">
        <button type="submit" class="btn btn-primary mt-3">发布</button>
    </div>
</form>
