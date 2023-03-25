<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelurahan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <Link href="{{ route('pasien.index') }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                    Back</Link>
                    <x-splade-form action="{{ route('pasien.store') }}" class="my-4">
                        <x-splade-input name="nama" :label="__('Nama')" />
                        <x-splade-input type="date" name="ttl" :label="__('Tanggal Lahir')" />
                        <x-splade-select name="jenis_kelamin" :label="__('Jenis Kelamin')" :options="$jenis_kelamin" :placeholder="__('Jenis Kelamin')" />
                        <x-splade-input type="number" name="nomor" :label="__('No HP')" />
                        <x-splade-input name="rt_rw" :label="__('RT/RW')" />
                        <x-splade-select name="kelurahan_id" :options="$kelurahan_id" :placeholder="__('Kelurahan')" :label="__('Kelurahan')"/>
                        <x-splade-textarea name="alamat" :label="__('Alamat')" autosize />
                        <x-splade-submit class="my-3" />
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>