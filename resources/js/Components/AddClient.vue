<template>
    <div class="add-client">
        <div v-show="!adding" class="
        border-box
        border-dashed
        p-5
        bg-white
        border
        border-gray-200
        w-40
        m-1
        text-center
        text-gray-400
        transition
        duration-500
        hover:bg-gray-200
        cursor-pointer
        hover:border-solid
        rounded-md"
             @click="adding = true"
        >
            <span class="plus text-3xl">
                +
            </span>
            <br>
            <span class="text-md">
            Add Client
            </span>

        </div>

        <transition name="fade">
            <div v-show="adding" class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!--
                      Background overlay, show/hide based on modal state.

                      Entering: "ease-out duration-300"
                        From: "opacity-0"
                        To: "opacity-100"
                      Leaving: "ease-in duration-200"
                        From: "opacity-100"
                        To: "opacity-0"
                    -->
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <!--
                      Modal panel, show/hide based on modal state.

                      Entering: "ease-out duration-300"
                        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        To: "opacity-100 translate-y-0 sm:scale-100"
                      Leaving: "ease-in duration-200"
                        From: "opacity-100 translate-y-0 sm:scale-100"
                        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    -->
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">


                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-bold leading-6 font-medium text-gray-900" id="modal-headline">
                                    Add New Client
                                </h3>
                                <div class="mt-2">
                                    <form @submit.prevent="submit" class="w-full">
                                        <label class="block">
                                            <span class="text-gray-700">Name <span class="text-xs text-medium-carmine">*</span></span>
                                            <input v-model="newClient.name" type="text"
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                                                   placeholder="Joe's Garage">
                                        </label>
                                        <div class="text-medium-carmine" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</div>

                                        <div class="inline-flex w-full mt-2">
                                            <label class="inline w-1/2">
                                                <span class="text-gray-700">Contact Email <span class="text-xs text-medium-carmine">*</span></span>
                                                <input v-model="newClient.contact_email" type="email"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                                                       placeholder="joe@garage.com">
                                                <div class="text-medium-carmine" v-if="$page.props.errors.contact_email">{{ $page.props.errors.contact_email }}</div>
                                            </label>

                                            <label class="inline w-1/2 ml-2">
                                                <span class="text-gray-700">Contact Phone</span>
                                                <input v-model="newClient.contact_phone" type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                                                       placeholder="1238675309">
                                            </label>
                                        </div>
                                        <label for="rate" class="mt-2 block text-gray-700">Rate Per Hour <span class="text-xs text-medium-carmine">*</span></label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                  <span v-if="newClient.currency !== 'EUR'" class="text-gray-500 sm:text-sm">
                                                    $
                                                  </span>
                                                  <span v-if="newClient.currency === 'EUR'" class="text-gray-500 sm:text-sm">
                                                    €
                                                  </span>
                                            </div>
                                            <input type="text" name="rate" v-model='newClient.rate' id="rate"
                                                   class="focus:ring-dark-slate-gray-200 focus:border-dark-slate-gray-200 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                                   placeholder="0.00">
                                            <div class="absolute inset-y-0 right-0 flex items-center">
                                                <label for="currency" class="sr-only">Currency</label>
                                                <select v-model="newClient.currency" id="currency" name="currency"
                                                        class="focus:ring-dark-slate-gray-200 focus:border-dark-slate-gray-200 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                                    <option>USD</option>
                                                    <option>CAD</option>
                                                    <option>EUR</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-medium-carmine" v-if="$page.props.errors.rate">{{ $page.props.errors.rate }}</div>
                                        <span class="block text-lg mt-4 mb-2">Address</span>
                                        <label class="block mt-2">
                                            <span class="text-gray-700">Street 1</span>
                                            <input v-model="newClient.street1" type="text"
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                                                   placeholder="123 Fake St">
                                        </label>

                                        <label class="block mt-2">
                                            <span class="text-gray-700">Street 2</span>
                                            <input v-model="newClient.street2" type="text"
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                                                   placeholder="Apt 404">
                                        </label>



                                        <div class="inline-flex w-full mt-2">
                                            <label class="inline w-1/2">
                                                <span class="text-gray-700">City</span>
                                                <input v-model="newClient.city" type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                                                       placeholder="San Francisco">
                                            </label>
                                            <label class="inline w-1/2 ml-2">
                                                <span class="text-gray-700">State</span>
                                                <input v-model="newClient.state" type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                                                       placeholder="CA">
                                            </label>
                                        </div>
                                        <div class="inline-flex w-full mt-2">
                                            <label class="inline w-1/2">
                                                <span class="text-gray-700">Zip</span>
                                                <input v-model="newClient.zip" type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                                                       placeholder="43202">
                                            </label>
                                            <label class="inline w-1/2 ml-2">
                                                <span class="text-gray-700">Country</span>
                                                <input v-model="newClient.country" type="text"
                                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-dark-slate-gray-200 focus:ring focus:ring-dark-slate-gray-200 focus:ring-opacity-50"
                                                       placeholder="United States">
                                            </label>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button @click="submit" type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-dark-slate-gray-200 text-base font-medium text-white hover:bg-dark-slate-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dark-slate-gray-100 sm:ml-3 sm:w-auto sm:text-sm">
                                Create
                            </button>
                            <button @click="adding = false" type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dark-slate-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>

    </div>
</template>

<script>
    export default {
        name: "AddClient",
        props: {
            errors: Object,
        },
        data() {
            return {
                adding: true,
                newClient: {
                    'name': null,
                    'rate': null,
                    'currency': "USD",
                    'street1': null,
                    'street2': null,
                    'city': null,
                    'state': null,
                    'zip': null,
                    'country': null,
                    'contact_email': null,
                    'contact_phone': null,
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post('/create-client', this.newClient).then((data) => {
                    if(Object.keys(this.$page.props.errors).length === 0){
                        this.adding = false;
                    }
                })
            },
        }
    }
</script>

<style scoped lang="scss">
    .button {
        text-align: center;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.25s ease-out;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
