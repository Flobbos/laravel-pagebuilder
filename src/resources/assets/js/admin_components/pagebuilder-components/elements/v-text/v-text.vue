<template>
    <div class="pagebuilder-column">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label :for="'text' + lang.id" class="control-label">Text ({{lang.locale}})</label>
                    <quill-editor :content="form_text" :options="options" @change="onEditorChange($event)"></quill-editor>
                    <!--<textarea class="form-control" :id="'text' + lang.id" v-model="form_text"></textarea>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" src="./v-text.ts"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" src="./v-text.scss" scoped></style>
