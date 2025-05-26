<div>
    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="url" class="block text-sm font-medium text-gray-700">Submit a URL</label>
            <input type="url" id="url" wire:model="url"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="https://example.com">
            @error('url')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            Submit URL
        </button>
    </form>
</div>
