import { Head } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import RatingSlider from '../../components/links/rating-slider';

interface Rating {
    id: number;
    score: number;
    evidence_count: number;
    user_name: string;
}

interface LinkData {
    id: number;
    url: string;
    total_rating: number;
    positive_ratings: Rating[];
    negative_ratings: Rating[];
}

export default function LinkShow({ link }: { link: LinkData }) {
    const [data, setData] = useState<LinkData>(link);
    const [loading, setLoading] = useState(false);

    const fetchLinkData = async () => {
        setLoading(true);
        try {
            const response = await fetch(`/api/links/${link.id}`);
            const json = await response.json();
            setData(json);
        } catch (error) {
            console.error('Error fetching link data:', error);
        } finally {
            setLoading(false);
        }
    };

    return (
        <>
            <Head title="Link Details" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <h1 className="text-2xl font-bold mb-4">Link Details</h1>
                            <a
                                href={data.url}
                                target="_blank"
                                className="text-blue-600 dark:text-blue-400 hover:underline"
                            >
                                {data.url}
                            </a>
                            <div className="mt-4 text-xl">
                                Total Rating: <span className="font-bold">{data.total_rating}</span>
                            </div>

                            <div className="mt-8">
                                <h2 className="text-xl font-bold mb-4">Rate This Link</h2>
                                <RatingSlider linkId={link.id} onRatingChange={fetchLinkData} />
                            </div>

                            <div className="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h2 className="text-xl font-bold mb-4">
                                        Positive Ratings ({data.positive_ratings.length})
                                    </h2>
                                    <div className="space-y-4">
                                        {data.positive_ratings.map(rating => (
                                            <div key={rating.id} className="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                                <div className="font-medium">Rating: {rating.score}</div>
                                                {rating.evidence_count > 0 && (
                                                    <div className="mt-2 text-sm">
                                                        Evidence: {rating.evidence_count} items
                                                    </div>
                                                )}
                                            </div>
                                        ))}
                                    </div>
                                </div>

                                <div>
                                    <h2 className="text-xl font-bold mb-4">
                                        Negative Ratings ({data.negative_ratings.length})
                                    </h2>
                                    <div className="space-y-4">
                                        {data.negative_ratings.map(rating => (
                                            <div key={rating.id} className="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                                <div className="font-medium">Rating: {rating.score}</div>
                                                {rating.evidence_count > 0 && (
                                                    <div className="mt-2 text-sm">
                                                        Evidence: {rating.evidence_count} items
                                                    </div>
                                                )}
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
