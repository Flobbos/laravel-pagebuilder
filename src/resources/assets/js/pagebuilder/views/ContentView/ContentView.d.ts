import Vue from 'vue';
import { Article } from "../../models/Article";
export default class ContentView extends Vue {
    getArticle: Article;
    readonly article: Article;
    mounted(): void;
    createRow(): void;
}
