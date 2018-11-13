import {Component} from "vue-property-decorator";

import Vue from 'vue'
import {Article} from "../../models/Article";
import {Getter} from "vuex-class";
import {Row} from "../../models/Row";
import {RowService} from "../../services/RowService";


@Component
export default class RowSpacerComponent extends Vue {

    @Getter('getArticle') getArticle: Article;

    active: boolean = false;

    createRow(columnLayout: string[]){
        let row = RowService.createNew(columnLayout);
        this.article.rows.push(row);
        this.active = false;
    }

    get article():Article{
        return this.getArticle;
    }

}