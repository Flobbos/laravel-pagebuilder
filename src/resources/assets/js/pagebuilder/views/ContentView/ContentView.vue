<!--@TODO: implement dragular-->

<template>
    <div class="content-view">
        <row-spacer-component v-if="!article.rows || article.rows.length === 0"></row-spacer-component>
            <div  v-dragula="article.rows" drake="rows" class="row-component-wrapper" v-for="(row, index) in article.rows">
                <row-component :sorting="index" :old-row="row"></row-component>
        </div>
    </div>
</template>

<script lang="ts" src="./ContentView.ts"></script>

<style lang="scss" src="./ContentView.scss" scoped></style>