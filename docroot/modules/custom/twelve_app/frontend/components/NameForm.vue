<template>
  <div class="introduce-form">

    <div class="user-name-container">
      <span class="username">Hello, <template v-if="userIntroduced">{{ username }}!</template><template v-else>...</template></span>
      <a class="change-button" v-on:click="showModal">Edit Name</a>
    </div>

    <div class="modal fade show d-block user-login-container" v-if="!userIntroduced">
      <div class="modal-backdrop fade in"></div>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">CHALLENGER NAME</h4>
            <!--button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button-->
          </div>
          <div class="modal-body">
            <p>What name do you go by, challenger?</p>
            <div class="label">Name</div>
            <input type="text" name="username" v-model="username" class="username" v-on:keyup.enter="setLogin">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" v-on:click="setLogin">Enter</button>
            <button type="button" class="btn btn-white" v-on:click="setDefaultName">No thanks</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  export default {
    data() {
      let name = this.loadNameFromCache();
      return {
        userIntroduced: this.isName(name),
        username: name,
      };
    },
    created() {
      this
    },
    methods: {
      loadNameFromCache: function() {
        let name = localStorage.twelveUserName;
        if(!this.isName(name)) {
          this.$emit('show-modal');
        }
        return name;
      },

      isName: function(name) {
        return typeof name === "string" && name.length > 0;
      },

      showModal: function () {
        this.userIntroduced = false;
        this.$emit('show-modal');
      },

      setDefaultName: function() {
        this.username = 'Challenger';
        this.setLogin();
      },

      setLogin: function () {
        if (!this.username) {
          e.preventDefault();
          return;
        }
        localStorage.twelveUserName = this.username;
        this.userIntroduced = true;
        this.$emit('hide-modal');

        this.$notify({
          group: 'twelve_app',
          title: 'You have introduced yourself',
          text: 'Lets start training!'
        });
      }
    }
  };
</script>
