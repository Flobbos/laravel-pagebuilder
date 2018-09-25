<template>
    <div class="pagebuilder-column v-photo-description">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label :for="'description' + lang.id" class="control-label">Beschreibung ({{lang.locale}})</label>
                    <input :id="'description' + lang.id" type="text" class="form-control" v-model="form_description" @change="updateElement"/>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label :for="'text' + lang.id" class="control-label">Text({{lang.locale}})</label>
                    <textarea :id="'text' + lang.id"  class="form-control" v-model="form_text" @change="updateElement"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label :for="'photo' + lang.id" class="control-label">Bild ({{lang.locale}})</label>
                    <!--<input type="file"  :id="'photo' + lang.id"  @change="updatePhoto">-->

                    <vue-dropzone ref="photoDescription" id="dropzone" :options="dropzoneOptions"  @vdropzone-success="onSuccess" @vdropzone-sending="sendingEvent"></vue-dropzone>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" src="./v-photo-description.ts"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" src="./v-photo-description.scss"></style>
