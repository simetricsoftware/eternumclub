<div class="grid grid-cols-2 gap-4">
    <input type="hidden" name="id" value="{{ $hash->id }}">
    <div class="flex flex-col gap-4">
        <x-input-label value="Hash" />
        <x-text-input name="hash" :value="old('hash', $hash->hash)"/>
    </div>

    <div class="flex flex-col gap-4">
        <x-input-label value="File" />
        <input type="file" name="file" id="file" accept="image/webp">
    </div>
    <div class="col-start-1 col-end-3 flex justify-end p-4">
        <x-primary-button>Save</x-primary-button>
    </div>
</div>
