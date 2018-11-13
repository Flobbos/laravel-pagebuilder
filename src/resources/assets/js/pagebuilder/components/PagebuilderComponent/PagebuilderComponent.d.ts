import Vue from "vue";
import 'dragula/dist/dragula.css';
import { Article } from "../../models/Article";
export default class PagebuilderComponent extends Vue {
    oldElement: any;
    elementTypes: Array<any>;
    languages: Array<any>;
    storagePath: string;
    setElementTypes: any;
    setLanguages: any;
    setArticle: any;
    setCurrentLang: any;
    getLanguages: any;
    getCurrentLanguage: any;
    getArticle: Article;
    article: Article;
    currentView: string;
    mounted(): void;
    setDesktop(): void;
    setTablet(): void;
    setMobile(): void;
    onArticleChanged(val: Article, oldVal: Article): void;
}
