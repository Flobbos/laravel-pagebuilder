import Vue from "vue";

//@ts-ignore

import {Component, Prop, Watch} from "vue-property-decorator";
import {Getter, Mutation} from "vuex-class";


@Component
export default class VHeadlineText extends Vue {

    @Prop()
    lang: any;

    @Prop()
    translations: Array<any>;

    @Prop()
    columnId: string;

    @Prop()
    rowId: string;

    uniqueId: string = '';

    form_headline: string = '';
    form_text: string = '';
    form_translations: Array<any> = [];
    id: number = 0;

    @Mutation('handleTranslation') handleTranslation: any;
    //@ts-ignore
    @Getter('getElement') getElement;

    created() {
        if (this.translations) {
            this.translations.forEach((t: any) => {
                if (t.language_id === this.langId) {
                    this.uniqueId = t.uniqueId;

                    this.form_text = this.element.content.text;
                    this.form_headline = this.element.content.headline;
                    this.id = this.element.id;
                }
            })
        }
    }

    get element() {
        return this.getElement(this.uniqueId, this.columnId, this.rowId)
    }

    @Watch('form_headline')
    updateHeadline() {
        this.updateElement();
    }

    @Watch('form_text')
    updateText() {
        this.updateElement();
    }

    get langId() {
        return this.lang.id;
    }

    updateElement() {
        let translation: object = {
            column_id: this.columnId,
            row_id: this.rowId,
            language_id: this.langId,
            id: this.id,
            content: {
                headline: this.form_headline,
                text: this.form_text
            }
        };
        this.handleTranslation(translation);
    }

};
