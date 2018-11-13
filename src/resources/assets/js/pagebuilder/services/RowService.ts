import {Row} from "../models/Row";
import {ColumnService} from "./ColumnService";
import {Column} from "../models/Column";

import store from '../store/index';

export abstract class RowService {

    public static createNew(columnLayout: string[]): Row {
        const languages = store.getters.getLanguages;
        const row = new Row();

        columnLayout.forEach((c: string) =>{
            row.columns.push(
                ColumnService.createNew(languages, c)
            )
        });
        return row;
    }

    public static createFromExisting(oldRow: any, languages: any) {
        let row = new Row();

        try {
            row.id = oldRow.id;
            row.sorting = oldRow.sorting;
            row.expanded = oldRow.expanded;
            row.custom_class = oldRow.custom_row;

            if (oldRow.columns && oldRow.columns.length) {

                oldRow.columns.forEach((c: any) => {
                    let column = ColumnService.createFromExisting(c, languages);
                    row.columns.push(column);
                })
            }
            return row;
        } catch (e) {
            console.error(e);
            return row;
        }
    }
}