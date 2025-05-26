import MainLayout from '@/layouts/main-layout';
import { useEffect, useState } from 'react';
import RatingSlider from '@/components/links/rating-slider';
import RatingItem from '@/components/links/rating-item';

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
    const [data, setData] = useState<LinkData>({
        ...link,
        positive_ratings: Array.isArray(link.positive_ratings) ? link.positive_ratings : [],
        negative_ratings: Array.isArray(link.negative_ratings) ? link.negative_ratings : []
    });
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
        <MainLayout title="Link Details">
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
                            <RatingItem
                                key={rating.id}
                                score={rating.score}
                                evidence_count={rating.evidence_count}
                                user_name={rating.user_name}
                            />
                        ))}
                    </div>
                </div>

                <div>
                    <h2 className="text-xl font-bold mb-4">
                        Negative Ratings ({data.negative_ratings.length})
                    </h2>
                    <div className="space-y-4">
                        {data.negative_ratings.map(rating => (
                            <RatingItem
                                key={rating.id}
                                score={rating.score}
                                evidence_count={rating.evidence_count}
                                user_name={rating.user_name}
                            />
                        ))}
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}
