<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold mb-6">Recent URL Ratings</h1>
                        <a href="{{ route('google.login') }}"
                            class="inline-block px-8 py-4 bg-blue-600 dark:bg-blue-500 text-white text-xl font-bold rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition">
                            Login with Google to Rate URLs
                        </a>
                    </div>

                    <div class="space-y-6">
                        @foreach ($recentRatings as $rating)
                            <div class="p-6 border dark:border-gray-700 rounded-lg shadow-sm dark:bg-gray-700/50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <a href="{{ route('links.show', $rating->link) }}"
                                            class="text-blue-600 dark:text-blue-400 hover:underline">
                                            {{ $rating->link->url }}
                                        </a>
                                        <div class="text-gray-600 dark:text-gray-400 mt-1">
                                            Rated by {{ $rating->user->name }}
                                        </div>
                                    </div>
                                    <div
                                        class="text-2xl font-bold {{ $rating->score > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        {{ $rating->score }}
                                    </div>
                                </div>
                                @if ($rating->evidence->count() > 0)
                                    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $rating->evidence->count() }} pieces of evidence
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
