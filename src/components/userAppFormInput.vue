<template>
  <v-container text-center>
    <v-layout>
      <v-flex xs8 offset-xs1>
      <form @submit.prevent="onSubmit">
        <v-select
          v-model="user"
          :items="allUsers"
          label="User to create access to"
          required
        ></v-select>
        <v-select
          v-model="application"
          :items="allApps"
          label="Application to associate"
          required
        ></v-select>
        <v-select
          v-model="role"
          :items="allRoles"
          label="Role of the user for this app"
          required
        ></v-select>
        <v-btn @click="submit">submit</v-btn>
        <v-btn @click="clear">clear</v-btn>
      </form>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  import axios from "axios";

  export default {
    data: () => ({
      user: '',
      application: '',
      role: '',
      allUsers: [],
      allApps: [],
      allRoles: [],
    }),
    mounted () {
      this.get_users();
      this.get_applications();
      this.get_roles();
      this.$root.$on('reload_app_data', () => {
        this.get_applications()
        })
      this.$root.$on('reload_user_data', () => {
        this.get_users()
      })
    },
    methods: {
      submit () {
        axios.post('api/postUserAppLink.php', {
          userName: this.user,
          appName: this.application,
          role: this.Role
        })
        .then((response) => {
          this.check_response(response)})
        .catch(function (error) {
          console.log(error);
        });
        this.clear()
      },

      get_applications : function () {
          axios
            .get('api/application.php')
            .then(response => {
                const values = Object.values(response.data)
                const items = [];
                values.forEach((value) => {
                    items.push(value.name)
                });
                this.allApps = items;
            })
      },

      get_roles : function () {
          axios
            .get('api/role.php')
            .then(response => {
                const values = Object.values(response.data)
                const items = [];
                values.forEach((value) => {
                    items.push(value.name)
                });
                this.allRoles = items;
            })
      },

      get_users : function () {
          axios
            .get('api/user.php')
            .then(response => {
                const values = Object.values(response.data)
                const items = [];
                values.forEach((value) => {
                  items.push(value.UserName + ' (' + value.Email + ')')
                });
                this.allUsers = items;
            })
      },

      clear () {
        //this.$v.$reset()
      },

      check_response (response) {
        if (response.status === 200) {
          this.$root.$emit('reload_user_app_data');
        }
      }
    }
  }
</script>