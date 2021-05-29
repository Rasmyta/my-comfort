<div wire:ignore x-data x-init="
FilePond.registerPlugin(FilePondPluginImagePreview);

FilePond.setOptions({
    allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
    server: {
        process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
            @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
        },
        revert:(filename, load, error) => {
            @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
        }
     }
 });

const pond = FilePond.create($refs.input);
pond.labelIdle = 'Arrastra y suelta tus nuevas imagenes o <span class=filepond--label-action> Navega </span>';
">
    <input type="file" x-ref="input">
</div>
