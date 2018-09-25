import Vue from "vue";

//@ts-ignore

import {Component, Prop, Watch} from "vue-property-decorator";
import {Getter, Mutation} from "vuex-class";

//@ts-ignore
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

@Component({
    components: {
        vueDropzone: vue2Dropzone
    }
})
export default class VPhotoDescription extends Vue {

    @Prop()
    lang: any;

    @Prop()
    translations: Array<any>;

    @Prop()
    columnId: string;

    @Prop()
    rowId: string;

    uniqueId: string = '';

    @Mutation('handleTranslation') handleTranslation: any;
    //@ts-ignore
    @Getter('getElement') getElement;
    @Getter('getLanguageById') getLanguageById: any;
    @Getter('getPagebuilderElement') getPagebuilderElement: any;
    @Getter('getStoragePath') getStoragePath: any;

    dropzoneOptions: object = {
        url: '/admin/upload-photo',
        thumbnailWidth: 150,
        maxFilesize: 3,
        maxFiles: 1,
        uploadMultiple: false,
        addRemoveLinks: true,
        dictDefaultMessage: "<i class='glyphicon glyphicon-cloud-upload dropzone-icon'></i>",
        paramName: 'photo',
        headers: {
            //@ts-ignore
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    };

    id: number = 0;
    form_description: string = '';
    form_text: string = '';
    form_photos: Array<string> = [];

    created() {
        if (this.translations) {
            this.translations.forEach((t: any) => {
                if (t.language_id === this.langId) {
                    this.uniqueId = t.uniqueId;

                    this.form_description = this.element.content.description;
                    this.form_text = this.element.content.text;
                    this.form_photos = this.element.content.photos;
                    this.id = this.element.id;
                }
            })
        }
    };

    mounted() {
        if (this.element && this.element.content.photos && this.element.content.photos.length) {

            this.element.content.photos.forEach((p: any) => {
                let file = {name: p};
                let url = '/storage/'+ this.getStoragePath + '/' + file.name;
                //@ts-ignore
                this.$refs.photoDescription.manuallyAddFile(file, url)
            })
        }
    }

    get element() {
        return this.getElement(this.uniqueId, this.columnId, this.rowId)
    }

    get langId() {
        return this.lang.id;
    }

    sendingEvent(file: any, xhr: any, formData: any) {
        formData.append('storage', this.getStoragePath);
        formData.append('column_id', this.columnId);
        formData.append('lang_id', this.lang.id);
    };

    onSuccess(file: any, response: any) {
        this.form_photos.push(response.filename);

        this.updateElement();
    };

    updateElement() {
        let translation: object = {
            column_id: this.columnId,
            row_id: this.rowId,
            language_id: this.langId,
            id: this.id,
            content: {
                description: this.form_description,
                photos: this.form_photos,
                text: this.form_text
            }
        };
        this.handleTranslation(translation);
    };

    @Watch('form_description')
    updateDescription() {
        this.updateElement();
    }

    @Watch('form_text')
    updateText(){
        this.updateElement();
    }
};
