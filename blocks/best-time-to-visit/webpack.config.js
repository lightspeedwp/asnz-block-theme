/**
 * Webpack config for Best Time to Visit block.
 * Uses @wordpress/scripts default configuration.
 *
 * @package asnz-block-theme
 */

const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
    ...defaultConfig,
    entry: {
        index: path.resolve(__dirname, 'index.js'),
    },
    output: {
        path: path.resolve(__dirname, 'build'),
        filename: '[name].js',
    },
};
