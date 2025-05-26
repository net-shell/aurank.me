import { useState } from 'react';
import { toast } from 'sonner';

interface RatingSliderProps {
    linkId: number;
    onRatingChange: () => void;
}

export default function RatingSlider({ linkId, onRatingChange }: RatingSliderProps) {
    const [score, setScore] = useState(0);
    const [comment, setComment] = useState('');
    const [loading, setLoading] = useState(false);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setLoading(true);

        try {
            const response = await fetch('/api/ratings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    link_id: linkId,
                    score,
                    comment
                })
            });

            if (!response.ok) {
                throw new Error(await response.text());
            }

            toast.success('Rating submitted!');
            onRatingChange();
        } catch (error) {
            toast.error(error instanceof Error ? error.message : 'Failed to submit rating');
        } finally {
            setLoading(false);
        }
    };

    return (
        <form onSubmit={handleSubmit} className="space-y-4">
            <div className="flex items-center gap-4">
                <button
                    type="button"
                    onClick={() => setScore(-1)}
                    className={`px-4 py-2 rounded-md ${score === -1 ? 'bg-red-500 text-white' : 'bg-gray-200 dark:bg-gray-700'}`}
                >
                    Negative
                </button>
                <button
                    type="button"
                    onClick={() => setScore(0)}
                    className={`px-4 py-2 rounded-md ${score === 0 ? 'bg-yellow-500 text-white' : 'bg-gray-200 dark:bg-gray-700'}`}
                >
                    Neutral
                </button>
                <button
                    type="button"
                    onClick={() => setScore(1)}
                    className={`px-4 py-2 rounded-md ${score === 1 ? 'bg-green-500 text-white' : 'bg-gray-200 dark:bg-gray-700'}`}
                >
                    Positive
                </button>
            </div>

            <div>
                <label htmlFor="comment" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Comment (optional)
                </label>
                <textarea
                    id="comment"
                    value={comment}
                    onChange={(e) => setComment(e.target.value)}
                    className="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm"
                    rows={3}
                    maxLength={500}
                />
            </div>

            <button
                type="submit"
                disabled={loading}
                className="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 disabled:opacity-50"
            >
                {loading ? 'Submitting...' : 'Submit Rating'}
            </button>
        </form>
    );
}
