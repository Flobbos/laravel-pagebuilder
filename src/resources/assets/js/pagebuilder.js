//Pagebuilder main file
import axios from 'axios';

import Vue from 'vue';

import { createStore } from "./admin_components/store/index.ts"
const store = createStore();
Vue.component('vue-editor', require('./admin_components/vue-editor/VueEditor'));

Vue.component('vue-date-picker', require('./admin_components/vue-date-picker/VueDatePicker'));

Vue.component('pagebuilder', require('./admin_components/pagebuilder-components/pagebuilder/Pagebuilder'));

Vue.prototype.$generateUid = () => {
    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
};

Vue.prototype.$axios = axios;
