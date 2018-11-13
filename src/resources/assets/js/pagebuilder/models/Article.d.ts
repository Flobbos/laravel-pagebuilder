import { BaseModel } from "./BaseModel";
import { Translation } from "./Translation";
import { Row } from "./Row";
export declare class Article extends BaseModel {
    photo: string;
    translations: Translation[];
    name: string;
    published_on: Date;
    is_published: boolean;
    rows: Row[];
}
