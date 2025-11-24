<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create New Post</h1>
    
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <label>Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}">
        <!-- Added old() helper to retain input text if when an error is made -->
        
        <label>Body:</label>
        <textarea id="body" name="body">{{ old('body') }}</textarea>
        
        <button type="submit">Save</button>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
</body>
</html>
