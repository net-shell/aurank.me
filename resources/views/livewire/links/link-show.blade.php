<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Link Details</h1>
                    <a href="{{ $link->url }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                        {{ $link->url }}
                    </a>
                    <div class="mt-4 text-xl">
                        Total Rating: <span class="font-bold">{{ $this->totalRating }}</span>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-xl font-bold mb-4">Rate This Link</h2>
                        @livewire('links.rating-slider', ['link' => $link])
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h2 class="text-xl font-bold mb-4">Positive Ratings ({{ $this->positiveRatings->count() }})
                            </h2>
                            <div class="space-y-4">
                                @foreach ($this->positiveRatings as $rating)
                                    <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
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
                            <h2 class="text-xl font-bold mb-4">Negative Ratings ({{ $this->negativeRatings->count() }})
                            </h2>
                            <div class="space-y-4">
                                @foreach ($this->negativeRatings as $rating)
                                    <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
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
            </div>
        </div>
    </div>
</x-layouts.app>
