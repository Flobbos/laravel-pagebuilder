import Vue from 'vue';
import {Component} from "vue-property-decorator";
import RowComponent from "../../components/RowComponent/RowComponent";
import {Getter} from "vuex-class";
import {Article} from "../../models/Article";
import {Row} from "../../models/Row";
import RowSpacerComponent from "../../components/RowSpacerComponent/RowSpacerComponent";

@Component({
    components:{
        RowComponent,
        RowSpacerComponent
    }
})
export default class ContentView extends Vue{

    @Getter('getArticle') getArticle: Article;

    get article(): Article{
        return this.getArticle;
    }

    mounted(){
    }

    createRow(){
        this.article.rows.push(new Row());
    }
}
