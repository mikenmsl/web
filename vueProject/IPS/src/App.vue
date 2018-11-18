<template>
  <div>
  <div class="theme">
        <input type="checkbox" id="dark" value="dark" v-model="class_style" /><label for="dark" >Toggle</label>
      </div>
    <div v-bind:class="[class_style ? '' : 'dark']">
      
   
    <app-start-screen
      v-if="state == 'start'"
      @onStart="onStart"
    ></app-start-screen>
    <app-main-table-screen
       v-else-if="state == 'main'"
    ></app-main-table-screen>
    

<div v-else> Unkown state</div>

</div>
<div class="container" v-bind:class="[class_style ? '' : 'dark']">
  <div class="effect">
    <div class="buttons">
      <a href="https://www.vk.com/domaska"  ><i class="fa fa-vk" aria-hidden="true"></i></a>
      <a href="https://www.instagram.com/zotovnikitos/"  ><i class="fa fa-instagram" aria-hidden="true"></i></a>
      <a href="https://www.linkedin.com/in/nikita-zotov-34062a170/"  ><i class="fa fa-linkedin" aria-hidden="true"></i></a>
    </div>
  </div>
</div>
  </div>
</template>

<script>

export default {
  name: 'app',
  data () {
    return {
      state: 'start',
      class_style: 'true',
    }
  },
  methods: {
    onStart(){
      this.state = 'main';
    }
   
}
}
</script>

<style lang="scss">
.dark{
  filter: invert(100%);
}
.theme{
  height: 0;
  width: 0;
  input[type=checkbox]{
  height: 0;
  width: 0;
  position: fixed;
  visibility: hidden;
}

label {
  cursor: pointer;
  text-indent: -9999px;
  width: 60px;
  height: 30px;
  background: #158aaa;
  display: block;
  border-radius: 100px;
  position: absolute;
  top: 10px;
  left: 10px;
}

label:after {
  content: '';
  position: absolute;
  top: 1px;
  left: 2px;
  width: 28px;
  height: 28px;
  background: #fff;
  border-radius: 50%;
  transition: 0.3s;
}

input:checked + label {
  background: rgba(235,118,85,1);
}

input:checked + label:after {
  left: calc(100% - 2px);
  transform: translateX(-100%);
}

label:active:after {
  width: 33px;
}
}
body, html {
  margin: 0;
  height: 100%;
  background: -webkit-linear-gradient(left, #4e4e52 20px, transparent 1%) center, -webkit-linear-gradient(#4e4e52 20px, transparent 1%) center, #635f5f; 
  background: linear-gradient(90deg, #4e4e52 20px, transparent 1%) center, linear-gradient(#4e4e52 20px, transparent 1%) center, #635f5f; 
  background-size: 22px 22px; 
  }
#app {
  height: 100%;
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.container{
    position: fixed;
    bottom: 10px;
    right: 10px;
}
.effect {
  width: 100%;
  
  .buttons {
    display: flex;
    justify-content: end;   
    right: 10px;
    bottom: 10px;
}
  }

.effect {  
  a {
    text-decoration: none !important;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-right: 20px;
    font-size: 17px;
    overflow: hidden;
    position: relative;
    color: #212121; 
    border: 2px solid #212121; 
    
    i {
      position: relative;
      z-index: 3;
    }
    
    &:last-child {
      margin-right: 0px;
    }
    
    &:before {
      content: "";
      display: inline-block;
      height: 100%;
      vertical-align: middle;
    }
    
    i {
      display: inline-block;
      vertical-align: middle;
    }
  }
}
.effect {
  a {
    transition: border-radius 0.2s linear 0s;
    transform: rotate(45deg);
    
    i {
      transition: transform 0.01s linear 0s;
      transform: rotate(-45deg);
      color: rgba(235,118,85,1);
      
    }
    
    &:hover {
      background-color: rgba(235,118,85,1);
      border: 2px solid rgba(235,118,85,1);
      border-radius: 0px;
      i{
        color: #212121;
      }
    }
  }
}

</style>
