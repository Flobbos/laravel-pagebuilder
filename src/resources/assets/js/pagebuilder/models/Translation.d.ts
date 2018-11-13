import { BaseModel } from "./BaseModel";
export declare class Translation extends BaseModel {
    constructor(lang: number);
    content: object;
    language_id: number;
    translatable_id: number;
    translatable_type: string;
}
