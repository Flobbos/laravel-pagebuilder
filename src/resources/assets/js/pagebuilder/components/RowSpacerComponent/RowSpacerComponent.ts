import {Component} from "vue-property-decorator";

import Vue from 'vue'
import {Article} from "../../models/Article";
import {Getter} from "vuex-class";
import {Row} from "../../models/Row";
import {RowService} from "../../services/RowService";
//@ts-ignore
import Plus from '../../svgs/Plus.vue';
//@ts-ignore
import Grid6 from '../../svgs/Grid6-6.vue';
//@ts-ignore
import Grid12 from '../../svgs/Grid12.vue';
//@ts-ignore
import Grid84 from '../../svgs/Grid8-4.vue';
//@ts-ignore
import Grid48 from '../../svgs/Grid4-8.vue';


@Component({
    components:{
        Plus,
        Grid6,
        Grid12,
        Grid48,
        Grid84,
    }
})
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