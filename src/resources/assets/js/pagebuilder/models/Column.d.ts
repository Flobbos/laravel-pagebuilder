import { BaseModel } from "./BaseModel";
import { Translation } from "./Translation";
export declare class Column extends BaseModel {
    constructor();
    active: boolean;
    translations: Translation[];
    sorting: number;
    row_id: number;
    element_type_id: number;
    column_size: string;
    custom_class: string;
}
