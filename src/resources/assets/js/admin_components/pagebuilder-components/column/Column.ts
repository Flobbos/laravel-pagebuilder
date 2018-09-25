import Vue from "vue";

//@ts-ignore

import {Component, Prop, Watch} from "vue-property-decorator";
import {Getter, Mutation} from "vuex-class";
import axios from "axios";

@Component
export default class Column extends Vue {

    @Prop()
    rowId: string;
    @Prop()
    uniqueId: string;

    @Mutation('updateColumn') storeUpdateColumn: any;
    @Mutation('deleteColumn') storeDeleteColumn: any;
    //@ts-ignore
    @Getter('getElementTypeById') getElementTypeById;
    @Getter('getLanguages') getLanguages: any;
    @Getter('getRows') getRows: any;
    //@ts-ignore
    @Getter('getColumn') getColumn;

    photos: Array<any> = [];
    translations: Array<any> = [];
    element_type: object;
    component: string = '';
    currentLang: string = 'de';
    element_type_id: number = 0;
    form_custom_class: string = '';
    form_column_size: string = '12';
    id: number = 0;

    beforeMount() {
        if (!this.column) {
            let langs: any = this.getLanguages;
            langs.forEach((lang: any) => {
                let translation = {
                    language_id: lang.id
                };

                this.translations.push(translation);
            });
        } 
        else if(this.column.id){
            console.log(this.column.id);
            this.translations = this.column.translations;
            this.element_type_id = this.column.element_type_id;
            this.form_column_size = this.column.column_size;
            this.form_custom_class = this.column.custom_class;
            this.id = this.column.id;
        }
    }

    mounted() {
        if (this.element_type_id) {
            this.element_type = this.getElementTypeById(this.element_type_id);
            this.addElement();
        }
    }

    get column() {
        return this.getColumn(this.uniqueId, this.rowId);
    }

    updateColumn() {

        let column = {
            uniqueId: this.uniqueId,
            custom_class: this.form_custom_class,
            column_size: this.form_column_size,
            element_type_id: this.element_type_id,
            photos: this.photos,
            translations: this.translations,
            element_type: this.element_type,
            id: this.id
        };

        let data = {
            rowId: this.rowId,
            column: column
        };

        this.storeUpdateColumn(data)
    };


    updateElementTypeId(id: number) {
        this.element_type_id = id;
        if (this.element_type_id || this.element_type_id > 0) {
            this.element_type = this.getElementTypeById(this.element_type_id);

            this.addElement();
            this.updateColumn();
        }
        this.updateColumn();
    };

    addElement() {
        //@ts-ignore
        this.component = this.element_type.component;

        if (this.component !== null) {
            Vue.component(
                this.component,
                //@ts-ignore
                require("../elements/" + this.component + '/' + this.component)
            );
        }
    }

    deleteColumn() {
        this.storeDeleteColumn({rowUniqueId: this.rowId, columnUniqueId: this.uniqueId});
        this.$forceUpdate();

        if(this.id !== 0) {
            let headers = {
                headers: {"Content-Type": "multipart/form-data"},
                //@ts-ignore
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };

            let form_data = new FormData();
            //@ts-ignore
            form_data.append('column_id', this.id);
            form_data.append('type', this.$store.getters.getPagebuilderElement);
            //@ts-ignore
            axios.post('/admin/delete-column', form_data, headers).then(response => {
                console.log(response);
            })
        }
    }

    @Watch('form_custom_class')
    updateCustomClass() {
        this.updateColumn();
    }

    @Watch('form_column_size')
    updateColumnSize() {
        this.updateColumn()
    }
};
