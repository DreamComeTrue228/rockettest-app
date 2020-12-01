<template>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h3 class="col-sm-8">{{ product.title }}</h3>
                <select v-model="defaultCurrency" @change="calcPrice($event)">
                    <option v-for="currency in currencies"
                            v-bind:value="currency.code"
                    >
                        {{ currency.name }}
                    </option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <h3 class="card-title">Category: {{ category.name }}</h3>
            <h4 class="card-subtitle mb-2 text-muted">Price: {{ productPrice }}
                {{ defaultCurrency }}
            </h4>
            <p class="card-text" style="font-size: 18px">
                {{ product.body }}
            </p>
            <a href="#" class="btn btn-primary">Купить</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductShowComponent",
    props: ["product", "category", "currencies"],
    data: function () {
        return {
            defaultCurrency: "KZT",
            defaultProductPrice: this.product.price,
            productPrice: ""
        }
    },
    methods: {
        calcPrice: function (event) {
            this.currencies.filter(cur => {
                if (cur.code === event.target.value) {
                    this.productPrice = Math.round(this.defaultProductPrice/cur.value);
                    this.defaultCurrency = cur.code;
                }
            });
        }
    },
    async mounted() {
        this.productPrice = this.defaultProductPrice;
    }
}
</script>

<style scoped>

</style>
