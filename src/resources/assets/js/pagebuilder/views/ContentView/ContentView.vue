<!--@TODO: implement dragular-->

<template>
    <div class="content-view">
        <row-spacer-component v-if="!article.rows || article.rows.length === 0"></row-spacer-component>


        <div class="row-component-wrapper">
            <draggable v-model="rows" :option="{draggable: '.row-component'}" @end="sortRows">
                    <row-component v-for="(row, index) in rows" :old-row="row"
                                   :key="'row' + index"></row-component>
            </draggable>
        </div>
    </div>
</template>

<script lang="ts" src="./ContentView.ts"></script>

<style lang="scss" src="./ContentView.scss" scoped></style>