<template>
    <app-layout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-gray-800 leading-tight">
                    <client-acronym :client="client"/>
                    <span class="text-md">{{client.name}}</span>
                </h2>
                <div class="order-last">
                    <header-billed :client="client"/>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import ClientList from "../Layouts/ClientList";
    import HeaderBilled from "@/Components/HeaderBilled";
    import ClientAcronym from "@/Components/ClientAcronym";

    export default {
        props:[
            'client'
        ],
        components: {
            ClientAcronym,
            HeaderBilled,
            AppLayout,
        },
    }
</script>
