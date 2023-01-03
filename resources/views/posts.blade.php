<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Posts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="title">Post title</label>
                        <input type="text" id="title" name="title">
                    </div>
                    <div>
                        <label for="image">Post image optional</label>
                        <input type="file" name="file" id="file">
                    </div>
                    <div>
                        <label for="description">Description optional</label>
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div>
                        <button type="submit">Submit Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>