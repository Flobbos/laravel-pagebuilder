import Vue from 'vue';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';
import { Article } from "../../models/Article";
export default class SettingsView extends Vue {
    getArticle: Article;
    dropzoneOptions: object;
    config: object;
    readonly article: Article;
    mounted(): void;
    onSuccess(file: any, response: any): void;
    onFileRemove(file: any, error: any, xhr: any): void;
}
