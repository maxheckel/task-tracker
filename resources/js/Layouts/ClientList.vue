<template>
    <div class="grid grid-cols-5 gap-4 p-2">
        <client v-for="client in clients" v-bind:client="client" v-bind:key="client.id"/>
        <add-client/>
    </div>
</template>

<script>
    import Client from "../Components/Client";
    import AddClient from "../Components/AddClient";
    export default {
        name: "ClientList",
        components: {AddClient, Client},
        props: ["clients"]
    }
</script>

<style scoped>

</style>
