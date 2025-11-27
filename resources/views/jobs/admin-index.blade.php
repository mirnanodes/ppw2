<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Lowongan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow rounded-xl p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Lowongan</h3>
                    <p class="text-sm text-gray-500">Kelola lowongan kerja yang tampil kepada pelamar.</p>
                </div>
                <a href="{{ route('admin.jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">Tambah Lowongan</a>
            </div>

            <div class="bg-white shadow rounded-xl p-6">
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 rounded-lg bg-green-50 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gaji</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($jobs as $job)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ ($jobs->currentPage() - 1) * $jobs->perPage() + $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $job->title }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $job->company }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $job->location }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">{{ $job->job_type }}</span>
                                    </td>
                                    <td class="px-4 py-3 flex items-center gap-2">
                                        <a href="{{ route('admin.jobs.edit', $job) }}" class="px-3 py-2 rounded-lg text-xs font-semibold bg-amber-500 text-white hover:bg-amber-600">Edit</a>
                                        <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-3 py-2 rounded-lg text-xs font-semibold bg-red-600 text-white hover:bg-red-700">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada lowongan tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
