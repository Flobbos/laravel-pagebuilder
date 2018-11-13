import Vue from "vue";
import { Translation } from "../../models/Translation";
export default class VText extends Vue {
    oldTranslations: Array<Translation>;
    getLanguages: any;
    translations: Array<Translation>;
    options: object;
    beforeMount(): void;
}
