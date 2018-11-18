<template>

<div class="source">  
  
    <table cellpadding="0" cellspacing="0" border="0"
    v-if="state == 'table'"
    class="sources" >  
	    <thead>
	      <tr>
	        <th>
	          <input v-model="checked" type='checkbox' id='heat' @click="onSample">
	          <label for='heat'></label>
	        </th>
	        <th>#</th>
	        <th>URL</th>
	        <th></th>
	      </tr>
	    </thead>
	    <tbody>
	    	<template v-for="(element, index) in links">
			    <tr
			    @click="onChoice(element.link_id, index)"
			    :class="{ act: (storage_id.indexOf(element.link_id) != -1) }">
				    <td></td>
				    <td > {{ index+1 }}</td>
				    <td>{{ element.url }}</td>  
				    <td class="tools">
				    	<div class="button__holder">
				    		<button @click="$emit('onUpdate')" @click="onChoice(element.link_id, index)" @click="onModal('add', element.link_id, element.url)"  class="plus trigger"><i class="fa fa-info" aria-hidden="true"></button>
				    	<div>
				    </td> 
			    </tr>
	  		</template>
	    </tbody>
	    <tfoot>
		    <tr>
		    	<th @click="$emit('onTable')">
		    		<svg width="18px" height="17px" viewBox="0 0 18 17" version="1.1" >
		    			<g id="prev" transform="translate(8.500000, 8.500000) scale(-1, 1) translate(-8.500000, -8.500000)">
		    				<polygon class="arrow" points="16.3746667 8.33860465 7.76133333 15.3067621 6.904 14.3175671 14.2906667 8.34246869 6.908 2.42790698 7.76 1.43613596"></polygon>
		    				<polygon class="arrow-fixed" points="16.3746667 8.33860465 7.76133333 15.3067621 6.904 14.3175671 14.2906667 8.34246869 6.908 2.42790698 7.76 1.43613596"></polygon>
		    				<path d="M-1.48029737e-15,0.56157424 L-1.48029737e-15,16.1929159 L9.708,8.33860465 L-2.66453526e-15,0.56157424 L-1.48029737e-15,0.56157424 Z M1.33333333,3.30246869 L7.62533333,8.34246869 L1.33333333,13.4327013 L1.33333333,3.30246869 L1.33333333,3.30246869 Z"></path>
		    			</g>
		  			</svg>
				</th>
		        <th></th>
		        <th></th>
		        <th class="tools">
		        	<div class="button__holder">
		    			<button @click="onModal('remove')"  class="plus trigger"><i class="fa fa-plus" aria-hidden="true"></button>
		       			<button class="plus trigger"><i class="fa fa-pencil" aria-hidden="true"></i></button>
		        		<button @click="onRemove()"  class="plus trigger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
		        	</div>
		        </th>
		    </tr>
	    </tfoot>

		<div data-modal="trigger-1" :class="modal_window_remove" class="modal">
	  		<article class="content-wrapper">
	    		<button @click="onModal('remove')" class="close"></button>
	      		<p>Добавление информации</p>
	    		<div class="content">
	      			<table cellpadding="0" cellspacing="0" border="0">
	        			<thead>
					      <tr>
					        <th>url</th>
					        <th class="tools"></th>
					      </tr>
				    	</thead>
	    				<tbody>
				      		<tr>
						        <th>
						        	<input v-model="add.url" type="text" required="true" />
						        </th>
								<th >
									<div class="button__holder">
						    			<button @click="addSource()" class="plus"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
									</div>
								</th>
				     		</tr>
				    	</tbody>
			      </table>
			    </div>
			</article>
		</div>

    </table>

	<div data-modal="trigger-1" :class="modal_window_add" class="modal">
  		<article class="content-wrapper">
    		<button @click="onModal('add')" class="close"></button>
    			<app-view-date
			    v-if="view == 'yes'"
				:id_l="date_id"
				:id_s="id_s"
				:url="url"
				@onModal="onModal"
			    ></app-view-date>      
			    <div class="content">
			    </div>
	  	</article>
	</div>

</div>
</template>

