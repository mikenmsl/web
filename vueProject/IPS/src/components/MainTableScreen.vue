<template>
<div>
	<template v-if="scenes == 'table'">
	<table cellpadding="0" cellspacing="0" border="0">	
		<thead>
			<tr class="sort">
				<th><span @click="onSort('id')"> </span></th>
				<th id="name"><span @click="onSort('name')"  v-bind:class="class_object.name">name</span></th>
				<th id="ip"><span @click="onSort('ip')"  v-bind:class="class_object.ip">ip</span></th>
				<th id="year"><span @click="onSort('year')"  v-bind:class="class_object.year">year</span></th>
				<th colspan="2" >
					<div id="search">
						<span @click="onSort('dev')"  v-bind:class="class_object.dev">developer</span>		
						<div class="search" >
							<input type="text" placeholder="Search..." v-model="search" autocomplete="off">
							<a><i @click="search = ''" class="fa fa-times" aria-hidden="true"></i></a>
							<a><i @click="onModal('options')"  class="fa fa-cog" aria-hidden="true"></i></a>
						</div>
						<div v-on-clickaway="away" v-if="opt" class="options">
							<div class="inputGroup">
							    <input id="names" value="name" type="checkbox" v-model="options"/>
							    <label for="names">name</label>
						  	</div>						  
						  	<div class="inputGroup">
							    <input id="ips" value="ip" type="checkbox" v-model="options"/>
							    <label for="ips">ip</label>
							</div>
							<div class="inputGroup">
							    <input id="years" value="year" type="checkbox" v-model="options"/>
							    <label for="years">year</label>
						  	</div>
						  	<div class="inputGroup">
							    <input id="devs"  value="dev" type="checkbox" v-model="options"/>
							    <label for="devs">developers</label>				    
						  	</div>
						  	<button @click="opt = false">ok</button>
						</div>
					</div>
				</th>				
			</tr>
		</thead>

		<tbody>
			<template v-for="(element, index) in filteredList">
				<tr> 
					<td @click="onChoice(element.source_id)"> {{ index+1 }} </td>
					<td @click="onChoice(element.source_id)"> {{ element.source_name }} </td>	
					<td @click="onChoice(element.source_id)"> {{ element.ip_address }} </td>
					<td @click="onChoice(element.source_id)"> {{ element.issued_year }} </td>	
					<td id="dev" @click="onChoice(element.source_id)"> {{ element.developers }} </td>
					<td> 
						<div class="button__holder">
							<button @click="onModal('edit', index)" data-modal-trigger="trigger-1" class="plus trigger">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</button>
							<button @click="onModal('remove', element.source_id)" data-modal-trigger="trigger-1" class="plus trigger">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
							</button>
						</div>
					</td>	
				</tr>
			</template>
		</tbody>
		<tfoot>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th class="tools">
					<div class="button__holder">
					    <button @click="onModal('add')" data-modal-trigger="trigger-1" class="plus trigger">
					     	<i class="fa fa-plus" aria-hidden="true"></i>
					    </button>
					</div>
				</th>
			</tr>
		</tfoot>	
	</table>


<div :class="modal_window_add" class="modal">
	<article class="content-wrapper">
		<button @click="onModal('add')" class="close"></button>
		<div class="content">
			<table cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
						<th>Name</th>
						<th>IP address</th>
						<th>issued year</th>
						<th>developers</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th><input v-model="add.source_name" type="text" maxlength="20"  required="true" /></label></th>
						<th><input v-model="add.ip_address" type="text" maxlength="20"  required="true" /></label></th>
						<th><input id="ye"	 v-model="add.issued_year" maxlength="4" type="text"  required="true" /></label></th>
						<th ><input v-model="add.developers" maxlength="70" type="text"  required="true" /></label></th>
						<th class="tool">
							<div class="button__holder">
		    					<button @click="addSource()" class="plus">
		    						<i class="fa fa-angle-double-right" aria-hidden="true"></i>
		    					</button>
							</div>
						</th>				
					</tr>
				</tbody>
			</table>
		</div>
	</article>
</div>

<div :class="modal_window_remove" class="modal rem">
	<article class="content-wrapper">
		<table class="rem" cellpadding="0" cellspacing="0" border="0">
			<thead>
				<tr>
					<th colspan="2">
						<p>Are you sure you want to delete source with all links and resources?</p>
					</th>
				</tr>
				<tr>
					<th> 
						<span @click="onModal('remove')" class="btn">cancel</span>					
					</th>
					<th> 
						<span @click="onRemove()" class="btn">delete</span> 
					</th>
				</tr>
			</thead>
		</table>
	</article>
