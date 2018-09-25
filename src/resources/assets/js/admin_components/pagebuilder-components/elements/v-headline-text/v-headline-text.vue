<template>
    <div class="pagebuilder-column">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label :for="'headline' + lang.id" class="control-label">Headline ({{lang.locale}})</label>
                    <input :id="'headline' + lang.id" type="text" class="form-control" v-model="form_headline"/>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label :for="'text' + lang.id" class="control-label">Text ({{lang.locale}})</label>
                    <textarea class="form-control" :id="'text' + lang.id" v-model="form_text"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" src="./v-headline-text.ts"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" src="./v-headline-text.scss" scoped></style>