<script>
import axios from 'axios';

  export default {
    props: ['id_s'],
    data () {
    return {
    	url: '',
    	view: 'no',
    	date_id: '0',
    	state: 'table',
      add: {
        link_id: '',
        source_id: '',
        url: '',
      },
      checked: false,
      modal_window_remove: 'close',
      modal_window_add: 'close',
      storage_id: [],
      storage_index: [],
      links:[]
      
    }
  },
  compured: {
    

  },
    methods: {
    	
	    onRemove(){
	        if (this.storage_id.length == 0){
	          alert('please select item to remove');
	        }
	        else {
	          axios.post('/ajax.php?', {table: 'links', action: 'remove', id: this.id_s, data: this.storage_id})
	              .then(function (response) {
	                
	          })
	          .catch(function (error) {
	            console.log(error);
	          }); 
	          let lets = 0;
	          	this.storage_index.sort(function(a,b){return a - b});
	          for(this.lets = (this.storage_index.length - 1); this.lets >= 0; this.lets--){
	            this.links.splice(this.storage_index[this.lets], 1);
	          } 
	          this.storage_id = [];
	          this.storage_index = [];
	        }
	    },
      	addSource(){
	        let lets = 0;
	        let maxx = 0;
	        for(this.lets = 0; this.lets <= (this.links.length - 1); this.lets++){
	            let val = (this.links[this.lets].link_id);
	            if(val > maxx){
	            	maxx = val;
	        	}
	        }
	        this.add.link_id = Number(maxx) + 1;
	        this.add.source_id = this.id_s;
	        this.links.push(this.add);
	        axios.post('/ajax.php?', {table: 'links', action: 'add', data: this.add})
	              .then(function (response) {
	          })
	          .catch(function (error) {
	            console.log(error);
	          }); 
	        this.modal_window_remove = 'close';
	        this.add = {};
      	},

      	onUpdate(){
	        let vm = this;
	        let i = 0;
	        axios.post('/ajax.php', {table: 'links', id: this.id_s, action: 'select'})
	        .then(function (response) {
		        vm.i = 0;
		        for(vm.i = 0; vm.i <= (response.data.length - 1); vm.i++){
		        	vm.links.push(response.data[vm.i]);
		        }
	        })
	        .catch(function (error) {
	          console.log(error);
	        });  
        },
  
      	onModal(num, id, url){
	        switch (num){
	          case 'remove':
	            	this.modal_window_remove = (this.modal_window_remove == 'close') ? 'open' : 'close';
	          break;
	          case 'add':
			        this.date_id = id;
			        this.url = url;
			        if(this.modal_window_add == 'close'){
			        	this.modal_window_add = 'open';
					this.view = 'yes';
			        }
			        else{
			        	this.modal_window_add = 'close';
			        	this.view = 'no';
			        }
	          break;

        	}
    	},
	    onSample(){
	        let vm = this;
	        let ii = '0';
	        if(!this.checked){
	        	this.storage_id = [];
	        	this.storage_index = [];
	        	this.links.forEach(function(link, ii){
	            let id = link.link_id;
	            let index = Number(ii) ;
	            ii += 1;
	            vm.onChoice(id, index);            
	          }); 
	        }
	        else{
	          this.storage_id = [];
	          this.storage_index = [];
	          this.checked = true;
	        }
	    },
      onChoice(id, index){
        let value = this.storage_id.indexOf(id);
        if(value != -1) {
            this.storage_index.splice(value, 1);
            this.storage_id.splice(value, 1);
        } 
        else {     
            this.storage_id.push(id);
            this.storage_index.push(index);
        }
	}
	},
  created: function () {
        this.onUpdate();
    }
}
</script>

<style lang="scss" scoped>

.tools{
	width: 220px;
}
$orange: rgba(235,118,85,1);
tbody {
  background-color: #313031;
  tr{
    cursor: default;
  }
  }
$track-w: 2.2em;
$track-h: 1.325em;
$track-b: .1725em;
$thumb-w: .5*($track-w - 2*$track-b);
$thumb-h: $track-h - 2*$track-b;
$thumb-b: 1.2px;
$c: rgba(#777, .04);
$list: $c 0, $c 2px, transparent 0, transparent 5px;
*, :before, :after { box-sizing: border-box }
thead{
input {
  position: absolute; left: -100vw;
  &:checked + label { --s: 1 }
}
}
label { --s: 0;
  display: block;
  position: relative; 
  --c: $orange;
  text-indent: -100vw;
  filter: blur(.5px);cursor: pointer;
  &, &:before {
    border: solid $track-b transparent;
    width: $track-w; height: $track-h;
    border-radius: .5*$track-h;
    box-shadow: inset 0 .125em .75em rgba(#000, .5);
    background: repeating-linear-gradient(-45deg, $list) padding-box, repeating-linear-gradient(45deg, $list) padding-box, 
      
  }
  &:before, &:after { position: absolute;
    top: 0; left: 0;
    content: ''
  }
  &:before { margin: -$track-b;
    opacity: calc(1 - var(--s));
    --c: #313031;
    transition: .2s opacity;
  }
  &:after {
    border: solid $thumb-b transparent;
    width: $thumb-w; height: $thumb-h;
    border-radius: .5*$thumb-h;
    transform: translate(calc(var(--s)*100%));
    box-shadow: 0 2px 9px rgba(#000, .8);
    background: linear-gradient(#d1d1d1, #000) padding-box, linear-gradient(#fcfcfc, #000) border-box;
    transition: .2s transform ease-in;
  }
}
thead{
  th:nth-of-type(1){
    width: 40px;
  }

}
.act{
  background-color: $orange;
}

//BUTTON BACK START
$ease: cubic-bezier(.2,1,.3,1);
  svg {
    width: 30px;
    height: auto;
    color: red;
    cursor: pointer;
    overflow: visible;
    polygon, path {
       fill: rgba(0,0,0,0.9);
      transition: all 0.5s $ease;
    }
    &:hover polygon, &:hover path {
      transition: all 1s $ease;
      fill: $orange;
    }
      
    &:hover .arrow {
      animation: arrow-anim 2.5s $ease infinite;
    }
    &:hover .arrow-fixed {
      animation: arrow-fixed-anim 2.5s $ease infinite;
    }
  }


@keyframes arrow-anim {
  0% {
    opacity: 1;
    transform: translateX(0);
  }
  5% {
    transform: translateX(-0.1rem);
  }
  100% {
    transform: translateX(1rem);
    opacity: 0;
  }
}

@keyframes arrow-fixed-anim {
  5% {
    opacity: 0;
  }
  20% {
    opacity: 0.4;
  }
  100% {
    opacity: 1;
  }
}
//BUTTON END





  
</style>