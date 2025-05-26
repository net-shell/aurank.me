interface RatingItemProps {
    score: number;
    evidence_count: number;
    user_name: string;
}

export default function RatingItem({ score, evidence_count, user_name }: RatingItemProps) {
    const isPositive = score > 0;
    const bgColor = isPositive
        ? 'bg-green-50 dark:bg-green-900/20'
        : 'bg-red-50 dark:bg-red-900/20';

    return (
        <div className={`p-4 ${bgColor} rounded-lg`}>
            <div className="font-medium">
                Rating: {score} by {user_name}
            </div>
            {evidence_count > 0 && (
                <div className="mt-2 text-sm">
                    Evidence: {evidence_count} items
                </div>
            )}
        </div>
    );
}
