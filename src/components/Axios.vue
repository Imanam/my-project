<template>
  <div>
    <div class="container">
        <div class="card-columns">

          <div class="card p-3" v-for="(object, id) in tsvMap" v-bind:key="id">

            <blockquote class="card-blockquote">
              <p>
                {{ object.TDSTag }}{{ object.SetupType }}
              </p>
              <footer>
                <small>
                    <a target="_blank" :href="object.Group">Read more on {{ object.Group }}</a>

                </small>
              </footer>
            </blockquote>

          </div>

        </div>

        <div class="text-center"
          v-show="postsLoading">
          Loading...
        </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";

export default {
  created() {
    this.getPosts();

    window.addEventListener("scroll", this.handleScroll);
  },

  data() {
    return {
      // object: {},
      tsvMap:{},
      postsLoading: false,
      nextPage: null
    };
  },

  methods: {
    getPosts() {
      this.postsLoading = true;

      // var url = 'https://www.reddit.com/r/all/top.json?limit=30&count=30'
      var url =
          `${process.env.BASE_URL}TDSP0APPMap.tsv`;
        // "http://localhost:8888/internship/data/samples/TDSP0APPMap (3).tsv";

      // if (page != null) {
      //   url =
      //     "https://www.reddit.com/r/all/top.json?limit=30&count=30&after=" +
      //     page;
      // }

      axios
        .get(url)
        .then(response => {
          let tsv = response;
          let object = {};
          let lines = tsv.data.split("\n");
          let headers = lines[0].replace(/\r$/, "").split("\t");
          let indexOfDictionary;
          for (var i = 1; i < lines.length; i++) {
            // var obj = {};
            var currentline = lines[i].replace(/\r$/, "").split("\t");
          
            for (var j = 0; j < headers.length; j++) {
              // console.log(headers[j]);
              // console.log(currentline[j]);
              object[headers[j]] = currentline[j];
              // eslint-disable-next-line

              if(headers[j] == "TDSTag") {
                indexOfDictionary = currentline[j];                  
              }

            }
            this.tsvMap[indexOfDictionary] = object;
            // eslint-disable-next-line
            console.log(this.tsvMap);
            // this.result.push(this.object);
            object = {};
          }
          return this.tsvMap; 
        })

        .catch(error => {
          // eslint-disable-next-line
          console.log(error);
        });
    },

    handleScroll() {
      if (
        document.body.scrollHeight -
          window.innerHeight -
          document.body.scrollTop <=
        5
      ) {
        if (this.nextPage != null) {
          this.getPosts(this.nextPage);
        }
      }
    }
  }
};
</script>