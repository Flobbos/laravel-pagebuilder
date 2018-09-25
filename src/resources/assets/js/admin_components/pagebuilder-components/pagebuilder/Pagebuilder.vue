<template>
    <div class="row">
        <div class="col-sm-12">
            <!-- Main info panel -->
            <div class="panel panel-default">
              <slot name="header"></slot>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="photo">Header-Foto</label>
                                <vue-dropzone ref="singleDropzone" id="dropzone" :options="dropzoneOptions"  @vdropzone-success="onSuccess" @vdropzone-sending="sendingEvent"></vue-dropzone>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="name">Interne Benennung</label>
                            <input class="form-control" type="text" name="name" id="name" v-model="name"  @change="updatePost"/>
                            <br>
                            <label for="name">Veröffentlicht am</label>
                            <date-picker v-model="published_on" :config="config" @dp-change="updatePost"></date-picker>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li v-for="(l, index) in $store.getters.getLanguages" role="presentation"
                                        :class="{'active': l.locale === $store.getters.getCurrentLang}">
                                        <a :href="'#'+l.locale" :aria-controls="l.locale" role="tab" data-toggle="tab"
                                           @click.prevent="$store.commit('setCurrentLang', l.locale)">{{l.name}}</a>
                                    </li>
                                </ul>
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
                                                           :name="'title'+l.id"  v-model="translations[l.id].title" @change="updatePost">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label :for="'teaser'+l.id" class="control-label">Teaser-Text
                                                        ({{l.locale}})</label>
                                                    <textarea class="form-control" :name="'teaser'+l.id"
                                                              :id="'teaser'+l.id" v-model="translations[l.id].teaser"  @change="updatePost"></textarea>
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
            <!-- ./Main info panel -->
            <!-- Page-Builder panel -->
            <div class="panel panel-default" v-sticky sticky-side="top">
                <div class="panel-heading panel-default">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="panel-title">Page-Builder</h3>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-sm btn-success pull-right" @click.prevent="createRow">Add row</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- rows -->
            <div class="pagebuilder">
                <!-- row elements go here -->
                <div v-dragula="rows" drake="rows">
                    <row :unique-id="row.uniqueId" :array-key="index" v-for="(row,index) in $store.getters.getRows" :key="row.uniqueId">
                    </row>
                </div>
                <!-- ./row elements -->
            </div>
            <!-- ./rows -->
            <div class="panel panel-default">
                <slot name="footer"></slot>
            </div>
            <!-- ./Page-Builder panel -->
        </div>
    </div>
</template>

<script lang="ts" src="./Pagebuilder.ts"></script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" src="./Pagebuilder.scss" scoped></style>
