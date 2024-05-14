<template>

    <div>
        <div>
            <h1 class="border-b-2 ">Цена</h1>
            <div class="my-2">
                <label>От </label>
                <input
                    class="border-2 rounded-xl"
                    @input="applyPriceFrom($event)"
                    placeholder="0"
                    type="text">

            </div>
            <div>
                <label>До </label>
                <input
                    class="border-2 rounded-xl"
                    @input="applyPriceTo($event)"
                    placeholder="9999999999"
                    type="text">

            </div>
        </div>
        <div>
            <h1 class="border-b-2 mt-2 mb-2">Имя</h1>
            <input
                class="border-2 rounded-xl"
                @input="applyName($event)"
                type="text"
                placeholder="Имя товара..."
                >

        </div>
    </div>

</template>

<script setup>
import { inject } from "vue";


const applyName = async (e) => {

    if (e.target.value.length === 0) {
        filter['name'] = []
    }

    filter['name'] = e.target.value
}

const applyPriceFrom = async (e) => {

    if (e.target.value.length === 0) {
        filter['price'][0] = 0
    } else {
        filter['price'][0] = e.target.value
    }
    if (filter['price'][1] === undefined ) {
        filter['price'][1] = 999999999
    } else {
        filter['price'][1] = 999999999
    }
}

const applyPriceTo = async (e) => {

    if (e.target.value.length === 0) {
        filter['price'][1] = 999999999
    } else {
        filter['price'][1] = e.target.value
    }

    if (filter['price'][1] === undefined ) {
        filter['price'][0] = 0
    } else {
        filter['price'][0] = 0
    }
}

const filter = inject('filter');


</script>


<style scoped>

</style>
