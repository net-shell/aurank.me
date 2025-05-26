import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import AppLayout from './app-layout';

interface MainLayoutProps {
    breadcrumbs?: BreadcrumbItem[];
    title?: string;
    children?: React.ReactNode;
}

export default function MainLayout({ breadcrumbs = [], title = '', children }: MainLayoutProps) {
    return (
        <AppLayout breadcrumbs={breadcrumbs} title={title}>
            <Head title={title} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="relative min-h-[100vh] flex-1 overflow-hidden rounded-xl md:min-h-min">
                    {children}
                </div>
            </div>
        </AppLayout>

    );
}
