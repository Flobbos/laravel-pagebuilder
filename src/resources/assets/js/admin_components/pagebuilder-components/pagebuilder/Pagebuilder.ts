import Vue from "vue";

//@ts-ignore
import {Component, Prop} from "vue-property-decorator";

import Row from '../row/Row'

//@ts-ignore
import {Vue2Dragula} from 'vue2-dragula'

import {find} from 'lodash';

import {
    Getter,
    Mutation,
} from 'vuex-class'


Vue.use(Vue2Dragula/*, {
    logging: {
        service: true // to only log methods in service (DragulaService)
    }
}*/);

//@ts-ignore
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import {mapKeys} from 'lodash';

//@ts-ignore
import DatePicker from 'vue-bootstrap-datetimepicker';

//@ts-ignore
import Sticky from 'vue-sticky-directive'
Vue.use(Sticky)

import moment from 'moment';

// Import date picker css
import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';

@Component({
    components: {
        'row': Row,
        vueDropzone: vue2Dropzone,
        DatePicker
    },
})
export default class Pagebuilder extends Vue {


    @Prop()
    oldElement: any;
    @Prop()
    elementTypes: Array<any>;
    @Prop()
    languages: Array<any>;
    @Prop()
    storagePath: string;

    @Mutation('addRow') addRow: any;
    @Mutation('setRows') setRows: any;
    @Mutation('setElementTypes') setElementTypes: any;
    @Mutation('setLanguages') setLanguages: any;
    @Mutation('setPost') setPost: any;
    @Mutation('setPagebuilderElement') setPagebuilderElement: any;
    @Mutation('setStoragePath') setStoragePath: any;

    @Getter('getRows') getRows: any;
    @Getter('getLanguages') getLanguages: any;
    @Getter('getCurrentLang') getCurrentLanguage: any;
    @Getter('getStoragePath') getStoragePath: any;

    translations: any = {};
    name: string = '';
    photo: string = '';
    published_on = '';
    id: number = 0;
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

    config: object = {
        locale: 'de',
        format: 'YYYY-MM-DD HH:mm:ss',
        sideBySide: false
    };


    sendingEvent(file: any, xhr: any, formData: any) {
        formData.append('storage', this.getStoragePath);
    };

    onSuccess(file: any, response: any) {
        this.photo = response.filename;

        this.updatePost();
    };


    get rows() {
        return this.getRows;
    }

    beforeMount(){
        //old element is NOT present
        if(this.oldElement === undefined){
            console.log('kein altes beCreated')
            let langs: any = this.getLanguages;
            langs.forEach((lang: any) => {
                this.translations[lang.id] = {
                    language_id: lang.id,
                    title: '',
                    teaser: ''
                }
            });
            this.updatePost();
        }
    }

    created() {
        this.setElementTypes(this.elementTypes);
        this.setLanguages(this.languages);


        //old element is present
        if (this.oldElement !== undefined) {
            let langs: any = this.getLanguages;
            langs.forEach((lang: any) => {
                this.translations[lang.id] = {
                    language_id: lang.id,
                    title: '',
                    teaser: ''
                }
            });
            this.name = this.oldElement.name;
            this.published_on = this.oldElement.published_on;
            this.id = this.oldElement.id;
            this.photo = this.oldElement.photo;
            let oldTranslations = this.oldElement.translations;
            oldTranslations.forEach((t: any) => {
                this.translations[t.language_id] = t;

            });
            this.languages.forEach((l:any)=>{
            });
            this.updatePost();
            let rows: Array<any> = [];
            this.oldElement.rows.forEach((row: any) => {
                    let newColumns: Array<any> = [];
                    row.columns.forEach((column: any) => {
                            let translations: Array<any> = [];
                            column.translations.forEach((trans: any) => {
                                    //@ts-ignore
                                    trans['uniqueId'] = this.$generateUid();
                                    translations.push(trans);
                                },
                                column.translations = translations
                            );
                            //@ts-ignore;
                            column['uniqueId'] = this.$generateUid();
                            newColumns.push(column);
                        },
                        row.columns = newColumns
                    );
                    //@ts-ignore
                    row['uniqueId'] = this.$generateUid();
                    rows.push(row);
                },
                this.setRows(rows),
            );
        }
    };

    mounted() {

        let pathArray = window.location.pathname.split( '/' );
        let pagebuilderElement = pathArray[2];

        this.setPagebuilderElement(pagebuilderElement);

        if(this.storagePath){
            this.setStoragePath(this.storagePath);
        }

        if (this.oldElement && this.oldElement.photo && this.oldElement.photo.length) {
            let file = {name: this.oldElement.photo};
            let url = '/storage/' + this.getStoragePath + '/' + file.name;
            //@ts-ignore
            this.$refs.singleDropzone.manuallyAddFile(file, url)
        }
    }

    createRow() {
        let row = {
            //@ts-ignore
            uniqueId: this.$generateUid(),
            columns: []
        };
        this.rows.push(row);
        this.setRows(this.rows);
    };


    updatePost() {
        //@ts-ignore
        console.log(moment(this.published_on).format('YYYY-MM-DD HH:mm:ss'));
        let post: object = {
            photo: this.photo,
            name: this.name,
            //@ts-ignore
            published_on: moment(this.published_on).format('YYYY-MM-DD HH:mm:ss'),
            id: this.id,
            translations: this.translations
        };

        this.setPost(post);
    }
};
