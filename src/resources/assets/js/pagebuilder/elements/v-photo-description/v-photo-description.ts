import Vue from "vue";

//@ts-ignore

import {Component, Prop, Watch} from "vue-property-decorator";
import {Getter, Mutation} from "vuex-class";

//@ts-ignore
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import {Translation} from "../../models/Translation";
//@ts-ignore
import VueQuillEditor from 'vue-quill-editor';
Vue.use(VueQuillEditor);

@Component({
    components: {
        vueDropzone: vue2Dropzone
    }
})
export default class VPhotoDescription extends Vue {

    @Prop()
    oldTranslations: Array<Translation>;

    @Getter('getLanguages') getLanguages:any;

    translations: Array<Translation> = [];
    dropzoneOptions: object = {
        url: '/pagebuilder/upload-photo',
        thumbnailWidth: null,
        thumbnailHeight: null,
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

    quillOptions: object = {
        theme: 'bubble',
        placeholder: 'Text (' + this.$store.getters.getCurrentLang + ')',
        modules: {
            toolbar: [
                ["bold", "italic", "underline"],
                [{list: "ordered"}, {list: "bullet"}],
                ["link", "clean"]
            ]
        }
    };

    beforeMount(){
        this.translations = this.oldTranslations;
    }

};
