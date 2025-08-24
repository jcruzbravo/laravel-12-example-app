<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { useForm } from '@inertiajs/vue3';

interface Product {
    id: number,
    name: string,
    price: number,
    description: string,
}

const props = defineProps<{product: Product}>();

const form = useForm({
    name: props.product.name,
    price: props.product.price,
    description: props.product.description,
});

const handleSubmit = () => {
    form.put(route('products.update', {
        product: props.product,
    }));
};
</script>

<template>
    <Head title="Edit a product" />

    <AppLayout :breadcrumbs="[
        {
            title: 'Edit a product',
            href: `/products/${props.product.id}/edit`,
        }
    ]">
        <div class="p-4">
            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-2">
                <div class="space-y-2">
                    <Label for="Product name">Name</Label>
                    <Input v-model="form.name" type="text" placeholder="Product name" />
                    <div class="text-sm text-red-500" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>

                <div class="space-y-2">
                    <Label for="Product price">Price</Label>
                    <Input v-model="form.price" type="number" placeholder="Product price" />
                    <div class="text-sm text-red-500" v-if="form.errors.price">{{ form.errors.price }}</div>
                </div>

                <div class="grid w-full gap-1.5 space-y-2">
                    <Label for="Product description">Description</Label>
                    <Input v-model="form.description" placeholder="Product description" />
                    <div class="text-sm text-red-500" v-if="form.errors.description">{{ form.errors.description }}</div>
                </div>

                <Button type="submit" :disabled="form.processing">Edit a product</Button>
            </form>
        </div>
    </AppLayout>
</template>

