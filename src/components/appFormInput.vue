<template>
  <v-container text-center>
    <v-layout>
      <v-flex xs8 offset-xs1>
      <form @submit.prevent="onSubmit">
        <v-text-field
          v-model="applicationName"
          :error-messages="applicationNameErrors"
          :counter="50"
          label="Application name"
          required
          @input="$v.applicationName.$touch()"
          @blur="$v.applicationName.$touch()"
        ></v-text-field>
        <v-text-field
          v-model="applicationDescription"
          label="Description"
          @input="$v.applicationDescription.$touch()"
          @blur="$v.applicationDescription.$touch()"
        ></v-text-field>
        <v-text-field
          v-model="applicationCategory"
          :error-messages="applicationCategoryErrors"
          :counter="10"
          label="Category"
          required
          @input="$v.applicationCategory.$touch()"
          @blur="$v.applicationCategory.$touch()"
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
  import { required, maxLength, minLength } from 'vuelidate/lib/validators'
  import axios from "axios";

  export default {
    mixins: [validationMixin],

    validations: {
      applicationName: { required, maxLength: maxLength(50) },
      applicationCategory: { required, maxLength: maxLength(10) }
    },

    data: () => ({
      applicationName: '',
      applicationCategory: '',
      applicationDescription: ''
    }),

    computed: {
      applicationNameErrors () {
        const errors = []
        if (!this.$v.applicationName.$dirty) return errors
        !this.$v.applicationName.maxLength && errors.push('Application name must be at most 50 characters long')
        !this.$v.applicationName.required && errors.push('Application name is required.')
        return errors
      },
      applicationCategoryErrors () {
        const errors = []
        if (!this.$v.applicationCategory.$dirty) return errors
        !this.$v.applicationCategory.maxLength && errors.push('Application category must be at most 10 characters long')
        !this.$v.applicationCategory.required && errors.push('Application category is required.')
        return errors
      }
    },

    methods: {
      submit () {
        this.$v.$touch()
        if(!this.$v.$invalid) {
          axios.post('api/postApplication.php', {
            applicationName: this.applicationName,
            applicationDescription: this.applicationDescription,
            applicationCategory: this.applicationCategory
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
        this.applicationName = ''
        this.applicationCategory = ''
        this.applicationDescription = ''
      },

      check_response (response) {
        if (response.status === 200) {
          this.$root.$emit('reload_app_data');
        }
      }
    }
  }
</script>