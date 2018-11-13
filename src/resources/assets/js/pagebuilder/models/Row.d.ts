import { BaseModel } from "./BaseModel";
import { Column } from "./Column";
export declare class Row extends BaseModel {
    constructor();
    sorting: number;
    expanded: boolean;
    custom_class: string;
    columns: Column[];
}
