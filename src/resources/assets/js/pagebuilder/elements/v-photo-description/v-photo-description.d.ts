import Vue from "vue";
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import { Translation } from "../../models/Translation";
export default class VPhotoDescription extends Vue {
    oldTranslations: Array<Translation>;
    getLanguages: any;
    translations: Array<Translation>;
    dropzoneOptions: object;
    quillOptions: object;
    beforeMount(): void;
}
