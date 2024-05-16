<x-app-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container mx-auto py-6 px-4">
        <form action="{{ route('dashboard') }}" method="GET">
            <input type="text" name="search" class="form-control" placeholder="Search by filename or description" value="{{ request()->query('search') }}">
        </form>
        <div class="d-flex justify-content-end mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add A Photo
            </button>
        </div>
        <div class="grid grid-cols-4 gap-4">
        @forelse($photos as $photo)
                <div class="relative mb-4" style="width: 100%; height: 300px;">
                    <img src="{{ $photo->file_path }}" alt="{{ $photo->description }}" class="rounded" style="width: 100%; height: 100%; object-fit: cover;">
                    <div class="d-flex justify-content-between align-items-center mt-2" style="position: absolute; bottom: 0; background: rgba(255, 255, 255, 0.8); width: 100%; padding: 10px;">
                        <p class="mb-0">{{ $photo->description }}</p>
                        <form action="{{ route('dashboard.destroy', $photo) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-transparent border-0 p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-red-500 hover:text-red-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-4 flex items-center justify-center">
                    <p>No post found</p>
                </div>
            @endforelse
        </div>
        {{ $photos->links() }}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add a Photo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.createPost') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
                    </form>
            </div>
        </div>
    </div>


</x-app-layout>
