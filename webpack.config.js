const path = require('path');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    module:{
        rules: [
            {
                test: /\.postcss$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                    {
                        loader: 'postcss-loader'
                    }
                ]
            }
        ],
    },
};
