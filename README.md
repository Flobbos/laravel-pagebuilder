# Laravel-Pagebuilder


![Laravel Pagebuilder](img/laravel-pagebuilder.png)

## Installtion


##### Install the required dependencies
~~~
npm install --save typescript@2.9.2 ts-loader@3.2.0 vue-class-component vue-property-decorator vue-quill-editor vue-select vue2-dragula vuex vuex-class lodash @types/lodash vue-bootstrap-datetimepicker vue-sticky-directive vue2-dropzone
~~~


##### Set up TypeScript
After installing the required dependencies you have to tell webpack to handle the file extensions and to use the ts-loader instead the vue-loader.
Add following to your webpack.mix.js

~~~
 module: {
            rules: [
                // We're registering the TypeScript loader here. It should only
                // apply when we're dealing with a `.ts` or `.tsx` file.
                {
                    test: /\.tsx?$/,
                    loader: 'ts-loader',
                    options: { appendTsSuffixTo: [/\.vue$/] },
                    exclude: /node_modules/
                }
            ]
        },

        resolve: {
            // We need to register the `.ts` extension so Webpack can resolve
            // TypeScript modules without explicitly providing an extension.
            // The other extensions in this list are identical to the Mix
            // defaults.
            extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx'],

            alias: {
                'scss': path.resolve(__dirname, './resources/assets/sass/frontend'),
                'vendor': path.resolve(__dirname, './node_modules/'),
            }
        },
~~~

##### Set up vue-class-components and vue-property-decorator

Create a file called `tsconfig.json` in your project root and fill it with following:

~~~
{
    "compilerOptions": {
        "target": "es5",
        "module": "es2015",
        "moduleResolution": "node",
        "isolatedModules": false,
        "experimentalDecorators": true,
        "emitDecoratorMetadata": true,
        "declaration": true,
        "noImplicitAny": true,
        "removeComments": false,
        "strictNullChecks": true,
        "typeRoots": [
            "../node_modules/@types/"
        ],
        "allowSyntheticDefaultImports": true,
        "lib": [
            "dom",
            "es2015",
            "es2016",
            "es2017"
        ]
    },
    "include": [
        "./*.ts"
    ],
    "exclude": [
        "node_modules",
        "lib"
    ],
    "compileOnSave": false
}
~~~

This is needed to use the vue-class-components and vue-property-decorator annotations

Because not all dependencies are TypeScript ready we need to create a declaration file in order that TypeScript knows the require method.

Create a file called `require.d.ts`  and declare the function like this:

~~~
declare function require(name: string): any;
~~~

**If you want to save time on your crud operations**
