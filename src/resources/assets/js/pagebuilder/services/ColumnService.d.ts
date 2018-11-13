import { Column } from "../models/Column";
export declare abstract class ColumnService {
    static createNew(languages: any, columnSize: string): Column;
    static createFromExisting(oldColumn: any, languages: any): Column;
}
