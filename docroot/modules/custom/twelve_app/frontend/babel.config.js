module.exports = {
    "presets": [
        ['@vue/app', {
            polyfills: [
                'es6.object.assign',
                'es7.object.values',
                'es7.array.includes',
                'es6.math.cbrt',
                'es6.string.repeat',
                'es6.string.starts-with',
                'es6.array.from',
                'es6.promise',
                'es6.symbol'
            ]
        }],
        [
            "@babel/preset-env",
            {
                "targets": {
                    "browsers": [
                        "last 2 versions",
                        "ie >= 11"
                    ],
                },
                "corejs": "2.6.11",
                "useBuiltIns": "entry"
            }
        ]
    ]
}