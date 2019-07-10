import { initConfig, camelCase, wpModuleToGlobal } from './rollup';

export default initConfig({
	environment: 'development',
	bundlesMap: {
		'assets/src/front/index.ts': 'assets/tmp/front.js',
		'assets/src/common/index.ts': {
			file: 'assets/tmp/common.js',
			asVirtualModule: '@ithoughts/tooltip-glossary/common',
		},
		'assets/src/back/common/index.ts': {
			file: 'assets/tmp/back-common.js',
			asVirtualModule: '@ithoughts/tooltip-glossary/back/common',
		},
		'assets/src/back/classic/index.ts': 'assets/tmp/back-editor-classic.js',
	},
	internals: ['react-modal', 'react-tabs', 'react-autocomplete', 'autobind-decorator', 'debounce', 'html-element-attributes', 'tippy.js'],
	globals: {
		react: 'React',
		tinymce: 'tinymce',
		underscore: '_',
		jquery: 'jQuery',
		'react-dom': 'ReactDOM',
		backbone: 'Backbone',
	},
	virtualModules: {
		modules: ['editor-config', '@wordpress/api'],
		/**
		 * @param {string} name
		 */
		moduleNameFactory: name => name.startsWith('@wordpress/') ? name : `~${name}`,
		/**
		 * @param {string} name
		 */
		globalNameFactory: name => name.startsWith('@wordpress/') ?
			wpModuleToGlobal( name ) :
			`ithoughtsTooltipGlossary_${camelCase( name )}`
	},
	namedExports: [ 'react', 'react-dom', 'debounce' ],
})
