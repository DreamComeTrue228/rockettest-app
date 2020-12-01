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
            <div v-if="showIfProductAreAvailable" class="card-title">
                Есть в наличии
                <img src="https://icon-icons.com/icons2/894/PNG/32/Tick_Mark_Circle_icon-icons.com_69145.png" alt="">
            </div>
            <div class="card-title" v-else>
                Нет в наличии
            </div>
            <h4 class="card-subtitle mb-2 text-muted">Price: {{ productPrice }}
                {{ defaultCurrency }}
            </h4>
            <p class="card-text" style="font-size: 18px">
                {{ product.body }}
            </p>
        </div>
        <button type="button" class="btn btn-primary mt-2"
                @click="pay"
                v-if="showIfProductAreAvailable === true"
        >Pay Widget
        </button>
    </div>
</template>

<script>
export default {
    name: "ProductShowComponent",
    props: ["product", "category", "currencies", "app-url", "public-id"],
    data: function () {
        return {
            defaultCurrency: "KZT",
            defaultProductPrice: this.product.price,
            productPrice: "",
            showIfProductAreAvailable: false,
        }
    },
    methods: {
        calcPrice: function (event) {
            this.currencies.filter(cur => {
                if (cur.code === event.target.value) {
                    this.productPrice = Math.round(this.defaultProductPrice / cur.value);
                    this.defaultCurrency = cur.code;
                }
            });
        },
        pay: function () {
            const widget = new cp.CloudPayments();
            const currentProdId = this.product.id;
            const url = this.appUrl;
            widget.pay('auth', // или 'charge'
                { //options
                    publicId: this.publicId, //id из личного кабинета
                    description: `Оплата товаров в ${url}`, //назначение
                    amount: this.productPrice, //сумма
                    currency: this.defaultCurrency, //валюта
                    skin: "classic1", //дизайн виджета (необязательно)
                },
                {
                    onSuccess: function (options) { // success
                        //действие при успешной оплате
                        options.productId = currentProdId;
                        axios.post(`${url}/api/payments/saveOnHistory`, {
                            pay: options,
                        })
                    },
                    onFail: function (reason, options) { // fail
                        //действие при неуспешной оплате
                        // console.log(reason)
                    },
                    onComplete: function (paymentResult, options) { //Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.
                        //например вызов вашей аналитики Facebook Pixel
                        // console.log(paymentResult)
                    }
                }
            );
            window.reload();
        }
    },
    async mounted() {
        this.productPrice = this.defaultProductPrice;
        if (this.product.quantity > 0) {
            this.showIfProductAreAvailable = true;
        }
    }
}
</script>

<style scoped>

</style>
