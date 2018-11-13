<template>
    <div class="row-component row">
            <column-component  :oldColumn="column" v-for="column in row.columns" :key="column.uuid"></column-component>
        <row-spacer-component :sorting="row.sorting"></row-spacer-component>
    </div>
</template>

<script lang="ts" src="./RowComponent.ts"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" src="./RowComponent.scss" ></style>
