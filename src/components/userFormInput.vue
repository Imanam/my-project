<template>
  <v-container text-center>
      <div>
        <v-alert type=this.alert_type>
          this.alert_msg
        </v-alert>
      </div>
    <v-layout>
      <v-flex xs8 offset-xs1>
      <form @submit.prevent="onSubmit">
        <v-text-field
          v-model="userName"
          :error-messages="userNameErrors"
          :counter="10"
          label="User name"
          required
          @input="$v.userName.$touch()"
          @blur="$v.userName.$touch()"
        ></v-text-field>
        <v-text-field
          v-model="email"
          :error-messages="emailErrors"
          label="E-mail"
          required
          @input="$v.email.$touch()"
          @blur="$v.email.$touch()"
        ></v-text-field>
        <v-text-field
          v-model="password"
          :append-icon="show ? 'visibility' : 'visibility_off'"
          :error-messages="passwordErrors"
          hint="At least 6 characters"
          counter
          label="Initial Password"
          required
          @click:append="show = !show"
          @input="$v.password.$touch()"
          @blur="$v.password.$touch()"
          :type="show ? 'text' : 'password'"
        ></v-text-field>
        <v-btn @click="submit">submit</v-btn>
        <v-btn @click="clear">clear</v-btn>
      </form>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  import { validationMixin } from 'vuelidate'
  import { required, maxLength, email, minLength } from 'vuelidate/lib/validators'
  import axios from "axios";

  export default {
    mixins: [validationMixin],

    validations: {
      userName: { required, maxLength: maxLength(10) },
      email: { required, email },
      password: { required, maxLength: maxLength(10), minLength: minLength(6)}
    },

    data: () => ({
      userName: '',
      email: '',
      password: '',
      show: false,
      alert_msg: '',
      alert_type: '',
    }),

    computed: {
      userNameErrors () {
        const errors = []
        if (!this.$v.userName.$dirty) return errors
        !this.$v.userName.maxLength && errors.push('User name must be at most 10 characters long')
        !this.$v.userName.required && errors.push('User name is required.')
        return errors
      },
      emailErrors () {
        const errors = []
        if (!this.$v.email.$dirty) return errors
        !this.$v.email.email && errors.push('Must be valid e-mail')
        !this.$v.email.required && errors.push('E-mail is required')
        return errors
      },
      passwordErrors () {
        const errors = []
        if (!this.$v.password.$dirty) return errors
        !this.$v.password.maxLength && errors.push('Password must be at most 10 characters long')
        !this.$v.password.minLength && errors.push('Password must be at less 6 characters long')
        !this.$v.password.required && errors.push('Password is required.')
        return errors
      }
    },

    methods: {
      submit () {
        this.$v.$touch()
        if(!this.$v.$invalid) {
          axios.post('api/postUser.php', {
            userName: this.userName,
            email: this.email,
            password: this.password,
          })
          .then((response) => {
            this.check_response(response)})
          .catch(function (error) {
            console.log(error);
          });
        }
        this.clear()
      },

      clear () {
        this.$v.$reset()
        this.userName = ''
        this.email = ''
        this.password = ''
        this.userType = 'Reader'
        // this.application = 'Cooking Recipe Live Blog'
      },

      check_response (response) {
        if (response.status === 200) {
          // analyze message returned by php code
          const msg_values = Object.values(response.data);
          this.alert_msg = msg_values[0]['msg'];
          this.alert_type = msg_values[0]['code'];
          this.$root.$emit('reload_user_data');
        }
        console.log(this.alert_msg);
      }
    }
  }
</script>