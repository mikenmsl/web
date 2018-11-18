<template>
<div class="view_data">	
	<span> class="name" => .name |||  id="name" => #name <br></span>
	<span>Все элементы вводятся через пробел. Порядковый номер отделяется от элементов знаком + и далее идет через пробел</span>
	<table cellpadding="0" cellspacing="0" border="0">
		<thead>
			<tr>
				<th> url </th>
				<th>tool</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th> {{ url }}</th>
				<th><input v-model="tools.tool" value=(tools.tool) type="text"  required="true" /></th>
				<th class="tool">
					<div class="button__holder">
    					<button @click="onPars()" class="plus trigger"><i class="fa fa-undo" aria-hidden="true"></button>
    				<div>
    			</th>
			</tr>
			<tr>
				<th colspan="2">
					<div class="content">{{ resources.resource }}</div>
				</th>
				<th class="tool">
					<div class="button__holder">
    					<button @click="onSave()"class="plus trigger"><i class="fa fa-floppy-o" aria-hidden="true"></button>
		    		<div>
		    	</th>
			</tr>
		</tbody>
	</table>

</div>

</template>

<script>
	import axios from 'axios';
	export default {
		 props: ['id_l', 'id_s', 'url'],
		data(){
			return {
				tree: 'no',
				tools: {
					tool_id: '',
					tool: 'void',
					link_id: '',
					source_id: ''
				},
				resources: {
					resource_id: '',
					resource: '',
					link_id: '',
					source_id: ''
				}
    		}			
		},
		methods: {
			onSave(){
				let vm = this;
				if(this.tools.tool_id == 'void'){
					this.tools.link_id = this.id_l;
                 	this.tools.source_id = this.id_s;
					axios.post('/ajax.php', {table: 'resources', action: 'add', tools: this.tools, resources: this.resources})
				    .then(function (response) {
				    	console.log(response);
				        vm.tools.tool_id = response.data;
				        console.log(vm.tools.tool_id);
				    })
				    .catch(function (error) {
				        console.log(error);
				    });
				}
				else {
					axios.post('/ajax.php', {table: 'resources', action: 'update', tools: this.tools, resources: this.resources})
				    .then(function (response) {
				        //console.log(response);
				    })
				    .catch(function (error) {
				        console.log(error);
				    }); 
				}
				this.$emit('onModal', `add`);
			},
			onPars(){
				let vm = this;
				axios.post('/ajax.php', {table: 'resources', action: 'pars', url: this.url, data: this.tools.tool})
              	.then(function (response) {
	                vm.resources.resource = response.data;
          		})
		        .catch(function (error) {
		        	console.log(error);
		        }); 
			},
			onUpdate(table){
				let vm = this;
	        	axios.post('/ajax.php', {table: table, id_s: this.id_s, id_l: this.id_l, action: 'select'})
	        	.then(function (response) {
			        if(response.data.length == 0 ){
		         		if(table == 'tools') {
				         	vm.tools.tool_id = 'void';
				         	vm.tools.tool = 'void';
		        		} 
		        		else {
			         	vm.tools.resource_id = 'void';
			         	vm.tools.resource = 'void'; 
			        	}
		         	} 
		         	else {
		         		if(table == 'tools') {	         	
			        		vm.tools.tool_id = response.data[0].tool_id;
			        		vm.tools.tool = response.data[0].tool;
			        		vm.tools.source_id = vm.id_s;
			        		vm.tools.link_id = vm.id_l;
			        		vm.onUpdate('resources');
			        	} 
			        	else {		     	
					     	vm.resources.resource_id = response.data[0].resource_id;
					        vm.resources.resource = response.data[0].resource;
					        vm.resources.source_id = vm.id_s;
					        vm.resources.link_id = vm.id_l;
			     		}
		         	}
		        })
		        .catch(function (error) {
		        	console.log(error);
		        }); 
			}			
		},
		
    	created: function () {
            this.onUpdate('tools');
		}
	}
</script>

<style scoped lang='sass'>
.view_data
	height: 80%
.tool
	.fa
		font-size: 25px
.content
	width: 800px
	height: 40vh
	overflow: auto
	word-wrap: normal
	white-space: pre-wrap
	font-size: 10px
	color: #fafaff

tbody
	.content
		width: auto
		font-size: 16px
span
	width: 20px
</style>



