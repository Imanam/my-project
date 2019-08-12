<template>
  <v-card>
    <v-card-title>
      User - App created associations
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
      group-by="application"
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
        { text: 'Role', value: 'role'},
        { text: 'Application', value: 'application'},
      ],
    }
  },
  mounted () {
    this.getUserAppLinks();
    this.$root.$on('reload_user_app_data', () => {
      this.getUserAppLinks()
    })
  },
  methods : {
    getUserAppLinks : function () {
          axios
            .get('api/userAppLink.php')
            .then(response => {
                const values = Object.values(response.data)
                const items = [];
                values.forEach((value) => {
                    console.log(value);
                    const item = {
                        name : value.UserName,
                        email : value.Email,
                        role : value.Role,
                        application : value.Application,
                    } ;
                    items.push(item)
                });
                this.items = items;
                console.log(this.items);
            })
    },
  }
}
</script>