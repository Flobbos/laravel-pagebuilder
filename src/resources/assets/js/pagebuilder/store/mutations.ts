import {findIndex, find, reject} from 'lodash';

import Vue from 'vue';
import {Article} from "../models/Article";

export default {
    setElementTypes: function (state: any, elementTypes: any) {
        state.element_types = elementTypes;
    },
    setLanguages(state: any, languages: any) {
        this.state.languages = languages;
    },
    setCurrentLang(state: any, lang: any) {
        state.currentLang = lang;
    },
    setArticle(state:any, article:Article){
        console.log('yoyo')
        state.article = article;
    }
}
