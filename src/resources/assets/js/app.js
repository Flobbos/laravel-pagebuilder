/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./pagebuilder');
window.Vue = require('vue');
import store from "./pagebuilder/store/index.ts"

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import Simplert from 'vue2-simplert';
window.app = new Vue({
    el: '#app',
    store,

    components:{
        Simplert
    },

    methods: {
        confirmDelete: function (e, i) {
            this.form = e.target;
            let obj = {
                title: 'Eintrag löschen?',
                message: 'Möchtest du den Datensatz wirklich löschen?',
                type: 'warning',
                useConfirmBtn: true,
                customConfirmBtnText: 'Ja, jetzt löschen',
                customConfirmBtnClass: 'btn btn-danger',
                customCloseBtnText: 'Nein, lieber nicht.',
                onConfirm: this.submitForm
            };
            this.$refs.simplert.openSimplert(obj);
        },

        submitForm() {
            this.form.submit();
        },

        addError(key, message) {
            if (key != 'message') {
                if (!this.errors) {
                    this.errors = {};
                }
                this.errors[key] = [message];
            }
        }
    }
});
