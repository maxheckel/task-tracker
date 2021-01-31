<template>
    <span class="block font-semibold text-xl "> {{clientAcronym}}</span>
</template>

<script>
    export default {
        name: "ClientAcronym",
        props: ['client'],
        computed:{
            clientAcronym() {
                return this.client.name.split(' ').reduce((previousValue, currentVal, currentIndex) => {
                    if (currentIndex === 1) {
                        return previousValue[0].toUpperCase() + currentVal[0].toLowerCase();
                    }
                    return previousValue + currentVal[0].toLowerCase()
                })
            }
        },
    }
</script>

<style scoped>

</style>
