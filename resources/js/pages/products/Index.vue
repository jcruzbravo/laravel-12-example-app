<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Rocket } from 'lucide-vue-next';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
];

const page = usePage();

const handleDelete = (id: number) => {
    if (confirm('Do you really want to delete this product?')) {
        router.delete(route('products.destroy', {id}))
    }
};

interface Product {
    id: number;
    name: string;
    price: number;
    description: string;
}
interface Props {
    products: Product[];
}

// Get props from Inertia
const props = defineProps<Props>();
</script>

<template>
    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div v-if="page.props.flash?.success" class="mb-4">
                <Alert class="bg-blue-200">
                    <Rocket class="h-4 w-4" />
                    <AlertTitle>Notification</AlertTitle>
                    <AlertDescription>
                        {{ page.props.flash?.success }}
                    </AlertDescription>
                </Alert>
            </div>

            <!--Button-->
            <div>
                <Link :href="route('products.create')">
                    <Button>Create product</Button>
                </Link>
            </div>

            <!--Table-->
            <div>
                <Table>
                    <TableCaption>A list of your recent products.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]"> ID </TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Price</TableHead>
                            <TableHead>Description</TableHead>
                            <TableHead class="text-center"> Actions </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <TableRow v-for="product in props.products" :key="product.id">
                            <TableCell>{{ product.id }}</TableCell>
                            <TableCell class="font-medium">{{ product.name }}</TableCell>
                            <TableCell>{{ product.price }}</TableCell>
                            <TableCell>{{ product.description }}</TableCell>
                            <TableCell class="text-center space-x-2">
                                <Link :href="route('products.edit', { id: product.id })">
                                    <Button class="bg-slate-600">Edit</Button>
                                </Link>

                                <Button class="bg-red-600" @click="handleDelete(product.id)">Delete</Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
