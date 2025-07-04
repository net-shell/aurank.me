import MainLayout from '@/layouts/main-layout';
import { useForm } from 'react-hook-form';
import { z } from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import { toast } from 'sonner';

const schema = z.object({
    url: z.string().url().min(1, 'URL is required')
});

type FormValues = z.infer<typeof schema>;

export default function SubmitLink() {
    const { register, handleSubmit, formState: { errors }, reset } = useForm<FormValues>({
        resolver: zodResolver(schema)
    });

    const onSubmit = async (data: FormValues) => {
        try {
            const response = await fetch('/api/links', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Authorization': `Bearer ${localStorage.getItem('sanctum_token')}`
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error(await response.text());
            }

            reset();
            toast.success('Link submitted successfully!');
        } catch (error) {
            toast.error(error instanceof Error ? error.message : 'Failed to submit link');
        }
    };

    return (
        <MainLayout title="Submit Link">
            <h1 className="text-2xl font-bold mb-6">Submit New Link</h1>
            <form onSubmit={handleSubmit(onSubmit)}>
                <div className="mb-4">
                    <label htmlFor="url" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        URL
                    </label>
                    <input
                        type="url"
                        id="url"
                        {...register('url')}
                        className="mt-1 px-4 py-2 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="https://example.com"
                    />
                    {errors.url && (
                        <span className="text-red-500 text-sm">{errors.url.message}</span>
                    )}
                </div>

                <button
                    type="submit"
                    className="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600"
                >
                    Submit URL
                </button>
            </form>
        </MainLayout>
    );
}
