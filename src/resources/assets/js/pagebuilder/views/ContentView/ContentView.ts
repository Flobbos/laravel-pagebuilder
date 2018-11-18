import Vue from 'vue';
import {Component, Watch, Emit} from "vue-property-decorator";
import RowComponent from "../../components/RowComponent/RowComponent";
import {Getter, Mutation} from "vuex-class";
import {Article} from "../../models/Article";
import {Row} from "../../models/Row";
import RowSpacerComponent from "../../components/RowSpacerComponent/RowSpacerComponent";

//@ts-ignore
import Draggable from 'vuedraggable';
import {indexOf} from 'lodash';

//@ts-ignore
import { Vue2Dragula } from 'vue2-dragula'

Vue.use(Vue2Dragula, {
    logging: {
        service: true // to only log methods in service (DragulaService)
    }
});
import 'dragula/dist/dragula.css'
@Component({
    components:{
        RowComponent,
        RowSpacerComponent,
        Draggable
    }
})
export default class ContentView extends Vue{

    @Getter('getArticle') getArticle: Article;
    @Mutation('setArticle') setArticle: any;

    get article(): Article{
        return this.getArticle;
    }

    @Emit('onImageUpload')
    onImageUpload(){
        this.setArticle(this.article);
    }
}