<template>
    <div class="w-100 p-3">
        <div class="d-flex justify-content-between">
          <h6 class="badge bg-primary py-1 px-3 me-3">{{ category }}</h6>
          <p class="mb-0"><a :href="url" target="_blank">{{ date }}</a></p>
        </div>
        <h3 class="mb-0">{{ title }}</h3>
        <p>{{ body }}</p>
        <button class="btn btn-success" @click="pin()" v-if="is_pinned == 0">Pin</button>
        <button class="btn btn-danger" @click="unpin()" v-else>Unpin</button>
        <hr/>
    </div>
</template>
<script>
import axios from 'axios'

export default {
    name: "news-item",
    props: {
        id: {
          type: Number,
          required: false,
        },
        title: {
            type: String,
            required: true,
        },
        body: {
            type: String,
            required: false,
        },
        is_pinned: {
            type: Boolean,
            required: true,
        },
        date: {
            type: String,
            required: true,
        },
        url: {
            type: String,
            required: true,
        },
        category: {
          type: String,
          required: true,
        },
    },
    data() {
        return {};
    },
    mounted() {
      console.log(this.is_pinned)
    },
    methods: {
      async pin() {
        await axios.post('/api/pin', {
          title: this.title,
          body: this.body,
          date: this.date,
          url: this.url,
          category: this.category,
        })
        .then(() => {
          this.$emit('clicked')
        })
      },
      async unpin() {
        await axios.post('/api/pin/' + this.id, { _method: 'DELETE' })
        .then(() => {
          this.$emit('clicked')
        })
      },
    },
};
</script>
