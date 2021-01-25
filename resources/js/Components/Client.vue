<template>
    <inertia-link :href="'/clients/'+client.id">
        <div class="client
        text-center
        align-middle
        justify-center
        items-center
        content-center
        py-4
        border-gray-200
        border
        rounded
         transition
        duration-500
        hover:bg-gray-200
        cursor-pointer
        hover:border-solid">
            <h1 class="text-3xl">{{clientAcronym}}</h1>
            <span class="text-sm">{{client.name}}</span>
            <span class="block text-xs text-gray-400">Last work done: {{lastWorkDone}}</span>
        </div>
    </inertia-link>
</template>

<script>
    export default {
        name: "Client",
        props: ['client'],
        computed: {
            clientAcronym() {
                return this.client.name.split(' ').reduce((previousValue, currentVal, currentIndex) => {
                    if (currentIndex === 1) {
                        return previousValue[0].toUpperCase() + currentVal[0].toLowerCase();
                    }
                    return previousValue + currentVal[0].toLowerCase()
                })
            },
            lastWorkDone() {
                if (!this.client.tasks || this.client.tasks.length === 0 || !this.client.tasks[0].times || this.client.tasks[0].times.length == 0) {
                    return 'Never'
                }
                return this.client.tasks[0].times[0].start_date ? this.client.tasks[0].times[0].start_date : this.client.tasks[0].times[0].created_at;
            }
        }
    }
</script>

<style scoped>
    .client {
        align-content: center;
        justify-content: center;
        align-items: center;
    }
</style>
