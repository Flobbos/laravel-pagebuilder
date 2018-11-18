<template>
    <div class="content-view">
        <row-spacer-component v-if="!article.rows || article.rows.length === 0"></row-spacer-component>

<!--@Todo compare dragula with sortable js-->

        <div class="row-component-wrapper"  v-dragula="article.rows" drake="first">
                    <row-component @onImageUpload="onImageUpload" v-for="(row, index) in article.rows" :row="row"
                                   :key="'row' + index" :sorting="index"></row-component>
        </div>
    </div>
</template>

<script lang="ts" src="./ContentView.ts"></script>

<style lang="scss" src="./ContentView.scss" scoped></style>