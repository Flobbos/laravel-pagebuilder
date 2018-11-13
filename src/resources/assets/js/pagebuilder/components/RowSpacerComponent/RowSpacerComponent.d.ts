import Vue from 'vue';
import { Article } from "../../models/Article";
export default class RowSpacerComponent extends Vue {
    getArticle: Article;
    active: boolean;
    createRow(columnLayout: string[]): void;
    readonly article: Article;
}
