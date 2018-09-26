import Vue from "vue";

//@ts-ignore

import {Component, Prop, Watch} from "vue-property-decorator";
import {Getter, Mutation} from "vuex-class";

//@ts-ignore
import VueQuillEditor from 'vue-quill-editor';
Vue.use(VueQuillEditor);


@Component
export default class VText extends Vue {

    @Prop()
    lang: any;

    @Prop()
    translations: Array<any>;

    @Prop()
    columnId: string;

    @Prop()
    rowId: string;

    uniqueId: string = '';

    form_text: string = '';
    form_translations: Array<any> = [];
    id: number = 0;

    options: object = {
        modules: {
            toolbar: [
                ["bold", "italic", "underline"],
                [{list: "ordered"}, {list: "bullet"}],
                ["link", "clean"]
            ]
        }
    };

    @Mutation('handleTranslation') handleTranslation: any;
    //@ts-ignore
    @Getter('getElement') getElement;

    created() {
        if (this.translations) {
            this.translations.forEach((t: any) => {
                if (t.language_id === this.langId) {
                    this.uniqueId = t.uniqueId;

                    this.form_text = this.element.content.text;
                    this.id = this.element.id;
                }
            })
        }
    }

    get element() {
        return this.getElement(this.uniqueId, this.columnId, this.rowId)
    }

    @Watch('form_text')
    updateText() {
        this.updateElement();
    }

    get langId() {
        return this.lang.id;
    }

    //@ts-ignore
    onEditorChange({ quill, html, text }) {

        this.form_text = html
    }

    updateElement() {
        let translation: object = {
            column_id: this.columnId,
            row_id: this.rowId,
            language_id: this.langId,
            id: this.id,
            content: {
                text: this.form_text
            }
        };
        this.handleTranslation(translation);
    }

};
