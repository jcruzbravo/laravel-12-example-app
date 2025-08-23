<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import {type BreadcrumbItem} from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Solicitudes',
        href: '/inicio'
    }
];

</script>

<template>
    <Head title="Solicitudes" />

    <AppLayout :breadcrumbs="breadcrumbs">
          <div class="container">
              <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
                <h1>This is my Solicitudes Index</h1>
              </div>
          </div>
    </AppLayout>
</template>

<style scoped>

</style>
