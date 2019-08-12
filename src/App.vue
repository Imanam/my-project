<template>
  <v-app>
    <v-tabs
      color="teal darken-3"
      dark
      slider-color="grey"
    >
      <v-tab ripple>
        User creation
      </v-tab>
      <v-tab ripple>
        Application creation
      </v-tab>
      <v-tab ripple>
        User <-> Application Association
      </v-tab>
      <v-tab-item>
        <v-content>
          <userFormInput/>
        </v-content>
        <v-content>
          <displayUserData/>
        </v-content>
      </v-tab-item>
      <v-tab-item>
        <v-content>
          <appFormInput/>
        </v-content>
        <v-content>
          <displayAppData/>
        </v-content>
      </v-tab-item>
      <v-tab-item>
        <v-content>
          <uaFormInput/>
        </v-content>
        <v-content>
          <displayUserAppData/>
        </v-content>
      </v-tab-item>  
    </v-tabs>
  </v-app>
</template>

<script>
import userFormInput from './components/userFormInput'
import displayUserData from './components/displayUserData'
import appFormInput from './components/appFormInput'
import displayAppData from './components/displayAppData'
import uaFormInput from './components/userAppFormInput'
import displayUserAppData from './components/displayUserAppData'
import myheader from './components/Myheader'

export default {
  name: 'App',
  components: {
    myheader,
    userFormInput,
    displayUserData,
    appFormInput,
    displayAppData,
    uaFormInput,
    displayUserAppData,
  },
  data () {
    return {
      //
    }
  }
}
</script>
