<template>
  <div class="w-100 d-flex justify-content-center pt-5">
    <div class="w-50">
      <div class="w-100 pb-3 mb-3 border-bottom">
        <input
          type="text"
          placeholder="search"
          v-model="search"
          class="form-control"
          @keyup="fetchNews()"
        />
      </div>
      <div class="w-100 articles mb-3 p-2 border">
        <div class="list-group">
          <news-item
            v-for="(article, key) in articles"
            :title="article.title"
            :body="article.body"
            :is_pinned="article.is_pinned"
            :url="article.url"
            :date="article.date"
            :category="article.category"
            :key="'articles_' + key"
            @clicked="fetchPins()"
          />
        </div>
      </div>
      <div class="w-100 pins p-2 border">
        <news-item
          v-for="(pin, key) in pins"
          :id="pin.id"
          :title="pin.title"
          :body="pin.body"
          :is_pinned="pin.is_pinned"
          :url="pin.url"
          :date="pin.date"
          :category="pin.category"
          :key="'pinned_' + key"
          @clicked="fetchPins()"
        />
      </div>
    </div>
  </div>
</template>

<script>
import NewsItem from "@/components/NewsItem.vue";
import axios from 'axios'
export default {
  name: "news-dashboard",
  components: { NewsItem },
  props: {},
  data() {
    return {
      search: "",
      articles: [],
      pins: []
    };
  },
  mounted() {
    this.fetchNews()
    this.fetchPins()
  },
  methods: {
    async fetchNews() {
      await axios.get('/api/news?search=' + this.search)
      .then((response) => {
        this.articles = response.data
      })
    },
    async fetchPins() {
      await axios.get('/api/pin')
      .then((response) => {
        this.pins = response.data
      })
    },
  },
};
</script>

<style scoped>
.articles {
  height: 50vh;
  overflow-y: scroll;
}
.pins {
  height: 30vh;
  overflow-y: scroll;
}
</style>