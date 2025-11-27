<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Lowongan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex items-start gap-4">
                    @if($job->logo)
                        <img src="{{ Storage::url($job->logo) }}" alt="{{ $job->company }}" class="w-20 h-20 object-cover rounded-lg">
                    @endif
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h1>
                        <p class="text-gray-600">{{ $job->company }} • {{ $job->location }}</p>
                        <div class="mt-2 flex flex-wrap gap-2 text-sm text-gray-700">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-700">{{ $job->job_type }}</span>
                            <span>{{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : 'Gaji tidak disebutkan' }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 prose prose-sm text-gray-700">
                    {!! nl2br(e($job->description)) !!}
                </div>

                @if(session('success'))
                    <div class="mt-4 px-4 py-3 rounded-lg bg-green-50 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @auth
                    @if(auth()->user()->role === 'jobseeker')
                        <div class="mt-6 border-t pt-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Lamar Lowongan Ini</h3>
                            <form action="{{ route('applications.store', $job) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Unggah CV (PDF)</label>
                                    <input type="file" name="cv" accept="application/pdf" class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('cv')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Lamar Sekarang</button>
                            </form>
                        </div>
                    @endif
                @endauth

                <div class="mt-6">
                    <a href="{{ route('jobs.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">← Kembali ke Daftar Lowongan</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
