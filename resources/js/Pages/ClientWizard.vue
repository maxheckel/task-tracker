<template>
    <app-layout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-gray-800 leading-tight">
                    <span class="block font-semibold text-xl "> {{clientAcronym}}</span>
                    <span class="text-md">{{client.name}}</span>
                </h2>
                <div class="order-last">
                    0 Hours
                    <span class="block">
                        <currency amount="0" :currency="client.currency"/> Earned
                    </span>
                </div>
            </div>
        </template>
        <div class="wizard">
            <div v-show="showStep1" class="page-1 text-center px-30 py-20 ">
                <h1>It looks like this is your first task for {{client.name}}!</h1>
                <h3>Let's set it up 🚀</h3>
            </div>

            <transition name="fade">
                <div v-show="showStep2" class="py-10">
                    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                            <h1 class="text-3xl mb-4">Are you starting work now or logging past work?</h1>
                            <div class="grid grid-cols-2 gap-4">
                                <div @click="startNow" class="border border-gray-200 shadow-md bg-white rounded p-4 hover:bg-gray-200 cursor-pointer hover:border-solid transition duration-500">
                                    Starting Now!
                                </div>
                                <div @click="pastWork" class="border border-gray-200 shadow-md bg-white rounded p-4 hover:bg-gray-200 cursor-pointer hover:border-solid transition duration-500">
                                    Logging past work!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <transition name="fade">
                <div v-show="showStartingNow" class="py-10">
                    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                            <h1 class="text-3xl text-center">
                                Great, let's get to work!
                            </h1>
                            <add-task submit-text="Get Started" :client="client"/>
                            <a class="cursor-pointer hover:text-dark-slate-gray-200" @click="pastWork">Actually, I want to log past work...</a>
                        </div>
                    </div>
                </div>
            </transition>
            <transition name="fade">
                <div v-show="showPastWork" class="py-10">
                    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                            <h1 class="text-3xl text-center">
                                I'm sure you crushed it!
                            </h1>
                            <add-task submit-text="Save" :log-now="true" :client="client"/>
                            <a class="cursor-pointer hover:text-dark-slate-gray-200" @click="startNow">Actually, I'm starting work now...</a>
                        </div>
                    </div>
                </div>
            </transition>

        </div>
    </app-layout>
</template>

<script>


    import AppLayout from "@/Layouts/AppLayout";
    import Currency from "@/Components/Currency";
    import AddTask from "@/Components/AddTask";

    export default {
        props: [
            'client'
        ],
        data() {
            return {
                showStep1: true,
                showStep2: false,
                showStartingNow: false,
                showPastWork: false
            }
        },
        methods: {
            startNow(){
                this.showStep2 = false;
                this.showStartingNow = true
                this.showPastWork = false;
            },
            pastWork() {
                this.showStep2 = false;
                this.showPastWork = true
                this.showStartingNow = false;
            }
        },
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
        mounted() {
            setTimeout(() => {
                this.showStep1 = false;
                this.showStep2 = true;
            }, 3000)
        },
        components: {
            AddTask,
            Currency,
            AppLayout
        },
    }
</script>

<style lang="scss" scoped>
    .page-1 {

        h3 {
            font-size: 2rem;
            animation: slideUpFromBottom 1s 1 forwards;
            animation-delay: 1s;
            opacity: 0;
        }

        h1 {
            font-size: 3rem;
            animation: slideUpFromBottom 1s 1;
        }
    }

    .hidden {
        display: none;
    }

    @keyframes slideUpFromBottom {
        from {
            margin-top: 30px;
            opacity: 0;
            display: block;
        }
        to {
            margin-top: 0px;
            opacity: 1;
            display: block;
        }
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.25s ease-out;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }


</style>
