import { usePage } from '@inertiajs/react';
import { type Link as LinkType } from '@/types';

export default function TopLinks() {
    const { topLinks } = usePage<{ topLinks: LinkType[] }>().props;

    return (
        <div className="flex flex-col gap-2 p-4">
            <h3 className="text-lg font-medium">Top Sites by Rating</h3>
            {topLinks.map((link) => (
                <div key={link.id} className="p-2 rounded-lg bg-neutral-100 dark:bg-neutral-800">
                    <div class="flex flex-col items-center justify-between">
                        <div className="truncate w-full">
                            <a href={link.url} target="_blank" rel="noopener noreferrer" className="hover:underline">
                                {link.url}
                            </a>
                        </div>
                        <div class="w-full flex flex-row items-center justify-between">
                            <div className="text-xl font-medium">
                                {link.au_rank.toFixed(2)}
                            </div>
                            <div className="text-sm text-gray-500 dark:text-gray-400">
                                {(link.au_rank > 0 ? '★' : '☆').repeat(5 - Math.abs(link.au_rank))}
                            </div>
                            <div className="text-sm text-gray-500 dark:text-gray-400">
                                {link.ratings_count}
                            </div>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
}
