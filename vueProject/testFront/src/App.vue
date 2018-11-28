<template>
<div id="products_section">
    <template v-for="item in products">
        <app-product-item
        :item="item"
        > 
        </app-product-item>
    </template>
</div>
</template>

<script>
    import axios from 'axios';

    export default {
        data(){
          return{
            products: []
          }
        },
        computed: {
          
        },
        methods:{
          
            onUpdate() {
                let then = this;
                axios.post('products.json')
                .then(function (response) {
                    console.log(response);
                    then.products = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        created: function () {
            this.onUpdate();
        },
    }
  
</script>

<style lang="sass">

</style>
