<template>
    <form @submit.prevent="submit" class="w-full">


        <label class="block">
            <span class="text-gray-700">Name <span class="text-xs text-medium-carmine">*</span></span>
            <input v-model="newTask.name" type="text"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                   placeholder="Fix the car">
        </label>
        <div class="text-medium-carmine" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</div>

        <label class="block">
            <span class="text-gray-700">Description <span class="text-xs text-medium-carmine">*</span></span>
            <textarea v-model="newTask.description" type="text"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                      placeholder="Replacing the whole transmission"></textarea>
        </label>
        <div class="text-medium-carmine" v-if="$page.props.errors.description">{{ $page.props.errors.description }}</div>

        <label for="rate" class="mt-2 block text-gray-700">Rate Per Hour <span class="text-xs text-medium-carmine">*</span></label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                  <span v-if="newTask.currency !== 'EUR'" class="text-gray-500 sm:text-sm">
                                                    $
                                                  </span>
                <span v-if="newTask.currency === 'EUR'" class="text-gray-500 sm:text-sm">
                                                    €
                                                  </span>
            </div>
            <input type="text" name="rate" v-model='newTask.rate' id="rate"
                   class="focus:ring-dark-slate-gray-200 focus:border-dark-slate-gray-200 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                   placeholder="0.00">
            <div class="absolute inset-y-0 right-0 flex items-center">
                <label for="currency" class="sr-only">Currency</label>
                <select v-model="newTask.currency" id="currency" name="currency"
                        class="focus:ring-dark-slate-gray-200 focus:border-dark-slate-gray-200 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                    <option>USD</option>
                    <option>CAD</option>
                    <option>EUR</option>
                </select>
            </div>
        </div>
        <div class="text-medium-carmine" v-if="$page.props.errors.rate">{{ $page.props.errors.rate }}</div>

        <div v-if="logNow">

            <label class="block mt-2 w-full">
                <span class="text-gray-700">When did you work on {{newTask.name ? newTask.name : 'this task'}}? <span class="text-xs text-medium-carmine">*</span></span>
                <VueTailWindPicker
                    :init="false"
                    :date-range="true"
                    :inline="true"
                    style="width: 100%"
                    @change="(v) => newTask.start_date = v">
                    <input v-model="newTask.start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50" style="display:none">
                </VueTailWindPicker>
            </label>
            <div class="text-medium-carmine" v-if="$page.props.errors.start_date">{{ $page.props.errors.start_date }}</div>
            <label class="block mt-2">
                <span class="text-gray-700">How many hours did you work on {{newTask.name ? newTask.name : 'this task'}}? <span class="text-xs text-medium-carmine">*</span></span>
                <input v-model="newTask.time" type="number"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                          placeholder="0.0">
            </label>
            <div class="text-medium-carmine" v-if="$page.props.errors.time">{{ $page.props.errors.time }}</div>

        </div>

        <div class="py-3">
            <button @click="submit" type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-dark-slate-gray-200 text-base font-medium text-white hover:bg-dark-slate-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dark-slate-gray-100 sm:ml-3 sm:w-auto float-right sm:text-sm">
                {{submitText}}
            </button>
        </div>
    </form>
</template>

<script>

    export default {
        components: { VueTailWindPicker: () => import('vue-tailwind-picker'), },
        name: "AddTask",
        props: ['client', 'submitText', 'logNow', 'errors'],
        data(){
            return{
                newTask: {
                    'logNow': this.logNow,
                    'name': null,
                    'rate': this.client.rate,
                    'description': null,
                    'currency': this.client.currency,
                    'time': null,
                    'start_date': null,
                    'client_id': this.client.id
                }
            }
        },
        methods: {
            setStartDate(startDate){
                console.log(startDate);
                this.newTask.start_date = startDate
            },
            submit(){
                this.$inertia.post('/create-task', this.newTask).then((data) => {
                    if(Object.keys(this.$page.props.errors).length === 0){
                        this.adding = false;
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