</div>

<div :class="modal_window_edit" class="modal">
	<template v-if="modal_window_edit == 'open'">
		<article class="content-wrapper">
			<div class="content">
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th><input v-model="edit[0].source_name" value="edit[0].source_name" type="text" maxlength="20"  required="true"  /></label></th>
							<th><input v-model="edit[0].ip_address" value="edit[0].ip_address" type="text" maxlength="20"  required="true" /></label></th>
							<th><input v-model="edit[0].issued_year" value=edit[0].issued_year id="ye" maxlength="4" type="text"  required="true" /></label></th>
							<th><input v-model="edit[0].developers" value=(edit[0].developers) maxlength="70" type="text"  required="true" /></label></th>
							<th><div class="button__holder">
								<button @click="onEdit()"class="plus trigger"><i class="fa fa-floppy-o" aria-hidden="true"></button>
							</div></th>
						</tr>
					</thead>
					<tbody>
						<tr>										
						</tr>
					</tbody>
				</table>
			</div>
		</article>
	</template>
</div>

	</template>
	<template
	v-else-if="scenes == 'sources'"
	>
 <app-source-table-screen
      @onTable="onChoice(0)"
      :id_s="id_s"
    ></app-source-table-screen>
</template>
<template v-else>
    <div> Unkown state</div>
</template>

</div>
</template>

<script>
	import axios from 'axios';
	import { mixin as clickaway } from 'vue-clickaway';

	export default {
		mixins: [ clickaway ],
		data(){ 
			return {
			add: {
				source_id: '',
		        source_name: '',
		        ip_address: '',
		        issued_year: '',
		        developers: ''
	    	},
	    	opt: false,
	    	ignore: 1,
	    	search: '',
	    	sort: '',
	    	direction: 1,
			modal_window_add: 'close',
			modal_window_remove: 'close',
			modal_window_edit: 'close',
			scenes: 'table',
			id_s: '0',
			remove: '',
			options: [],
			edit: [],
			source: [],
			class_object: {
				name: '',
				ip: '',
				year: '',
				dev: '',
			}
		}
		},
		methods: {
			away: function(){
				this.opt = false;
			},
			onSort(title){
				this.direction = (this.sort == title) ? (this.direction * -1) : 1;
				this.class_object = {};
				switch(title){
					case 'id':

						this.source.sort(compare('source_id', this.direction));

						break;
					case 'name':
						this.class_object.name = (this.sort == title) ? 'on' + this.direction : 'on1';
						this.source.sort(compare('source_name', this.direction));
						break;
					case 'ip':
						this.class_object.ip = (this.sort == title) ? 'on' + this.direction : 'on1';
						this.source.sort(compare('ip_address', this.direction));

						break;
					case 'year':
						this.class_object.year = (this.sort == title) ? 'on' + this.direction : 'on1';
						this.source.sort(compare('issued_year', this.direction));

						break;
					case 'dev':
						this.class_object.dev = (this.sort == title) ? 'on' + this.direction : 'on1';
						this.source.sort(compare('developers', this.direction));

						break;

				}
				this.sort = title;

			},
			onEdit(){				
				axios.post('/ajax.php', {table: 'sources', action: 'edit', data: this.source[this.remove]})
		      	.then(function (response) {
			  	})
			  	.catch(function (error) {
			    	console.log(error);
			  	});
			  	this.onModal('edit');
			},
			onRemove(){
				if (this.remove == '3' || this.remove == '5') {
					alert("Impossible");
				}
				else {
				axios.post('/ajax.php', {table: 'all', action: 'remove', id: this.remove})
		      	.then(function (response) {
			  	})
			  	.catch(function (error) {
			    	console.log(error);
			  	});
			  	this.onUpdate();
			  	}
			  	this.onModal('remove');
			},
			addSource(){
				let lets = 0;
				let maxx = 0;
				for(this.lets = 0; this.lets <= (this.source.length - 1); this.lets++){			      	
			      	let val = (this.source[this.lets].source_id);
			      if(val > maxx){
						maxx = val;
					}
			    }
				this.add.source_id = Number(maxx) + 1;
				this.source.push(this.add);
				axios.post('/ajax.php?', {table: 'sources', action: 'add', data: this.add})
				      .then(function (response) {
				  })
				  .catch(function (error) {
				    console.log(error);
				  }); 
				this.modal_window_add = 'close';
				this.add = {};
			},
			onModal(choice, index){
				switch(choice){
					case 'add':
						this.modal_window_add = (this.modal_window_add == 'close') ? 'open' : 'close';
						break;
					case 'remove':
						this.remove = index;
						this.modal_window_remove = (this.modal_window_remove == 'close') ? 'open' : 'close';
						break;
					case 'edit':
						this.edit = [];
						this.remove = index;
						this.edit.push(this.source[index]);
						this.modal_window_edit = (this.modal_window_edit == 'close') ? 'open' : 'close';
						break;
					case 'options':
						this.ignore = 1;
						this.opt = (this.opt == false) ? true : false;
						break;
				}				
			},
			onChoice(id){
				if(this.scenes == 'sources'){
					this.id_s = 0;
					this.scenes = 'table'
				}
				else{
					this.id_s = id;
					this.scenes = 'sources';
				}
			},
			onUpdate(){
		      	let vm = this;
		    	let i = 0;
		    	this.source = [];
		      	axios.post('/ajax.php', {table: 'sources', action: 'select'})
		      	.then(function (response) {
		    	vm.i = 0;
		   		for(vm.i = 0; vm.i <= (response.data.length - 1); vm.i++){
		      		vm.source.push(response.data[vm.i]);
		    	}
			  })
			  .catch(function (error) {
			    console.log(error);
			  });  
		  	}
		},
		computed: { 
		    filteredList() {
		      	return this.source.filter(post => {
		      		let str = '';
		      		if(this.options.indexOf('name') != -1){
		      			str = str + ' ' + post.source_name + ' ';
		      		}
		      		if(this.options.indexOf('ip') != -1){
		      			str = str + ' ' + post.ip_address + ' ';
		      		}
		      		if(this.options.indexOf('year') != -1){
		      			str = str + ' ' + post.issued_year + ' ';
		      		}
		      		if(this.options.indexOf('dev') != -1){
		      			str = str + ' ' + post.developers + ' ';
		      		}
		      		
		      		if(this.options.length == 0){
		      			str = post.source_name + ' ' + post.issued_year + ' ' + post.ip_address + ' ' + post.developers;
		      		}
			        return str.toLowerCase().includes(this.search.toLowerCase())
		      	})
		    }
		},
    	created: function () {
            this.onUpdate();
		},
	}
