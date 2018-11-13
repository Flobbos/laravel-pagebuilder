import Vue from "vue";
import { Translation } from "../../models/Translation";
export default class VHeadlineText extends Vue {
    oldTranslations: Array<Translation>;
    getLanguages: any;
    translations: Array<Translation>;
    options: object;
    beforeMount(): void;
}
