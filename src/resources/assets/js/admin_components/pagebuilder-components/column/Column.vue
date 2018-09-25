<template>
    <div class="pagebuilder-column">
        <div class="row">
            
            <div class="col-md-6 hidden">
                <div class="form-group">
                    <label for="customClass">CSS Klasse</label>
                    <input disabled type="text" class="form-control" id="customClass" placeholder="CSS Klasse"
                           v-model="form_custom_class" @change="updateColumn">
                </div>
            </div>

            <div class="col-md-6 hidden">
                <div class="form-group">
                    <label for="column_size">Spalten Breite</label>
                    <input readonly type="text" class="form-control" id="column_size" v-model="form_column_size"
                           @change="updateColumn">
                </div>
            </div>
        </div>
        <div class="element-select panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="btn-group">
                            <button v-for="(type, key) in $store.getters.getElementTypes" :key="'element-' + key"
                                class="btn btn-default btn-md" :title="type.name"
                                @click.prevent="updateElementTypeId(type.id)">
                                <span class="oi" :data-glyph="type.icon"><i :class="type.icon"></i> {{type.name}}</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-sm pull-right" @click.prevent="deleteColumn()"><i class="glyphicon glyphicon-remove"></i></button>
                    </div>
                </div>
                
            </div>
            <div class="panel-body" v-if="component.length !== 0">
                <div class="row" v-if="component.length !== 0">
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
                                    <component :is="component" :lang="l" :column-id="uniqueId" :row-id="rowId" :translations="column.translations"></component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" src="./Column.ts"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" src="./Column.scss" scoped></style>
