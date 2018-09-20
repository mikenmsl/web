<template>
  <div class="training">
    <h1>Math training. Level {{ level + 1 }}</h1>
    <p>mode: {{ mods }}</p>
    <hr>
    <div class="progress">
      <div class="progress-bar" :style="progressStyles"></div>
    </div>
    <div class="box">
      <transition name="flip" mode="out-in">
    <app-start-screen 
    v-if="state == 'start'"
    @onStart="onStart"
    @onAdd="onAdd"
    @onMul="onMul"
    ></app-start-screen>
    <app-question
      v-else-if="state == 'question'"
      @success="onQuestionSuccess"
      @error="onQuestionError"
      :settings="levels[modsLevel + level]"
      :mods="mode"
     ></app-question>
    <app-message 
      v-else-if="state == 'message'"
      :type="message.type"
      :text="message.text"

      @onNext="onNext"
    >
      
    </app-message>
    <app-result-screen 
        v-else-if="state == 'results'"
        :stats="stats"
        @repeat="onStart"
        @nextLevel="nextLevel"
    ></app-result-screen>
    <div v-else> Unkown state</div>
  </transition>
    </div>
  </div>
</template>

<script>
  export default{
    name: 'app',
    data() {
      return {
        modsLevel: 0,
        mods: 'addition',
        mode: 1,
          state: 'start',
          stats: {
            success: 0,
            error: 0
          },
          message: {
            type: '',
            text: ''
          },
          questMax: 3,
          level: 0,
          levels: [
          {
            questMax: 3,
            from: 2,
            to: 9,
            range: 5,
            variants: 2
          },
          {
            questMax: 5,
            from: 7,
            to: 20,
            range: 12,
            variants: 4
          },
          {
            questMax: 7,
            from: 11,
            to: 30,
            range: 30,
            variants: 6
          },
          {
            questMax: 3,
            from: 10,
            to: 40,
            range: 10,
            variants: 2
          },
          {
            questMax: 5,
            from: 100,
            to: 200,
            range: 20,
            variants: 4
          },
          {
            questMax: 7,
            from: 100,
            to: 700,
            range: 100,
            variants: 6
          },
          {
            questMax: 7,
          }
          ]
      }
    },
    computed: {
      questDone(){
        return this.stats.success + this.stats.error;
      },
      progressStyles(){
        return {
          width: (this.questDone / this.levels[this.level].questMax * 100) + '%'
        };
      }
    },
    methods: {
       onAdd(text){
        this.mode = 1;
        this.mods = text;
        this.modsLevel = 3;
      },
      onMul(text){
        this.mode = 2;
        this.mods = text;
        this.modsLevel = 0;
      },
     
      nextLevel(){
        this.level++;
        this.onStart();
      },
      onStart(){
          if (this.level == 3){
            this.state = 'message';
            this.message.text = 'All levels are over!';
            this.message.type = "dark";
          }
          else {
          this.state = 'question';
          this.stats.success = 0;
          this.stats.error = 0;
        }
      },
      
      onQuestionSuccess(){
        this.state = 'message';
        this.message.text = "Good Job!";
        this.message.type = "success";
        this.stats.success++;
      },
      onQuestionError(msg){
        this.state = 'message';
        this.message.text = msg;
        this.message.type = "warning";
        this.stats.error++;
      },
      onNext(){
        if(this.questDone < this.levels[this.level].questMax){
          this.state = 'question';
          console.log('onNext 1');
        }
        else if(this.level == 3){
            this.level = 0;
            this.stats.success = 0;
            this.stats.error = 0;
            this.state = 'start'
            console.log('onNext 2');
        }
        else{
          this.state = 'results';
          console.log('onNext 3');
        }
      }
      
    }

  }

</script>

<style scoped>
    .training {
        margin: 20px auto;
        max-width: 700px;
      }


    .box{
      margin: 10px 0;
    }

    .progress-bar{
      transition: width 0.5s;
    }

    .flip-enter{
      
    }

    .flip-enter-active{
      animation: flipInX 0.2s linear;
    }

    .flip-leave{
      
    }

    .flip-leave-active{
      animation: flipOutX 0.2s linear;
    }

  @keyframes flipInX{
    from{transform: rotateX(90deg);}
    to{transform: rotateX(0deg);}
  }

  @keyframes flipOutX{
    from{transform: rotateX(0deg);}
    to{transform: rotateX(90deg);}
  }


</style>
