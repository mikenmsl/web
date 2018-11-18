<template>
<div>	
	<a href="#" class="boton"
	@click="$emit('onStart')"
	>
начать    
</a>
</div>

 
</template>

<script>
	$(window).ready(function(){
$(".boton").wrapInner('<div class=botontext></div>');
    
    $(".botontext").clone().appendTo( $(".boton") );
    
    $(".boton").append('<span class="twist"></span><span class="twist"></span><span class="twist"></span><span class="twist"></span>');
    
    $(".twist").css("width", "25%").css("width", "+=3px");
});
	export default {
		data () {
    return {
      
    }
  },
		methods: {
			
		}
	}
	
</script>
 
<style >
a{
	color: #fff;
}
.boton {
        width: 200px;
        height: 50px;
        margin: 200px auto;
        display: block;
        position: relative;
        color: #fff;
    }
    
    .botontext {
        position: absolute;
        height: 100%;
        width: 100%;
        z-index: 1;
        text-align: center;
        line-height: 50px;
        font-family: 'Montserrat', sans-serif;
        font-size: 12px;
        text-transform: uppercase;
    }
    
    .twist {
        display: block;
        height: 100%;
        width: 25%;
        position: relative;
        float: left;
        margin-left: -4px;
    }
    
    .twist:before {
        content: "";
        width: 100%;
        height: 100%;
        background: rgba(235,118,85,1);
        bottom: 100%;
        position: absolute;
        transform-origin: center bottom 0px; 
        transform: matrix3d(1, 0, 0, 0, 
                            0, 0, -1, -0.003, 
                            0, 1, 0, 0, 
                            0, 0, 0, 1);
        
-webkit-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
   -moz-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
     -o-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
        transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); /* custom */
    }
    
    .twist:after {
        content: "";
        position: absolute;
        width: 100%;
        top: 100%;
        height: 100%;
        background:  rgba(235,118,85,1);
        transform-origin: center top 0px;
        transform: matrix3d(1, 0, 0, 0, 
                            0, 1, 0, 0, 
                            0, 0, 1, -0.003, 
                            0, -50, 0, 1);
        
-webkit-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
   -moz-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
     -o-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
        transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); /* custom */
    }
    
    .boton:hover .twist:before {
        background: #313031;
        transform: matrix3d(1, 0, 0, 0, 
                            0, 1, 0, 0, 
                            0, 0, 1, 0.003, 
                            0, 50, 0, 1);
    }
    
    .boton:hover .twist:after {
        background: #313031;
        transform: matrix3d(1, 0, 0, 0, 
                            0, 0, -1, 0.003, 
                            0, 1, 0, 0, 
                            0, 0, 0, 1);
    }

    .boton .twist:nth-of-type(1) {
        margin-left: 0;
    }
    
    .boton .twist:nth-of-type(1):before,
    .boton .twist:nth-of-type(1):after {
        transition-delay: 0s;
    }
    
    .boton .twist:nth-of-type(2):before,
    .boton .twist:nth-of-type(2):after {
        transition-delay: 0.1s;
    }
    
    .boton .twist:nth-of-type(3):before,
    .boton .twist:nth-of-type(3):after {
        transition-delay: 0.2s;
    }
    
    .boton .twist:nth-of-type(4):before,
    .boton .twist:nth-of-type(4):after {
        transition-delay: 0.3s;
    }
    
    .boton .botontext:nth-of-type(1) {
        color: rgba(235,118,85,1);
        bottom: 100%;
        transform-origin: center bottom 0px; 
        transform: matrix3d(1, 0, 0, 0, 
                            0, 0, -1, -0.003, 
                            0, 1, 0, 0, 
                            0, 0, 0, 1);
        
-webkit-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
   -moz-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
     -o-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
        transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); /* custom */
    }
    
    .boton:hover .botontext:nth-of-type(1) {
        transform: matrix3d(1, 0, 0, 0, 
                            0, 1, 0, 0, 
                            0, 0, 1, 0.003, 
                            0, 50, 0, 1);
    }
    
    .boton .botontext:nth-of-type(2) {
        color: #313031;
        top: 100%;
        transform-origin: center top 0px;
        transform: matrix3d(1, 0, 0, 0, 
                            0, 1, 0, 0, 
                            0, 0, 1, -0.003, 
                            0, -50, 0, 1);
        
-webkit-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
   -moz-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
     -o-transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); 
        transition: all 500ms cubic-bezier(0.970, 0.000, 0.395, 0.995); /* custom */
    }
    
    .boton:hover .botontext:nth-of-type(2) {
        transform: matrix3d(1, 0, 0, 0, 
                            0, 0, -1, 0.003, 
                            0, 1, 0, 0, 
                            0, 0, 0, 1);
    }


	
</style>