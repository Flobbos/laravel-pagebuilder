import Vue from 'vue';


import axios from 'axios';

export default {
    createElement(store: any) {
        //@ts-ignore
        let headers = {
            headers: {"Content-Type": "multipart/json"},
            //@ts-ignore
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
        let article = store.getters.getArticle;

        //@ts-ignore
        axios.post('/pagebuilder/articles', article, headers).then(response => {
            console.log(response.data);
        })

    },

    updateElement(store: any) {

        //@ts-ignore
        let headers = {
            headers: {"Content-Type": "multipart/json"},
            //@ts-ignore
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
        let article = store.getters.getArticle;
        let url = '/pagebuilder/articles/' + article.id;

        //@ts-ignore
        axios.put(url, article, headers).then(response => {
            //window.location.href = response.data.return_url;
            console.log(response);
        }).catch(error => {
            console.log(error);
        });

    },

    modelTest(store: any) {
        let article = store.getters.getArticle;

        axios.post('/pagebuilder/' + store.getters.getPagebuilderElement, article).then(response => {
            console.log(response.data);
        })
    }
}