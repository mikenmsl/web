<template>
<div class="alert alert-primary">	
		<h3>Are you ready?</h3>
		<div class="form-group" >
    <label>Select mode</label>
    <select  v-model="mode" @click="onMode" class="form-control">
      <option selected >addition</option>
      <option  >multiplication</option>
    </select>
  </div>
		<button class="btn btn-warning" @click="$emit('onStart')">
		Start</button>
</div>	


</template>

<script>
	export default {
		data(){
			return{
			mode: "addition"
			}
			this.$emit('onMode', this.mode);
		},
		methods: {
			onMode(){
				if("addition" == this.mode){
							this.$emit('onAdd', this.mode);
						}
						else{
							this.$emit('onMul', this.mode);
						}
			}
		}
	}
</script>

<style scoped>
	.alert{
		text-align: center;
		
	}
	h3, .btn{
		margin: 30px 0;
	}

	
</style>