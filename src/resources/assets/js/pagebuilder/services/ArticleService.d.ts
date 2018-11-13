import { Article } from "../models/Article";
export declare abstract class ArticleService {
    static createNew(languages: any): Article;
    static createFromExisting(oldArticle: any, languages: any): Article;
}
