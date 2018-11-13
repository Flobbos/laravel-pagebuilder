import {BaseModel} from "./BaseModel";
import {Translation} from "./Translation";
import {Row} from "./Row";

export class Article extends BaseModel{

    photo: string = '';
    translations: Translation[] = [];
    name: string = '';
    published_on: Date = new Date();
    is_published: boolean = false;
    rows: Row[] = [];

}