const tailwind = require('tailwindcss');
const mix = require('laravel-mix');

process.env.MIX_BUILD_TIME = Date.now();

// global settings
mix
	.disableNotifications()
	.setResourceRoot('resources/js')
	.setPublicPath('public');

// render js file
mix
	.js('resources/js/tmi.js-cluster.js', 'public/assets')
	.vue();

// render css
mix.sass('resources/style/tmi.js-cluster.scss', 'public/assets', {}, [ tailwind ]);

mix.override((config) => {
	config.output.chunkFilename = 'assets/[name].[contenthash].js';
});

if (mix.inProduction()) {
	mix.version();
}