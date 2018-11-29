import Vue from 'vue';


import axios from 'axios';
import {Row} from "../models/Row";

const routePrefix: string = '/pagebuilder/';

const token: any = document.querySelector('meta[name="csrf-token"]');

const headers = {
    headers: {"Content-Type": "multipart/json"},
    'X-CSRF-TOKEN': token.getAttribute('content')
};

export default {


    createElement(store: any) {
        let article = store.getters.getArticle;

        axios.post(routePrefix + 'articles', article, headers).then(response => {
        })

    },

    updateElement(store: any) {
        let article = store.getters.getArticle;

        axios.put(routePrefix + 'articles/' + article.id, article, headers).then(response => {
            //window.location.href = response.data.return_url;
        }).catch(error => {
        });

    },

    deleteRow(store: any, row: Row) {
        axios.delete(routePrefix + 'delete-row', {params: {id: row.id}})
            .then((response) => {
                store.state.article.rows.splice(row.sorting, 1);
            }).catch((error) => {
            console.log(error)
        });
    }

}