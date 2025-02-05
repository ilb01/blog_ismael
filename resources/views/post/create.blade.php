@if ($errors->any())
    <div class="bg-red-400">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('post.store') }}" method="post">
    @csrf {{-- token de seguridad --}}

    <label for="title">Title</label>
    <input type="text" style="@error('title') border-color:red; @enderror" name="title">
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label for="url_clean">Clean url</label>
    <input type="text" name="url_clean" />
    <label for="content">Content</label>
    <textarea name="content" col="3"></textarea>
    <input type="submit" value="Create">
</form>
