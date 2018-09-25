import Vuex from "vuex";
import Vue from 'vue';
import getters from './getters';
import mutations from './mutations';
import actions from "./actions";

Vue.use(Vuex);

export function createStore():any {
    
    return new Vuex.Store({
        state: {
            rows: [],
            element_types: [],
            pagebuilder_element: '',
            storage_path: '',
            languages: [],
            currentLang: 'de',
            post:{
                name: '',
                photo: '',
                translations:{

                }
            }
        },
        getters,
        mutations,
        actions
    })
}
