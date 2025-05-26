<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-6">Recent URL Ratings</h1>
        <a href="{{ route('google.login') }}"
            class="inline-block px-8 py-4 bg-blue-600 text-white text-xl font-bold rounded-lg hover:bg-blue-700 transition">
            Login with Google to Rate URLs
        </a>
    </div>

    <div class="space-y-6">
        @foreach ($recentRatings as $rating)
            <div class="p-6 border rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('links.show', $rating->link) }}" class="text-blue-600 hover:underline">
                            {{ $rating->link->url }}
                        </a>
                        <div class="text-gray-600 mt-1">
                            Rated by {{ $rating->user->name }}
                        </div>
                    </div>
                    <div class="text-2xl font-bold {{ $rating->score > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $rating->score }}
                    </div>
                </div>
                @if ($rating->evidence->count() > 0)
                    <div class="mt-4 text-sm text-gray-500">
                        {{ $rating->evidence->count() }} pieces of evidence
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
