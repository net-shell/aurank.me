<div class="max-w-lg mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
    <div class="mb-8">
        <h1 class="text-2xl font-bold mb-2">Link Details</h1>
        <a href="{{ $link->url }}" target="_blank" class="text-blue-600 hover:underline">
            {{ $link->url }}
        </a>
        <div class="mt-4 text-xl">
            Total Rating: <span class="font-bold">{{ $this->totalRating }}</span>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-bold mb-4">Rate This Link</h2>
        @livewire('links.rating-slider', ['link' => $link])
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <h2 class="text-xl font-bold mb-4">Positive Ratings ({{ $this->positiveRatings->count() }})</h2>
            <div class="space-y-4">
                @foreach ($this->positiveRatings as $rating)
                    <div class="p-4 bg-green-50 rounded-lg">
                        <div class="font-medium">Rating: {{ $rating->score }}</div>
                        @if ($rating->evidence->count() > 0)
                            <div class="mt-2 text-sm">
                                Evidence: {{ $rating->evidence->count() }} items
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-4">Negative Ratings ({{ $this->negativeRatings->count() }})</h2>
            <div class="space-y-4">
                @foreach ($this->negativeRatings as $rating)
                    <div class="p-4 bg-red-50 rounded-lg">
                        <div class="font-medium">Rating: {{ $rating->score }}</div>
                        @if ($rating->evidence->count() > 0)
                            <div class="mt-2 text-sm">
                                Evidence: {{ $rating->evidence->count() }} items
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
