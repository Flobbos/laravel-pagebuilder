import Vuex, {Store} from "vuex";
import Vue from 'vue';
import getters from './getters';
import mutations from './mutations';
import actions from "./actions";
import {Article} from "../models/Article";

Vue.use(Vuex);

export default new Vuex.Store({
        state: {
            article: Article,
            element_types: [],
            languages: [],
            currentLang: 'de',
        },
        getters,
        mutations,
        actions
});
