<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import SearchBeers from "@/Pages/BeerSearch.vue";
import SocialButton from "@/Components/SocialButton.vue";
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout v-if="$page.props.auth">
        <SocialButton />
        <div class="flex flex-col items-center justify-center mt-10 mb-40">
            <ApplicationLogo
                class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
            />
        </div>

        <div class="flex items-center justify-center mt-10">
            <div class="w-full sm:max-w-md px-6 py-4 bg-gray-800 text-white shadow-md overflow-hidden sm:rounded-lg">
                <p>
                    Welcome to the Brewdog Punk Ipa Finder! Use the filters below to find your favorite beers. You can select a filter, enter a search term, and even hide kegs if you prefer. Press Enter to search or use the "Search" button.
                </p>
            </div>
        </div>
        <SearchBeers />
    </AuthenticatedLayout>
</template>

<script>
export default {
    name: 'DashboardPage',
};
</script>
