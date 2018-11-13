<template>
    <div class="settings-view">
        <div class="panel panel-default">
            <slot name="header"></slot>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="photo">Header-Foto</label>
                            <vue-dropzone ref="singleDropzone" id="dropzone" :options="dropzoneOptions" :destroyDropzone="false"  @vdropzone-success="onSuccess" @vdropzone-removed-file="onFileRemove"></vue-dropzone>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="name">Interne Benennung</label>
                        <input class="form-control" type="text" name="name" id="name" v-model="article.name"/>
                        <br>
                        <label for="name">Veröffentlicht am</label>
                        <date-picker v-model="article.published_on"></date-picker>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="tab-content">
                                <div v-for="(l, index) in $store.getters.getLanguages" role="tabpanel"
                                     :id="l.locale"
                                     :class="[l.locale === $store.getters.getCurrentLang ? 'tab-pane active' : 'tab-pane']">
                                    <input type="hidden" :value="l.id"/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label :for="'title'+l.id" class="control-label">Titel
                                                    ({{l.locale}})</label>
                                                <input :id="'title'+l.id" type="text" class="form-control"
                                                       :name="'title'+l.id"  v-model="article.translations[l.id].content.title">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label :for="'teaser'+l.id" class="control-label">Teaser-Text
                                                    ({{l.locale}})</label>
                                                <textarea class="form-control" :name="'teaser'+l.id"
                                                          :id="'teaser'+l.id" v-model="article.translations[l.id].content.teaser"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" src="./Settingsview.ts"></script>

<style lang="scss" src="./SettingsView.scss" scoped></style>