//https://habr.com/post/279867/
	function compare(field, order) {
	    var len = arguments.length;
	    if(len === 0) {
	        return (a, b) => (a < b && -1) || (a > b && 1) || 0;
	    }
	    if(len === 1) {
	        switch(typeof field) {
	            case 'number':
	                return field < 0 ?
	                    ((a, b) => (a < b && 1) || (a > b && -1) || 0) :
	                    ((a, b) => (a < b && -1) || (a > b && 1) || 0);
	            case 'string':
	                return (a, b) => (a[field] < b[field] && -1) || (a[field] > b[field] && 1) || 0;
	        }
	    }
	    if(len === 2 && typeof order === 'number') {
	        return order < 0 ?
	            ((a, b) => (a[field] < b[field] && 1) || (a[field] > b[field] && -1) || 0) :
	            ((a, b) => (a[field] < b[field] && -1) || (a[field] > b[field] && 1) || 0);
	    }
	    var fields, orders;
	    if(typeof field === 'object') {
	        fields = Object.getOwnPropertyNames(field);
	        orders = fields.map(key => field[key]);
	        len = fields.length;
	    } else {
	        fields = new Array(len);
	        orders = new Array(len);
	        for(let i = len; i--;) {
	            fields[i] = arguments[i];
	            orders[i] = 1;
	        }
	    }
	    return (a, b) => {
	        for(let i = 0; i < len; i++) {
	            if(a[fields[i]] < b[fields[i]]) return orders[i];
	            if(a[fields[i]] > b[fields[i]]) return -orders[i];
	        }
	        return 0;
	    };
	}
</script>

<style lang="sass">
$orange: rgba(235,118,85,1)
$dark-bg: rgba(0,0,0,0.9)
$light-bg: rgba(255,255,255,0.1)
$text: rgba(255,255,255,0.9)
$base-duration: 0.25s
table 
	background: #fff
	border: none
	border-radius: 5px
	margin: 50px auto
	width: 1000px
	color: rgba(255,255,255,0.9)
  	height: 45px
  	font-size: 0
th, td
	text-align: left
	padding: 15px
	border-bottom: solid 1px rgba(255,255,255,0.1)

