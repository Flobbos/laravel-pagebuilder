import {findIndex, find, reject} from 'lodash';

import Vue from 'vue';

export default {
    addRow: function (state: any, row: any) {
        state.rows.push(row);
    },
    setRows: function (state: any, rows: any) {
        state.rows = rows;
    },
    updateRow: function (state: any, row: any) {
        let index = findIndex(state.rows, {'uniqueId': row.uniqueId});
        state.rows[index] = row;
    },
    deleteRow: function (state: any, uniqueId: any) {
        state.rows = reject(state.rows, {'uniqueId': uniqueId});
    },
    deleteColumn: function (state: any, data: any) {
        let row = find(state.rows, {'uniqueId': data.rowUniqueId});
        let rowIndex = findIndex(state.rows, {'uniqueId': data.rowUniqueId});
        //@ts-ignore
        row.columns = find(reject(row.columns, {'uniqueId': data.columnUniqueId}));

        //@ts-ignore
        if (row.columns === undefined) {
            //@ts-ignore
            row.columns = [];
        }
        Vue.set(state.rows, rowIndex, row);
    },
    updateColumn: function (state: any, data: any) {
        let rowId = data.rowId;
        let column = data.column;

        let rowIndex = findIndex(state.rows, {'uniqueId': rowId});

        let columnIndex = findIndex(state.rows[rowIndex].columns, {'uniqueId': column.uniqueId});

        state.rows[rowIndex].columns[columnIndex] = column;

    },
    setElementTypes: function (state: any, elementTypes: any) {
        state.element_types = elementTypes;
    },
    setLanguages(state: any, languages: any) {
        this.state.languages = languages;
    },
    setCurrentLang(state: any, lang: any) {
        state.currentLang = lang;
    },
    handleTranslation(state: any, data: any) {
        let rowId = data.row_id;
        let columnId = data.column_id;

        let rowIndex = findIndex(state.rows, {'uniqueId': rowId});

        let columnIndex = findIndex(state.rows[rowIndex].columns, {'uniqueId': columnId});
        let columnWithTranslations = state.rows[rowIndex].columns[columnIndex];



        /*state.rows[rowIndex].columns[columnIndex].content = data.content;*/

        let column = state.rows[rowIndex].columns[columnIndex];

        state.rows[rowIndex].columns[columnIndex].translations = reject(column.translations, {'language_id': data.language_id});
        state.rows[rowIndex].columns[columnIndex].translations.push(data);
    },
    setPost(state: any, post: any) {
        state.post = post;
    },
    handlePostTranslations(state: any, translations: any) {

        console.log(translations);
    },
    setPagebuilderElement(state:any, element:string){
        state.pagebuilder_element = element;
    },
    setStoragePath(state:any, path:string){
        state.storage_path = path;
    }
}
