<template>
    <div>
        {{hours}} Hours
        <span class="block">
            <currency :amount="pending" :currency="client.currency"/> Pending
        </span>
        <span class="block">
            <currency :amount="billed" :currency="client.currency"/> Billed
        </span>
    </div>
</template>

<script>
    import Currency from "@/Components/Currency";
    export default {
        name: "HeaderBilled",
        components: {Currency},
        props: ['client'],
        data() {
            return {
                pending: 0,
                billed: 0,
                hours: 0
            }
        },
        mounted() {
            axios.get('/local/client/' + this.client.id + '/billed').then(response => {
                this.hours = response.data.hours;
                this.billed = response.data.billed;
                this.pending = response.data.pending;
            });

        }
    }
</script>

<style scoped>
    .block{
        font-size: 12px;
    }
</style>
