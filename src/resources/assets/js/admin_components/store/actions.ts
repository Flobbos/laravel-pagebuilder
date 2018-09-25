import Vue from 'vue';


import axios from 'axios';
export default {
    createElement(store: any) {
        //@ts-ignore
        let headers = {headers: {"Content-Type": "multipart/form-data"}, 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')};
        let rows = store.getters.getRows;
        let post = store.getters.getPost;
        let formData = {
            name: post.name,
            photo: post.photo,
            translations: post.translations,
            rows: rows
        };

        let form_create_data = new FormData();
        form_create_data.append('name', post.name);
        form_create_data.append('photo', post.photo);
        form_create_data.append('published_on', post.published_on);
        form_create_data.append('translations', JSON.stringify(post.translations));
        form_create_data.set('rows', JSON.stringify(rows));
        form_create_data.append('photo', post.photo);


        //@ts-ignore
        axios.post('/admin/' + store.getters.getPagebuilderElement, form_create_data, headers).then(response=>{
            window.location.href = response.data.return_url;
        })

    },

    updateElement(store: any) {

        //@ts-ignore
        let headers = {headers: {"Content-Type": "multipart/form-data"}, 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')};

        let rows = store.getters.getRows;
        let post = store.getters.getPost;

        let formData = {
            name: post.name,
            photo: post.photo,
            translations: post.translations,
            rows: rows
        };

        let form_update_data = new FormData();
        form_update_data.append('_method', 'PUT');
        form_update_data.append('name', post.name);
        form_update_data.append('photo', post.photo);
        form_update_data.append('published_on', post.published_on);
        form_update_data.append('translations', JSON.stringify(post.translations));
        form_update_data.set('rows', JSON.stringify(rows));
        form_update_data.append('photo', post.photo);



        let url = '/admin/' + store.getters.getPagebuilderElement + '/' + post.id;

        //@ts-ignore
        axios.post(url, form_update_data, headers).then(response=>{
            window.location.href = response.data.return_url;
        })

    },
}