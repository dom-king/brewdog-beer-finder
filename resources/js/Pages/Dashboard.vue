<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
</script>

<template>
    <Head title="Search for Punk" />

    <AuthenticatedLayout>
        <div class="flex flex-col items-center justify-center mt-10">
            <Link :href="route('dashboard')" class="mx-auto">
                <ApplicationLogo
                    class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                />
            </Link>
        </div>
        <div class="flex flex-col items-center justify-center h-screen">
            <input
                type="text"
                placeholder="Search for beers by ID or Name..."
                class="p-2 border border-gray-300 rounded-md w-1/6"
            />
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    name: 'DashboardPage',
};
</script>
