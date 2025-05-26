<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Submit New Link</h1>
                    <form wire:submit.prevent="submit">
                        <div class="mb-4">
                            <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                URL
                            </label>
                            <input type="url" id="url" wire:model="url"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="https://example.com">
                            @error('url')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                            Submit URL
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
