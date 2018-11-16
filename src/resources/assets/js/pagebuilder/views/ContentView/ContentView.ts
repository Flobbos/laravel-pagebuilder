import Vue from 'vue';
import {Component, Watch} from "vue-property-decorator";
import RowComponent from "../../components/RowComponent/RowComponent";
import {Getter} from "vuex-class";
import {Article} from "../../models/Article";
import {Row} from "../../models/Row";
import RowSpacerComponent from "../../components/RowSpacerComponent/RowSpacerComponent";

//@ts-ignore
import Draggable from 'vuedraggable';
import {indexOf} from 'lodash';

@Component({
    components:{
        RowComponent,
        RowSpacerComponent,
        Draggable
    }
})
export default class ContentView extends Vue{

    @Getter('getArticle') getArticle: Article;

    get article(): Article{
        return this.getArticle;
    }
}