import {findIndex, find, filter} from 'lodash';

export default {
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
    getElement: (state:any) => (elementId:any, columnId:any, rowId:any)=>{

        let row = find(state.rows, {'uniqueId': rowId});

        //@ts-ignore
        let column = find(row.columns, {'uniqueId': columnId});
        //@ts-ignore
        let element = find(column.translations,{'uniqueId': elementId});
        return element;
    },
    getArticle(state: any){
        return state.article;
    }
}
