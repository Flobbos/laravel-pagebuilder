<template>
    <div class="row-spacer-component">
        <div class="button-tooltip-wrapper">
            <button @click.prevent="active = !active" class="badge add-row-button"> +
            </button>
            <div class="pb-tooltip" v-show="active">
                <span class="text">
                    Raster
                    <br>
                    auswählen
                </span>
                <span @click.prevent="createRow(['pb-large-12'])"><strong>12 </strong></span>
                <span @click.prevent="createRow(['pb-large-6', 'pb-large-6'])"><strong>6/6 </strong></span>
                <span @click.prevent="createRow(['pb-large-4', 'pb-large-8'])"><strong>4/8</strong></span>
            </div>
        </div>
        <hr>
    </div>
</template>

<script lang="ts" src="./RowSpacerComponent.ts"></script>

<style lang="scss" src="./RowSpacerComponent.scss" ></style>