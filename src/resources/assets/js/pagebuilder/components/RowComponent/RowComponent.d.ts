import Vue from "vue";
import { Row } from "../../models/Row";
import { Article } from "../../models/Article";
export default class RowComponent extends Vue {
    oldRow: Row;
    sorting: number;
    getArticle: Article;
    getLanguages: any;
    row: Row;
    columnLimit: number;
    beforeMount(): void;
    onSortingChanged(): void;
}
