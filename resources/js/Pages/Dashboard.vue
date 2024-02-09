<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import SearchBeers from "@/Components/BeerComponents/SearchBeers.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout v-if="$page.props.auth">
        <div class="flex flex-col items-center justify-center mt-10 mb-40">
            <ApplicationLogo
                class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
            />
        </div>
        <SearchBeers />
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    components: {
        AuthenticatedLayout,
    },
    name: 'DashboardPage',
};
</script>
