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
<!-- Content -->
<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">{{ $userCount }}</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Users</div>
                </div>
            </div>
            <a href="#" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>

        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">{{ $maxStorage }}</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Max File Size</div>
                </div>
            </div>
            <a href="#" class="text-[#f84525] font-medium text-sm hover:text-red-800" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold">{{ $photoCount }}</div>
                    <div class="text-sm font-medium text-gray-400">Posted Photos</div>
                </div>
            </div>
            <a href="#" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md flex flex-col">
            <div class="font-medium mb-4">Total posts today</div>
            <div class="flex justify-center items-center">
                <div style="height: 200px; width: 200px; border: 10px solid #6c757d; border-radius: 50%; display: flex; justify-content: center; align-items: center;" class="text-center">
                    <h1 class="text-4xl ">{{ $photosToday }}</h1>
                </div>
            </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Activities</div>
            </div>
            <div class="overflow-hidden">
                <table class="w-full min-w-[540px]">
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <a href="#" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ $activity->user->name . ' ' . $activity->action }}</a>                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-400">{{ $activity->date }}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-400">{{ $activity->time }}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $activities->links() }}
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Setting</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="max_storage">Max Storage</label>
                    <input type="number" class="form-control" id="max_storage" name="max_storage" value="{{ $maxStorage }}">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
