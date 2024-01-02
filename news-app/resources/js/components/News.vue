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
          <div v-for="(group, key) in articles" :key="'group_' + key">
            <h1><b>{{key}}</b></h1>
            <div class="ps-3">
              <news-item
                v-for="(article, key2) in group"
                :title="article.title"
                :body="article.body"
                :is_pinned="article.is_pinned"
                :url="article.url"
                :date="article.date"
                :category="article.category"
                :article_id="article.article_id"
                :key="'articles_' + key2"
                @clicked="refreshPins()"
                />
            </div>
          </div>
        </div>
      </div>
      <div class="card border-primary mb-3">
        <div class="card-header">Pinned Articles</div>
        <div class="card-body">
          <div class="pins">
            <news-item
            v-for="(pin, key) in pins"
            :id="pin.id"
            :title="pin.title"
            :body="pin.body"
            :is_pinned="pin.is_pinned"
            :url="pin.url"
            :date="pin.date"
            :category="pin.category"
            :article_id="pin.article_id"
            :key="'pinned_' + key"
            @clicked="refreshPins()"
            />
          </div>
        </div>
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
    async refreshPins() {
      await this.fetchNews()
      await this.fetchPins()
    }
  },
};
</script>

<style scoped>
.articles {
  height: 60vh;
  overflow-y: scroll;
}
.pins {
  height: 20vh;
  overflow-y: scroll;
}
</style>