<template>
  <v-card>
    <v-card-title>
      Currently created applications
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
      group-by="category"
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
          text: 'Application Name',
          align: 'left',
          sortable: true,
          value: 'name',
        },
        { text: 'Description', value: 'description' },
        { text: 'Category', value: 'category' },
      ],
    }
  },
  mounted () {
    this.getApplications();
    this.$root.$on('reload_app_data', () => {
      this.getApplications()
    })
  },
  methods : {
    getApplications : function () {
          axios
            .get('api/application.php')
            .then(response => {
                const values = Object.values(response.data)
                const items = [];
                values.forEach((value) => {
                    console.log(value);
                    const item = {
                        name : value.name,
                        description : value.description,
                        category : value.category,
                    } ;
                    items.push(item)
                });
                this.items = items;
            })
    },
  }
}
</script>