import Vue from 'vue'
import vSelect from 'vue-select'

import './assets/scss/home.scss'

Vue.component('v-select', vSelect);

/* eslint-disable no-new */
new Vue({
  el: '#app',
  data() {
    return {
      loading: false,
      selected: null,
      options: [
        {
          title: 'Read the Docs',
          icon: 'octicon-book',
          url: 'docs/'
        },
        {
          title: 'View on GitHub',
          icon: 'octicon-mark-github',
          url: 'https://github.com/sagalbot/vue-select'
        },
        {
          title: 'View on NPM',
          icon: 'octicon-database',
          url: 'https://www.npmjs.com/package/vue-select'
        },
        {
          title: 'View Code Climate Analysis',
          icon: 'octicon-graph',
          url: 'https://codeclimate.com/github/sagalbot/vue-select'
        },
        {
          title: 'View Codepen Examples',
          icon: 'octicon-pencil',
          url: 'https://codepen.io/collection/nrkgxV/'
        },
      ]
    }
  },
  methods: {
    redirect(option) {
      window.location = option.url;
    }
  }
});
