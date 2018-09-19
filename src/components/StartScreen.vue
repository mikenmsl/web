<template>
<div class="alert alert-primary">	
		<h3>Are you ready? {{ test }}</h3>
		<div class="form-group">
    <label>Select mode</label>
    <select v-model="mode"  class="form-control">
      <option selected >addition and subtraction</option>
      <option  >multiplication and division</option>
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
			mode: "addition and subtraction"
			}
			this.$emit('onMode', this.mode);
		},
		methods: {
			
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