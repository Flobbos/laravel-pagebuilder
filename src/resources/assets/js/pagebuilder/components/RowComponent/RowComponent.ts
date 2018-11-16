import Vue from "vue";


import {Component, Prop, Watch, Emit} from "vue-property-decorator";
import {Getter} from "vuex-class";
import ColumnComponent from '../ColumnComponent/ColumnComponent';
import {Row} from "../../models/Row";
import {Article} from "../../models/Article";
import RowSpacerComponent from "../RowSpacerComponent/RowSpacerComponent";
import {indexOf} from 'lodash';

@Component({
    components: {
        ColumnComponent,
        RowSpacerComponent
    }
})
export default class RowComponent extends Vue {

    @Prop()
    row: Row;

    @Getter('getArticle') getArticle: Article;
    @Getter('getLanguages') getLanguages: any;

    columnLimit: number = 1;

    beforeMount(){
        this.row.sorting = this.sorting
    }

    get sorting(){
        let rows = this.getArticle.rows;
        let index = indexOf(rows,this.row );

        return index;
    }

    @Emit('onImageUpload')
    onImageUpload(){
    }
};