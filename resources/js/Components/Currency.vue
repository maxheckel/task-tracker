<template>
    <div class="inline">
        {{currencyDisplay}}{{amount}}
    </div>
</template>

<script>
    export default {
        name: "Currency",
        props: ['currency', 'amount'],
        computed: {
            currencyDisplay(){
                if(this.currency == 'EUR'){
                    return '€'
                }
                return '$'
            }
        }
    }
</script>

<style scoped>

</style>
