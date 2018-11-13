import Vue from "vue";
import { Column } from "../../models/Column";
export default class ColumnComponent extends Vue {
    oldColumn: Column;
    getElementTypeById: any;
    getLanguages: any;
    getElementTypes: any;
    column: Column;
    component: string;
    columnSize: string;
    toolTipActive: boolean;
    beforeMount(): void;
    mounted(): void;
    addElement(id?: number): void;
    updateElementTypeId(id: number): void;
    createColumnLayout(): void;
}
