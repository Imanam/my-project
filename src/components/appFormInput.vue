<template>
  <v-container text-center>
    <v-layout>
      <v-flex xs8 offset-xs1>
        <v-snackbar
          v-model="alert_show"
          :color="alert_type"
          :timeout="2000"
          top="top"
        >
          {{ alert_msg }}
        </v-snackbar>
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
          <v-combobox
            v-model="select"
            :items="comboboxItems"
            :error-messages="applicationCategoryErrors"
            :counter="15"
            label="Category"
            @input="$v.applicationCategory.$touch()"
            @blur="$v.applicationCategory.$touch()"
          ></v-combobox>
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
      applicationDescription: '',
      alert_msg: 'Placeholder for alert',
      alert_dismissible: true,
      alert_show: false,
      alert_type: 'error',
      select: '',
      comboboxItems: [],
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
    mounted () {
      this.get_category();
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

      get_category : function () {
          axios
            .get('api/application.php')
            .then(response => {
                const values = Object.values(response.data)
                const items = [];
                values.forEach((value) => {
                    items.push(value.name)
                });
                this.comboboxItems = items;
            })
      },

      check_response (response) {
        if (response.status === 200) {
          // analyze message returned by php code
          this.alert_msg = response.data['msg'];
          this.alert_type = response.data['code'];
          this.alert_show = true;
          this.$root.$emit('reload_user_data');
        }
        console.log(this.alert_msg);
      }
    }
  }
</script>