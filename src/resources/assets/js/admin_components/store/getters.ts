import {findIndex, find, filter} from 'lodash';

export default {
    getRows(state: any) {
        return state.rows;
    },
    getElementTypes(state: any) {
        return state.element_types;
    },
    getElementTypeById: (state: any) => (id: number) => {
        return state.element_types.find((e: any) => e.id === id)
    },
    getLanguages(state: any) {
        return state.languages;
    },
    getCurrentLang(state: any) {
        return state.currentLang;
    },
    getLanguageById: (state: any) => (id: any) => {
        return find(state.languages, {'id': id})
    },
    getRow: (state: any) => (id: any) => {
        return find(state.rows, {'uniqueId': id});
    },
    getElement: (state:any) => (elementId:any, columnId:any, rowId:any)=>{

        let row = find(state.rows, {'uniqueId': rowId});

        //@ts-ignore
        let column = find(row.columns, {'uniqueId': columnId});
        //@ts-ignore
        let element = find(column.translations,{'uniqueId': elementId});
        return element;
    },
    getColumn: (state:any) => (columnId:any, rowId:any) =>{
        let row = find(state.rows, {'uniqueId': rowId});
        //@ts-ignore
        let column = find(row.columns, {'uniqueId': columnId});
        return column;
    },
    getColumns: (state: any) => (uniqueId: any) => {
        //@ts-ignore
        return find(state.rows, {'uniqueId': uniqueId}).columns;
    },
    getPost(state: any) {
        return state.post;
    },
    getTranslationsWithPhotos: (state: any) => (data: any) => {
        let columnUniqueId = data.columnId;
        let rowUniqueId = data.rowId;
        let row = find(state.rows, {'uniqueId': rowUniqueId});
        //@ts-ignore
        let column = find(row.columns, {'uniqueId': columnUniqueId});
        //@ts-ignore
        return filter(column.translations, function (t) {
            return t.photos && t.photos.length;
        });
    },
    getPagebuilderElement: function(state:any){
        return state.pagebuilder_element;
    },
    getStoragePath: function(state:any){
        return state.storage_path;
    }
}