thead, tfoot
	tr
	border-radius: 5px
	background-color: #444544
tbody
	background-color: #313031
	tr
		cursor: pointer
		transition: 0.25s
	tr:hover
		background-color: rgba(235,118,85,0.65)

.sort
	span
		cursor: pointer
	span:hover
		color: #c6c6c6
	
	.on1:after
		margin-left: 7px
		content: '↓'
	.on-1:after
		margin-left: 7px
		content: '↑'
		
// BUTTON add
button
	outline: none
	cursor: pointer
	margin-left: 20px

.button__holder
	outline: none
    position: relative
    width: 100%
    height: 100%
    display: flex
    flex-wrap: wrap
    align-items: center
    justify-content: center
	.button__holder:after
	    content: ""
	    position: absolute
	    z-index: 0
	    top: 0
	    right: 0 
	    bottom: 0 
	    left: 0
	.plus
	    position: relative
	    z-index: 1
	    width: 35px
	    height: 35px
	    color: #1a1a1a
	    background: $orange
	    border-radius: 50%
	    border: none
	    transition: box-shadow 400ms cubic-bezier(.2,0,.7,1), transform 200ms cubic-bezier(.2,0,.7,1)
	
	.plus:hover
	    box-shadow: 0 0 1px 7px rgba(#eb5501, 0.3),
	    0 0 1px 14px rgba(#eb5501, 0.1),
	.plus:active
		box-shadow: inset 0 0 10px #313031
	
	.plus
		.fa
			font-size: 26px
tbody
	.button__holder
		.plus:hover
		    box-shadow: 0 0 1px 7px rgba(#353538, 0.3),
		    0 0 1px 14px rgba(#353538, 0.1),


// END
.modal
	table
		tr
			cursor: default
			background-color: $light-bg
	position: fixed
	top: 0
	left: 0
	display: flex
	align-items: center
	justify-content: center
	z-index: 9999
	
	&.open 
		position: fixed
		width: 100%
		height: 100vh
		background-color: rgba(0,0,0,0.5)
		transition: background-color $base-duration
		> .content-wrapper 
			transform: scale(1.0)
	&.close
		transform: scale(0)
		transition: all 0.4s ease-out
	
	.content-wrapper 
		position: relative
		display: flex
		flex-direction: column
		align-items: center
		justify-content: flex-start
		margin: 0
		padding: 2.5rem
		background: -webkit-linear-gradient(left, #4e4e52 20px, transparent 1%) center, -webkit-linear-gradient(#4e4e52 20px, transparent 1%) center, #635f5f
		background: linear-gradient(90deg, #4e4e52 20px, transparent 1%) center, linear-gradient(#4e4e52 20px, transparent 1%) center, #635f5f
		background-size: 22px 22px
		border-radius: 0.3125rem
		box-shadow: 0 0 2.5rem rgba(0,0,0,0.5)
		transform: scale(0.0)
		transition: transform $base-duration
		transition-delay: 0.15s
	
		.close 
			position: absolute
			top: 0.5rem
			right: 0.5rem
			display: flex
			align-items: center
			justify-content: center
			width: 2.5rem
			height: 2.5rem
			border: none
			background-color: transparent
			font-size: 1.5rem
			transition: $base-duration linear
			&:before, &:after 
				position: absolute
				content: ''
				width: 1.25rem
				height: 0.125rem
				background-color: black
			&:before 
				transform: rotate(-45deg)
			&:after 
				transform: rotate(45deg)
			&:hover 
				transform: rotate(90deg)
				&:before, &:after 
					background-color: $orange;
				
	input
		background: transparent
		border: none
		width: 100%
		border-bottom: 1px dashed #fff
		color: $orange	
		outline: none
		font-size: 18px
		padding: 0px 0px 0px 0px
	input:focus
		border-bottom: 1px dashed $orange		
	.plus:after
		content: ''
	.plus:hover
		transform: none
	.plus
		.fa
			color: rgba(0,0,0,0.8)
			positipn: absolute
			font-size: 2.4em
.tools
	width: 120px
#ye
	width: 60px
	letter-spacing: 5px
#name, #ip
	width: 120px
#year
	width: 50px

.tool
	width: 50px


.rem
	th
		vertical-align: text-top
		p
			text-align: center
	.btn
  		color: #fff
  		cursor: pointer
  		// display: block;
  		font-size: 16px
  		font-weight: 400
  		line-height: 45px
  		margin-left: 80px
  		position: absolute
  		text-decoration: none
  		text-transform: uppercase
    	letter-spacing: 0
    	
	.btn:hover, .btn:active 
		letter-spacing: 5px
		color: $orange
	.btn:after, .btn:before 
	  	backface-visibility: hidden
	  	border: 1px solid rgba($orange, 0)
	  	bottom: 0px
	  	content: " "
	  	display: block
	  	margin: 0 auto
	  	position: relative
	  	transition: all 280ms ease-in-out
	  	width: 0
	.btn:hover:after, .btn:hover:before 
	  	backface-visibility: hidden
	  	border-color: $orange
	  	transition: width 350ms ease-in-out
	  	width: 70%	
	.btn:hover:before 
	  	bottom: auto
	  	top: 0
	  	width: 70%
	
	.rem
		width: auto
		tr
			height: 100px


//SEARCH

#search
	display: grid
	grid-template-columns: 30% 70%
	grid-template-rows: auto
	align-items: center	
	position: relative
	input
		width: 150px
		height: 30px
		border-radius: 13px 0px 0px 13px
		right: 0
		outline: none
		background-color: #313031
		border: 2px solid $orange
		border-right: none
	div
		justify-self: end
	.search	   		
		a:nth-of-type(1)			
			border-top: 2px solid $orange
			border-bottom: 2px solid $orange
			transition: 0.5s
			color: #444544
		a:nth-of-type(2)
			border: 2px solid $orange
			border-left: 1px dotted $orange
			border-radius: 0px 13px 13px 0px 
			color: $orange
		a
			margin-left: -5px
			background-color: #313031
			padding: 7px 8px 8px 8px
			.fa
				cursor: pointer
				-webkit-transition-duration: 0.8s
				-moz-transition-duration: 0.8s
				-o-transition-duration: 0.8s
				transition-duration: 0.8s
				-webkit-transition-property: -webkit-transform
				-moz-transition-property: -moz-transform
				-o-transition-property: -o-transform
				transition-property: transform
			.fa:hover
				-webkit-transform: rotate(360deg)
				-moz-transform: rotate(360deg)
				-o-transform: rotate(360deg)
				transform: rotate(90deg)
				transition: 0.5s
.options
	position: absolute
	width: 300px
	height: 230px
	margin-top: 35px
	z-index: 10
	align-self: start
	background-color: #313031
	border: 1px dotted rgba(68, 69, 68, 0.6);
	button
		padding: 8px 26px
		background-color: #444544
		color: #fff
		border: 2px solid #444544
		transition: all 300ms cubic-bezier(0.4, 0.0, 0.2, 1)
	button:hover
		background-color: rgba(235,118,85,0.65)
	button:active
		background-color: rgba(235,118,85,0.85)
		border: 2px solid rgba(68, 69, 68, 0.8);
.inputGroup 
    background-color: #444544
    display: block
    width: 90%
    margin: 10px auto
    position: relative

    label 
    	padding: 8px 26px
    	display: block
    	text-align: left
    	color: #fff
    	cursor: pointer
    	position: relative
    	z-index: 2
    	transition: color 200ms ease-in
    	overflow: hidden

	    &:before 
	        width: 10px
	        height: 10px
	        border-radius: 50%
	        content: ''
	        background-color: rgba(235,118,85,0.65)
	        position: absolute
	        left: 50%
	        top: 50%
	        transform: translate(-50%, -50%) scale3d(1, 1, 1)
	        transition: all 300ms cubic-bezier(0.4, 0.0, 0.2, 1)
	        opacity: 0
	        z-index: -1      
	    &:after 
	        width: 26px
	        height: 26px
	        content: ''
	        border: 2px solid #D1D7DC
	        background-color: #313031
	        background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ")
	        background-repeat: no-repeat
	        background-position: 2px 3px
	        border-radius: 50%
	        z-index: 2
	        position: absolute
	        right: 30px
	        top: 50%
	        transform: translateY(-50%)
	        cursor: pointer
	        transition: all 200ms ease-in
    input:checked ~ label 
      	color: #fff
      	&:before 
	        transform: translate(-50%, -50%) scale3d(56, 56, 1)
	        opacity: 1
      	&:after 
	        background-color: $orange
	        border-color: $orange
    input 
	    width: 26px
	    height: 26px
	    order: 1
	    z-index: 2
	    position: absolute
	    right: 30px
	    top: 50%
	    transform: translateY(-50%)
	    cursor: pointer
	    visibility: hidden
  

</style>