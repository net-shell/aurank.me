import { Head } from '@inertiajs/react';
import { useEffect, useState } from 'react';

interface Rating {
    url: string;
    user_name: string;
    score: number;
    evidence_count: number;
    show_url: string;
}

export default function Welcome() {
    const [ratings, setRatings] = useState<Rating[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetch('/api/recent-ratings', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(res => {
                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }
                return res.json();
            })
            .then(data => {
                setRatings(data);
                setLoading(false);
            })
            .catch(async error => {
                console.error('Error fetching recent ratings:', error);
                try {
                    const errorResponse = await error.response?.text();
                    console.error('Error response:', errorResponse);
                } catch (e) {
                    console.error('Could not parse error response:', e);
                }
                setLoading(false);
            });
    }, []);

    return (
        <>
            <Head title="Recent URL Ratings" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className="text-center mb-12">
                                <h1 className="text-4xl font-bold mb-6">Recent URL Ratings</h1>
                                <a
                                    href="/auth/google"
                                    className="inline-block px-8 py-4 bg-blue-600 dark:bg-blue-500 text-white text-xl font-bold rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition"
                                >
                                    Login with Google to Rate URLs
                                </a>
                            </div>

                            {loading ? (
                                <div className="text-center">Loading...</div>
                            ) : (
                                <div className="space-y-6">
                                    {ratings.map(rating => (
                                        <div key={rating.show_url} className="p-6 border dark:border-gray-700 rounded-lg shadow-sm dark:bg-gray-700/50">
                                            <div className="flex items-center justify-between">
                                                <div>
                                                    <a
                                                        href={rating.show_url}
                                                        className="text-blue-600 dark:text-blue-400 hover:underline"
                                                    >
                                                        {rating.url}
                                                    </a>
                                                    <div className="text-gray-600 dark:text-gray-400 mt-1">
                                                        Rated by {rating.user_name}
                                                    </div>
                                                </div>
                                                <div
                                                    className={`text-2xl font-bold ${rating.score > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'}`}
                                                >
                                                    {rating.score}
                                                </div>
                                            </div>
                                            {rating.evidence_count > 0 && (
                                                <div className="mt-4 text-sm text-gray-500 dark:text-gray-400">
                                                    {rating.evidence_count} pieces of evidence
                                                </div>
                                            )}
                                        </div>
                                    ))}
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
