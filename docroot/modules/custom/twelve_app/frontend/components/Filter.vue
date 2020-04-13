<template>
  <div>
    <name-form
      v-on:show-modal="nameModalVisible = true"
      v-on:hide-modal="nameModalVisible = false"
    ></name-form>

    <div class="modal fade show d-block excercise-container" v-for="item in options"
         v-if="currentExcercise === item.id">
      <div class="modal-backdrop fade in"></div>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">BURST DETAILS</h4>
            <button type="button" class="close notranslate" aria-label="Close"
                    v-on:click="closeExerciseModal"
            ><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="description" v-html="item.description"></div>
            <div class="animation" v-if="item.gif_path"><img :src="item.gif_path"></div>
          </div>
          <div class="modal-footer">
            <div class="countdown notranslate" v-if="timerIsRunning">
              <countdown
                ref="countdown"
                :time="item.timer * 1000"
                @start="triggerTimerStart(item.id)"
                @end="triggerTimerEnd(item.id)"
                :emit-events="true"
                v-if="timerIsRunning"
              >
                <template
                  slot-scope="props"
                >{{ props.minutes | formatNumber }}:{{ props.seconds | formatNumber }}
                </template>
              </countdown>
            </div>
            <button type="button" class="btn btn-blue notranslate"
                    v-if="timerIsRunning"
                    @click="toggleTimerPause"
            >
              <template v-if="timerIsPaused">CONTINUE</template>
              <template v-else>PAUSE</template>
            </button>
            <button type="button" class="btn btn-blue notranslate"
                    v-if="checked.includes(item.id)"
                    @click="closeExerciseModal"
            >
              COMPLETE
            </button>
            <button type="button" class="btn btn-default notranslate"
                    v-if="!timerIsRunning && !checked.includes(item.id)"
                    @click="timerIsRunning = true"
            >
              READY … SET … GO!
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="message">Click an activity below. Keep going until you've clicked them all!</div>

    <div class="container" v-bind:class="{'visually-disabled': nameModalVisible || exerciseModalVisible}">
      <div class="today-progress-item"
           v-for="item in options"
           v-on:click="openExerciseModal(item.id)"
           :class="{'checked': checked.includes(item.id)}"
      >
        <div
          v-bind:class="{'fa-check': checked.includes(item.id)}"
          class="checkbox fa"
        ></div>
        <div class="title">{{ item.label }}</div>
        <div class="description" v-html="item.description"></div>
      </div>
    </div>
  </div>

</template>

<script>

  import NameForm from '../components/NameForm.vue';
  import Countdown from '@chenfengyuan/vue-countdown';
  // We expect structure of Options:
  // {
  //    314: {
  //      label: "30 push up",
  //      description: "Do this excercise 5 min"
  //    },
  //    394: {
  //      label: " 40 Jumps",
  //      description: "Please do 40 jumps in "
  //  }

  /**
   * append leading zero if number is lesser then 10
   */
  Vue.filter("formatNumber", function (n) {
    return (n < 10) ? ("0" + n) : n;
  });

  export default {
    props: [
      'options',
      'current_nid',
      'completion_url'
    ],
    components: {
      NameForm,
      Countdown
    },
    data: function () {
      return {
        checked: [],
        currentExcercise: 0,
        timerIsRunning: false,
        timerIsPaused: false,
        exerciseModalVisible: false,
        nameModalVisible: false
      };
    },
    created: function () {
      let cache = this.loadTodayProgressFromLocalStorage();
      for (let index = 0; index < cache.length; index++) {
        this.checked.push(cache[index]);
      }
    },
    computed: {},
    methods: {

      triggerTimerEnd: function (id) {
        if (this.checked.indexOf(id) === -1) {
          this.checked.push(id);
          this.$emit('data-update', this.checked);
          this.beep();
          this.timerIsRunning = false;

          this.saveTodayProgressToLocalStorage();

          this.$notify({
            group: 'twelve_app',
            title: 'Hooray, you have finished your excercise!',
            text: 'Now, lets have some rest.'
          });
        }
        else {
          this.checked.splice(this.checked.indexOf(id), 1);
        }
      },

      triggerTimerStart: function (id) {
        // console.log(id);
      },

      toggleTimerPause: function () {
        if (this.timerIsPaused) {
          this.$refs.countdown[0].start();
          this.timerIsPaused = false;
        } else {
          this.$refs.countdown[0].abort();
          this.timerIsPaused = true;
        }
      },

      openExerciseModal: function (id) {
        if (this.checked.includes(id)) {
          return;
        }

        this.currentExcercise = id;
        this.exerciseModalVisible = true;
      },

      closeExerciseModal: function () {
        this.currentExcercise = 0;
        this.timerIsRunning = false;
        this.timerIsPaused = false;
        this.exerciseModalVisible = false;

        if (this.fullyCompletedTodayExercises() && this.$props.completion_url.length > 0) {
          window.location = window.location.origin + this.$props.completion_url;
        }
      },

      fullyCompletedTodayExercises: function () {
        return (this.checked.length < Object.keys(this.$props.options).length) ? false: true;
      },

      beep: function () {
        let snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");
        snd.play();
      },

      saveTodayProgressToLocalStorage: function () {
        let key = "progress" + this.$props.current_nid;
        let value = JSON.stringify(Array.from(this.checked.values()));

        localStorage.setItem(key, value);
      },

      loadTodayProgressFromLocalStorage: function () {
        let key = "progress" + this.$props.current_nid;
        let cache = localStorage.getItem(key);
        if (cache === null) {
          cache = [];
        }
        else {
          cache = JSON.parse(cache);
        }

        return cache;
      }
    },
    watch: {
      checked: function (values) {

      }
    },
    mounted: function () {

    }
  }
</script>
