<div>
    <form wire:submit.prevent="rate">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Rating (-1 to 1)</label>
            <input type="range" min="-1" max="1" step="0.1" wire:model="score" class="w-full mt-2">
            <div class="flex justify-between text-xs text-gray-500">
                <span>-1 (Negative)</span>
                <span>0 (Neutral)</span>
                <span>1 (Positive)</span>
            </div>
            <div class="text-center mt-1 font-medium">
                Current: {{ $score }}
            </div>
        </div>

        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700">Comment (Optional)</label>
            <textarea id="comment" wire:model="comment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                rows="3" placeholder="Add evidence for your rating..."></textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            Submit Rating
        </button>
    </form>
</div>
