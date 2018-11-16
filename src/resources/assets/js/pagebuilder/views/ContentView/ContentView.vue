<!--@TODO: implement dragular-->

<template>
    <div class="content-view">
        <row-spacer-component v-if="!article.rows || article.rows.length === 0"></row-spacer-component>

<!--@Todo Sortable overflow-->
        <div class="row-component-wrapper">
            <draggable v-model="article.rows"  :option="{draggable: '.row-component'}">
                    <row-component @onImageUpload="onImageUpload" v-for="(row, index) in article.rows" :row="row"
                                   :key="'row' + index"></row-component>
            </draggable>
        </div>
    </div>
</template>

<script lang="ts" src="./ContentView.ts"></script>

<style lang="scss" src="./ContentView.scss" scoped></style>