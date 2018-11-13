<template>
    <div class="row">

        <div class="pb-side-nav-wrapper">
            <div class="panel pb-side-nav">
                <div class="panel-body">
                    <ul>
                        <li>
                            <p  @click="setDesktop">Desktop</p>
                        </li>
                        <li>
                            <p @click="setTablet">Tablet</p>
                        </li>
                        <li>
                            <p  @click="setMobile">Mobile</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel pb-side-nav">
                <div class="panel-body">
                    <ul>
                        <li>
                            <p>{{currentView}}</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel pb-side-nav has-dropright">
                <div class="panel-body">
                    <ul>
                        <li>
                            <p>
                                Sprachen <span class="lang-arrow"> <arrow></arrow> </span>
                            </p>
                            <ul class="is-dropright">
                                <li v-for="lang in languages">
                                    <p :class="{active: getCurrentLanguage === lang.locale}"
                                       @click.prevent="setCurrentLang(lang.locale)">{{lang.name}}</p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel pb-side-nav">
                <div class="panel-body">
                    <ul>
                        <li v-for="element in elementTypes">
                            <p><span class="glyphicon glyphicon-text-width element-icons"></span> {{element.name}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-8 col-sm-offset-3">

            <div class="row pb-navigation-buttons">
                <div class="col-sm-12">
                    <div class="pb-button-group">
                        <button class="btn pb-button" :class="{active: currentView === 'Content'}"
                                @click.prevent="currentView = 'Content'">Content
                        </button>
                        <button class="btn pb-button" :class="{active: currentView === 'Settings'}"
                                @click.prevent="currentView = 'Settings'">Settings
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <content-view v-if="currentView === 'Content'"></content-view>
                    <settings-view v-if="currentView === 'Settings'"></settings-view>
                </div>
            </div>

                <slot name="footer"></slot>

        </div>
    </div>
</template>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" src="./PagebuilderComponent.scss"></style>
<script lang="ts" src="./PagebuilderComponent.ts"></script>
