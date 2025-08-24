<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, usePage, Link, router } from '@inertiajs/vue3';
import { AppPageProps, Employee, type BreadcrumbItem } from '@/types';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Pencil, Trash, CirclePlus } from 'lucide-vue-next';
import { computed } from 'vue';
import Button from '@/components/ui/button/Button.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Employees',
        href: '/employees'
    }
];

interface EmployeePageProps extends AppPageProps, ShareData {
    employees: Employee[];
}
const { props } = usePage<EmployeePageProps>();
const employees = computed(() => props.employees);

const handleDelete = async(id:number) => {
    if(!window.confirm('Are you sure you want to delete this employee?')) return;

    router.delete(`/employees/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            router.visit('/employees', {replace:true});
        },
        onError: (errors) => {
            console.log('Error deleting employee:', errors);
        }
    });
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Employees" />

        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child size="sm" class="bg-indigo-500 text-white hover:bg-indigo-700">
                    <Link :href="route('employees.create')">
                    <CirclePlus />
                    Create
                    </Link>
                </Button>
            </div>

            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <Table>
                    <TableCaption>A list of your recent employees.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">Name</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>Position</TableHead>
                            <TableHead>Salary</TableHead>
                            <TableHead class="text-center">Actions</TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <TableRow v-for="employee in employees" :key="employee.id">
                            <TableCell>{{ employee.name }}</TableCell>
                            <TableCell>{{ employee.email ?? 'N/A' }}</TableCell>
                            <TableCell>{{ employee.position }}</TableCell>
                            <TableCell>
                                {{ new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                }).format(
                                    employee.salary
                                ) }}
                            </TableCell>
                            <TableCell>
                                <Button as-child size="sm" class="bg-blue-500 text-white hover:bg-indigo-700">
                                    <Link :href="route('employees.edit', {id: employee.id})">
                                        <Pencil />
                                    </Link>
                                </Button>

                                <Button size="sm" class="bg-rose-500 text-white hover:bg-rose-700" @click="handleDelete(employee.id)">
                                    <Trash />
                                </Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
