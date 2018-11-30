import Vue from "vue";

//@ts-ignore
import {Component, Prop, Watch, Emit} from "vue-property-decorator";
import {Getter, Mutation} from "vuex-class";
import axios from "axios";
import {Column} from "../../models/Column";
import {forEach} from 'lodash';
//@ts-ignore
import Plus from '../../svgs/PlusIcon.vue'
//@ts-ignore
import ImageElementIcon from '../../svgs/ElementIcons/ImageElementIcon.vue'
//@ts-ignore
import TextElementIcon from '../../svgs/ElementIcons/TextElementIcon.vue'
//@ts-ignore
import HeadlineTextElementIcon from '../../svgs/ElementIcons/HeadlineTextElementIcon.vue'

//@ts-ignore
import pbConfig from '../../config/config.json';
import {ArticleService} from "../../services/ArticleService";
/*//@ts-ignore
require( "raphael" );
//@ts-ignore
require('wheelnav/js/dist/wheelnav.min.js');*/


@Component({
    components: {
        Plus,
        ImageElementIcon,
        TextElementIcon,
        HeadlineTextElementIcon
    }
})
export default class ColumnComponent extends Vue {

    @Prop()
    column: Column;
    @Getter('getElementTypeById') getElementTypeById: any;
    @Getter('getLanguages') getLanguages: any;
    @Getter('getElementTypes') getElementTypes: any;

    component: string = '';
    columnSize: string = '';
    toolTipActive: boolean = false;


    beforeMount() {
    }

    mounted() {

        this.addElement();
        this.createColumnLayout();

       /* //@ts-ignore
        let wheel: any = new wheelnav('myWheelnav');
        wheel.spreaderInTitle = 'menu';
        wheel.spreaderOutTitle = 'close';
        wheel.spreaderTitleFont = '100 24px Helvetica';
        wheel.colors = ['#EDC951'];
        wheel.spreaderEnable = true;
        wheel.spreaderRadius = 85;
        //@ts-ignore
        wheel.slicePathFunction = slicePath().DonutSlice;
        wheel.clickModeRotate = false;
        wheel.createWheel(['text', 'icon', 'percent', 'angle']);*/
    }

    addElement(id: number = this.column.element_type_id) {
        this.column.element_type_id = id;

        if (this.column.element_type_id !== 0) {
            let element = this.getElementTypeById(this.column.element_type_id);

            this.component = element.component;
            Vue.component(
                this.component,
                //@ts-ignore
                require("../../elements/" + this.component + '/' + this.component)
            );

            this.toolTipActive = false;
        }
    }

    updateElementTypeId(id: number) {
        this.column.element_type_id = id;
        this.addElement();
    }

    createColumnLayout() {
        let classes = pbConfig[pbConfig.framework.current];

        if (this.column.column_size) {
            forEach(classes, (c: any) => {
                this.column.column_size = this.column.column_size.replace(c.pb, c.fw);
            });
        } else {
            this.column.column_size = 'pb-large-12';
            this.createColumnLayout();
        }
    }

    @Emit('onImageUpload')
    onImageUpload() {
    }
};
