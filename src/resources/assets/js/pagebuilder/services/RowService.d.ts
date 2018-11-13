import { Row } from "../models/Row";
export declare abstract class RowService {
    static createNew(columnLayout: string[]): Row;
    static createFromExisting(oldRow: any, languages: any): Row;
}
