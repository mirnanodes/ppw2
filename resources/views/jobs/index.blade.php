<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Lowongan Kerja
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow rounded-xl p-6">
                <form method="GET" action="{{ route('jobs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <select name="filter_location" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Lokasi</option>
                            <option value="Jakarta" @selected(request('filter_location') === 'Jakarta')>Jakarta</option>
                            <option value="Bandung" @selected(request('filter_location') === 'Bandung')>Bandung</option>
                            <option value="Surabaya" @selected(request('filter_location') === 'Surabaya')>Surabaya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                        <select name="filter_type" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Tipe</option>
                            <option value="Full-time" @selected(request('filter_type') === 'Full-time')>Full-time</option>
                            <option value="Part-time" @selected(request('filter_type') === 'Part-time')>Part-time</option>
                            <option value="Internship" @selected(request('filter_type') === 'Internship')>Internship</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                        <div class="flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari lowongan..." class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow rounded-xl p-6">
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 rounded-lg bg-green-50 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Lowongan Terbaru</h3>
                        <p class="text-sm text-gray-500">Temukan pekerjaan impianmu dengan cepat.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posisi</th>
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
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $job->company }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900 font-semibold">{{ $job->title }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $job->location }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">{{ $job->job_type }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700">Lihat Detail</a>
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
