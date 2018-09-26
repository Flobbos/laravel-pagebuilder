<template>
    <div class="pagebuilder-row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-11">
                        <h3 class="panel-title">Zeile {{arrayKey + 1}}</h3>
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-sm pull-right" @click.prevent="deleteRow(uniqueId)"><i class="glyphicon glyphicon-remove"></i></button>
                    </div>
                </div>
                
            </div>
            <div class="panel-body">
                <div class="row hidden">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customClass">CSS Klasse</label>
                            <input type="text" class="form-control" id="customClass" placeholder="CSS Klasse"
                                   v-model="form_custom_class">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expanded">Volle Breite
                            <input type="checkbox" id="expanded" v-model="form_expanded">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="jumbotron add-column text-center" @click="addColumn()" v-if="$store.getters.getColumns(uniqueId).length < columnLimit || $store.getters.getColumns(uniqueId).length === 0">
                            <h1>Element einfügen</h1>
                        </div>
                        <div v-else>
                            <column v-for="column in columns" :key="column.uniqueId" :row-id="uniqueId" :uniqueId="column.uniqueId"></column>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" src="./Row.ts"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" src="./Row.scss" scoped></style>
