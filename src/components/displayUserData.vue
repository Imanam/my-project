<template>
  <v-card>
    <v-card-title>
      Currently created users
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="items"
      :items-per-page="5"
      class="elevation-1"
      :search="search"
    >
    </v-data-table>
  </v-card>
</template>

<script>
import axios from "axios";

export default {
   data: () => {
    return {
      items :[],
      page: 1,
      pageCount: 0,
      itemsPerPage: 10,
      search: '',
      headers: [
        {
          text: 'Employee',
          align: 'left',
          sortable: true,
          value: 'name',
        },
        { text: 'Email', value: 'email' },
        { text: 'Password', value: 'password' },
      ],
    }
  },
  mounted () {
    this.getUsers();
    this.$root.$on('reload_user_data', () => {
      this.getUsers()
    })
  },
  methods : {
    getUsers : function () {
          axios
            .get('api/user.php')
            .then(response => {
                const values = Object.values(response.data)
                //console.log(values);
                const items = [];
                values.forEach((value) => {
                    //console.log(value);
                    const item = {
                        name : value.UserName,
                        email : value.Email,
                        password : value.Password,
                    } ;
                    //console.log(item);
                    items.push(item)
                });
                this.items = items;
                //console.log(this.items);
            })
    },
  }
}
</script>