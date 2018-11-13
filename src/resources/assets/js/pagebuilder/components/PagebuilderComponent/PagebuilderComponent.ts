import Vue from "vue";

//@ts-ignore
import {Component, Prop, Watch} from "vue-property-decorator";

import {forEach, indexOf} from 'lodash';

import {Getter, Mutation} from 'vuex-class';

import {forOwn} from 'lodash';



import {mapKeys} from 'lodash';

//@ts-ignore
import ImageElementIcon from '../../svgs/ElementIcons/ImageElementIcon.vue'
//@ts-ignore
import TextElementIcon from '../../svgs/ElementIcons/TextElementIcon.vue'
//@ts-ignore
import HeadlineTextElementIcon from '../../svgs/ElementIcons/HeadlineTextElementIcon.vue'
//@ts-ignore
import Arrow from '../../svgs/ArrowIcon.vue'

//@ts-ignore
import Sticky from 'vue-sticky-directive';

Vue.use(Sticky);

import moment from 'moment';

// Import date picker css
import {Article} from "../../models/Article";
import {Row} from "../../models/Row";
import {ArticleService} from "../../services/ArticleService";

import ContentView from '../../views/ContentView/ContentView';
import SettingsView from "../../views/SettingsView/SettingsView";

@Component({
    components: {
        ContentView,
        SettingsView,
        Arrow,
        ImageElementIcon,
        TextElementIcon,
        HeadlineTextElementIcon

    },
})
export default class PagebuilderComponent extends Vue {

    @Prop()
    oldElement: any;
    @Prop()
    elementTypes: Array<any>;
    @Prop()
    languages: Array<any>;
    @Prop()
    storagePath: string;

    @Mutation('setElementTypes') setElementTypes: any;
    @Mutation('setLanguages') setLanguages: any;
    @Mutation('setArticle') setArticle: any;
    @Mutation('setCurrentLang') setCurrentLang: any;

    @Getter('getLanguages') getLanguages: any;
    @Getter('getCurrentLang') getCurrentLanguage: any;
    @Getter('getArticle') getArticle: Article;


    article: Article = new Article();
    currentView: string = 'Content';

    mounted() {
        console.log('pagebuilder component');
        this.setLanguages(this.languages);
        this.setElementTypes(this.elementTypes);

        if (this.oldElement) {
            console.log('alt da');
            this.article = ArticleService.createFromExisting(this.oldElement, this.getLanguages);
            this.$store.commit('setArticle', this.article);
        } else {
            console.log('alt nicht da');
            this.article = ArticleService.createNew(this.getLanguages);
        }
    }

    //@Todo: Rest column size for desktop and tablet

    setDesktop() {
        let contentWrapper = document.querySelector('.content-view') as HTMLElement;
        contentWrapper.style.maxWidth = '1200px';
    }

    setTablet() {
        let contentWrapper = document.querySelector('.content-view') as HTMLElement;
        contentWrapper.style.maxWidth = '768px';

    }

    setMobile() {
        let contentWrapper = document.querySelector('.content-view') as HTMLElement;
        contentWrapper.style.maxWidth = '375px';
        let columns = document.getElementsByClassName('pagebuilder-column');

        forEach(columns, (c: HTMLElement) => {

            forEach(c.classList, (size: string) => {
                if (size.includes('col-')) {
                    c.classList.remove(size);
                    c.classList.add('col-xs-12')
                }
            })
        })
    }

    @Watch('article', {immediate: true, deep: true})
    onArticleChanged(val: Article, oldVal: Article) {
        this.setArticle(this.article);
    }

};
