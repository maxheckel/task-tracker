<template>
    <div>
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
