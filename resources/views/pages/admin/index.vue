<template>
    <admin>
        <Head><title>Dashboard</title></Head>
        <div class="my-10 px-3 ">
            <div class="grid grid-cols-4 gap-2">
                <div class="border shadow rounded-lg p-2 hover:bg-gray-50">
                  <Link :href="route('orders.index')" title="Orders">
                      <div>
                          <h1 class="font-bold text-3xl">{{orders}}</h1>
                          <p class="mt-1 font-bold text-teal-700">Orders</p>
                      </div>
                  </Link>
                </div>
                <div class="border shadow rounded-lg p-2 hover:bg-gray-50">
                    <Link :href="route('quote-request.index')" title="Pending Quotes">
                        <div>
                            <h1 class="font-bold text-3xl">{{quotes}}</h1>
                            <p class="mt-1 font-bold text-teal-700">Pending Quotes</p>
                        </div>
                    </Link>
                </div>
                <div class="border shadow rounded-lg p-2 hover:bg-gray-50">
                    <Link :href="route('contact.index')" title="Messages">
                        <div>
                            <h1 class="font-bold text-3xl">{{messages}}</h1>
                            <p class="mt-1 font-bold text-teal-700">Pending Messages</p>
                        </div>
                    </Link>
                </div>
                <div class="border shadow rounded-lg p-2 hover:bg-gray-50">
                    <Link :href="route('subscriptions.index')" title="Messages">
                        <div>
                            <h1 class="font-bold text-3xl">{{subscribers}}</h1>
                            <p class="mt-1 font-bold text-teal-700">Subscribers</p>
                        </div>
                    </Link>
                </div>
                <div class="border shadow rounded-lg p-2 hover:bg-gray-50">
                    <Link :href="route('payments.index')" title="Messages">
                        <div>
                            <h1 class="font-bold text-3xl">$. {{income}}</h1>
                            <p class="mt-1 font-bold text-teal-700">Total Income</p>
                        </div>
                    </Link>
                </div>
                <div class="border shadow rounded-lg p-2 hover:bg-gray-50">
                    <Link :href="route('products.index')" title="Messages">
                        <div>
                            <h1 class="font-bold text-3xl">{{products}}</h1>
                            <p class="mt-1 font-bold text-teal-700">Products</p>
                        </div>
                    </Link>
                </div>
                <div class="border shadow rounded-lg p-2 hover:bg-gray-50">
                    <Link :href="route('users.index')" title="Messages">
                        <div>
                            <h1 class="font-bold text-3xl">{{users}}</h1>
                            <p class="mt-1 font-bold text-teal-700">Users</p>
                        </div>
                    </Link>
                </div>
            </div>

            <!--Order- summary-->
            <div class="mt-10">
                <h6 class="font-bold">Orders for the Last 3 Month</h6>
                <div class="mt-2">
                    <Bar
                        id="my-chart-id"
                        :options="chartOptions"
                        :data="chartData"
                    />
                </div>
            </div>
        </div>


    </admin>

</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import {Head} from "@inertiajs/inertia-vue3";
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import {ref} from "vue";
let props=defineProps({
    users:Object,
    subscribers:Object,
    products:Object,
    quotes:Object,
    messages:Object,
    orders:Object,
    income:Object,
    chartData:Object
})
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const  chartData=ref({
    labels: [ props.chartData.map(month => month.month)  ],
    datasets: [ { data: props.chartData.map(total=>total.total) } ]
})


</script>

<style scoped>

</style>
