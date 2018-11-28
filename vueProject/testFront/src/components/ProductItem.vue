<template>
	
<div id="products_section">
	<div class="products_page pg_0">
                            <div class="product product_horizontal">                                
                                <span class="product_code">Код: {{ Number.parseInt(item.code) }}</span>
                                <div class="product_status_tooltip_container">
                                    <span class="product_status">Наличие</span>
                                </div>                                
                                <div class="product_photo">
                                    <a href="#" class="url--link product__link">
										<img :src="imgUrl">
                                    </a>                                    
                                </div>
                                <div class="product_description">
                                    <a href="#" class="product__link">{{ item.title }}</a>
                                </div>
                                <div class="product_tags hidden-sm">
                                    <p>Могут понадобиться:</p>                                    
                                    <a v-for="element in assocProducts" href="#" class="url--link"> {{ element }} </a>
                                </div>
                                <div class="product_units">
                                    <div class="unit--wrapper">
                                        <div @click="onChoice('unit')" :class="{ 'unit--active' : unitAlt }" class="unit--select ">
                                            <p class="ng-binding">За {{ item.unitAlt }}</p>
                                        </div>
                                        <div @click="onChoice('unitAlt')" :class="{ 'unit--active' : unit }" class="unit--select">
                                            <p class="ng-binding">За упаковку</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="product_price_club_card">
                                    <span class="product_price_club_card_text">По карте<br>клуба</span>
                                    <span class="goldPrice">{{ priceGold }}</span>
                                    <span class="rouble__i black__i">
                                        <svg version="1.0" id="rouble__b" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="30px" height="22px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                           <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#rouble_black"></use>
                                        </svg>
                                     </span>
                                </p>
                                <p class="product_price_default">
                                    <span class="retailPrice">{{ priceRetail }}</span>
                                    <span class="rouble__i black__i">
                                        <svg version="1.0" id="rouble__g" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="30px" height="22px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                           <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#rouble_gray"></use>
                                        </svg>
                                     </span>
                                </p>
                                <div class="product_price_points">
                                    <p class="ng-binding">Можно купить за {{ item.bonusAmount }} балла</p>
                                </div>
                                <div class="list--unit-padd"></div>
                                <div class="list--unit-desc">
                                    <div class="unit--info">
                                        <div class="unit--desc-i"></div>
                                        <div class="unit--desc-t">
                                            <p>
                                                <span class="ng-binding">Продается упаковками:</span>
                                                <span class="unit--infoInn">1 упак. = {{ item.unitRatioAlt }} {{ item.unitAlt }} </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="product__wrapper">
                                    <div class="product_count_wrapper">
                                        <div class="stepper">
                                            <input class="product__count stepper-input" type="text" v-model.number="amountItem" value="amountItem">
                                            <span @click="amountItem++" class="stepper-arrow up"></span>
                                            <span @click="onAmount()" class="stepper-arrow down"></span>                                  
                                        </div>
                                    </div>
                                    <span class="btn btn_cart" data-url="/cart/" v-bind:data-product-id="item.productId">
                                        <svg class="ic ic_cart">
                                           <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart"></use>
                                        </svg>
                                        <span class="ng-binding">В корзину</span>
                                    </span>
                                </div>
                            </div>
                        </div>
</div>

</template>

<script>

	export default{
		props: ['item'],
		data: function(){
			return{
				amountItem: 0,
				unitAlt: true,
				unit: false,
				priceRetail: this.item.priceRetailAlt,
				priceGold: this.item.priceGoldAlt
			}
		},
		
		computed: {
			assocProducts(){
				return (this.item.assocProducts.split(';').join(',').slice(0, -1).split('\n'));
			},
			imgUrl(){
				return this.item.primaryImageUrl.split('.jpg').join('_220x220_1.jpg');
			}
		},
		methods:{
			onChoice(value){
				if(this.unit){
					this.unit = false;
					this.unitAlt = true;
					this.priceRetail = this.item.priceRetailAlt;
					this.priceGold = this.item.priceGoldAlt;
				}
				else {
					this.unitAlt = false;
					this.unit = true;
					this.priceRetail = this.item.priceRetail;
					this.priceGold = this.item.priceGold;
				}

				
			},
			onAmount(){
				if (this.amountItem > 0){
					this.amountItem--;
				}

			}
			

		}
	}


</script>

<style scoped>
	

</style>