@props(['id', 'error', 'files'])

<div class="file-upload-wrapper">

    <div class="dropzone" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">
        <!-- File Input -->

        <input {{ $attributes }} type="file" class="form-control @error($error) is-invalid @enderror"
            id="{{ $id }}" />

        <!-- Progress Bar -->
        <div x-show="isUploading">
            <progress max="100" x-bind:value="progress"></progress>
        </div>

        @error($error)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>


    @if ($files)
        <div class="list-files mt-3">

            <div class="module-attachment-items d-flex flex-column gap-2">

                @foreach ($files as $file)
                    @php
                        $base = log($file->getSize(), 1024);
                        $suffixes = ['', 'Kb', 'Mb', 'Gb', 'Tb'];
                        $file_size = round(pow(1024, $base - floor($base)), 2) . ' ' . $suffixes[floor($base)];
                    @endphp
                    <div>
                        <div
                            class="image position-relative d-flex gap-3 align-items-center bg-white rounded p-2 border border-1 w-100">
                            <div class="thumb">
                                <img src="{{ $file->temporaryUrl() }}" class=" w-40px h-40px object-fit-contain"
                                    alt="pdf">
                            </div>
                            <div class="img-name">{{ $file->getClientOriginalName() }}</div>
                            <div class="img-size opacity-50">{{ $file_size }}</div>
                            <button class="btn-closed ms-auto"><img src="{{ asset('/images/icons/delete.png') }}"
                                    @click.prevent="removeUpload('{{ $file->getFilename() }}')"></button>
                        </div><!-- image -->
                    </div>
                @endforeach

            </div><!-- /.files-content -->

        </div><!-- /.module-attachment-items -->

    @endif
</div>
