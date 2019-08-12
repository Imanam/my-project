<template>
  <div>
    <b-card no-body>
      <b-tabs card>

        <b-tab v-for="(item, index) in items" :title="item.title" v-bind:key="index" >
         {{ item.title }}
          <b-card-text></b-card-text>
        </b-tab>

        
      </b-tabs>
    </b-card>
  </div>
</template>

<script>
export default {
  name: "TabMenu",
  data() {
    return {
      items: [
        { title: "top" },
        { title: "profile" },
        { title: "skills" },
        { title: "outputs" }
      ]
    };
  }
};
</script>

<style scoped>
</style>