import Vue from "vue";


import {Component, Prop, Watch} from "vue-property-decorator";
import {Getter} from "vuex-class";
import {Mutation} from "vuex-class";
import {size} from 'lodash';
import Column from '../column/Column';
import axios from 'axios';

@Component({
    components: {
        'column': Column
    }
})
export default class Row extends Vue {

    /*  @Getter('getRow') getRow: any;*/

    @Mutation('updateRow') storeUpdateRow: any;
    @Mutation('addColumn') storeAddColumn: any;
    @Mutation('deleteRow') storeDeleteRow: any;
    //@ts-ignore
    @Getter('getColumns') getColumns;
    //@ts-ignore
    @Getter('getRow') getRow;

    @Prop()
    postId: number;
    @Prop()
    uniqueId: string;
    @Prop()
    arrayKey: number;
    sorting: number = 1;
    columnLimit: number = 1;
    form_custom_class: string = '';
    form_expanded: boolean = false;
    id: number = 0;

    get columns() {
        return this.$store.getters.getColumns(this.uniqueId) ? this.$store.getters.getColumns(this.uniqueId) : [];
    }

    get columnCount() {
        return this.columns.length;
    }

    get row() {
        return this.getRow(this.uniqueId);
    }


    mounted() {

        if (this.row) {
            this.sorting = this.arrayKey;
            this.form_custom_class = this.row.custom_class;
            this.form_expanded = this.row.expanded;
            this.id = this.row.id;
        } else {
            this.sorting = this.arrayKey;
        }
    }

    updateRow() {
        let row =
            {
                uniqueId: this.uniqueId,
                custom_class: this.form_custom_class,
                expanded: this.form_expanded,
                columns: this.columns,
                sorting: this.sorting,
                id: this.id
            };
        this.storeUpdateRow(row);
        this.$forceUpdate();
    }

    deleteRow(uniqueId: string) {
        this.storeDeleteRow(uniqueId);
        if(this.id !== 0) {
            let headers = {
                headers: {"Content-Type": "multipart/form-data"},
                //@ts-ignore
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };

            let form_data = new FormData();
            //@ts-ignore
            form_data.append('row_id', this.id);
            form_data.append('type', this.$store.getters.getPagebuilderElement);

            //@ts-ignore
            axios.post('/admin/delete-row', form_data, headers).then(response => {
                console.log(response);
            })
        }
    }

    addColumn(limit: number = this.columnLimit) {
        if (this.columns.length < limit) {
            let column =
                {
                    //@ts-ignore
                    uniqueId: this.$generateUid()
                };
            this.columns.push(column);
            this.updateRow();
        } else {
            console.log('Spalten limit erreicht');
        }
    }

    @Watch('arrayKey')
    changeSorting() {
        this.sorting = this.arrayKey;
        this.updateRow();
    }

    @Watch('form_expanded')
    updateExpanded() {
        this.updateRow();
    }

    @Watch('form_custom_class')
    updateCustomClass() {
        this.updateRow();
    }
};
