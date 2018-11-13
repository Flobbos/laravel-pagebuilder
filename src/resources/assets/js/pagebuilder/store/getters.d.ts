declare const _default: {
    getElementTypes(state: any): any;
    getElementTypeById: (state: any) => (id: number) => any;
    getLanguages(state: any): any;
    getCurrentLang(state: any): any;
    getLanguageById: (state: any) => (id: any) => {
        'id': {};
    } | undefined;
    getElement: (state: any) => (elementId: any, columnId: any, rowId: any) => {
        'uniqueId': {};
    } | undefined;
    getArticle(state: any): any;
};
export default _default;
