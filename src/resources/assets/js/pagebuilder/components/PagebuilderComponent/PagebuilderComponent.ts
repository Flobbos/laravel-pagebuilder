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
    theme: string = 'dark-theme';

    mounted() {

        this.setTheme();
        this.setLanguages(this.languages);
        this.setCurrentLang(this.getLanguages[0]);
        this.setElementTypes(this.elementTypes);

        if (this.oldElement) {
            this.article = ArticleService.createFromExisting(this.oldElement);
            this.$store.commit('setArticle', this.article);
        } else {
            this.article = ArticleService.createNew();
        }
    }

    setTheme(){
        let body = document.querySelector('body') as HTMLElement;
        body.classList.add('dark-theme');
    }

    changeTheme(){
        if(this.theme === 'dark-theme'){
            let body = document.querySelector('body') as HTMLElement;
            body.classList.remove('dark-theme');
            body.classList.add('light-theme');
            this.theme = 'light-theme';
        }else{
            let body = document.querySelector('body') as HTMLElement;
            body.classList.remove('light-theme');
            body.classList.add('dark-theme');
            this.theme = 'dark-theme';
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

    get currentLanguage(){
        return this.getCurrentLanguage;
    }

    @Watch('article', {immediate: true, deep: true})
    onArticleChanged(val: Article, oldVal: Article) {
        this.setArticle(this.article);
    }

};
