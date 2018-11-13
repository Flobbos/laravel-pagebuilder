import Vue from "vue";


import {Component, Prop, Watch} from "vue-property-decorator";
import {Getter} from "vuex-class";
import ColumnComponent from '../ColumnComponent/ColumnComponent';
import {Row} from "../../models/Row";
import {Article} from "../../models/Article";
import RowSpacerComponent from "../RowSpacerComponent/RowSpacerComponent";

@Component({
    components: {
        ColumnComponent,
        RowSpacerComponent
    }
})
export default class RowComponent extends Vue {

    @Prop()
    oldRow: Row;
    @Prop()
    sorting: number;

    @Getter('getArticle') getArticle: Article;
    @Getter('getLanguages') getLanguages: any;

    row: Row = new Row();
    columnLimit: number = 1;

    beforeMount(){
        this.row = this.oldRow;
    }

    @Watch('sorting', {immediate: true, deep: false})
    onSortingChanged(){
        this.row.sorting = this.sorting;
    }
};