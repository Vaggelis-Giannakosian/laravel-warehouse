
module.exports = {
    methods: {
        /**
         * Translate the given key.
         */
        $asset(path) {
            const asset_path = this.$page?.props?.asset

            return asset_path ?
                asset_path + path.replace(/^\/+/, '') :
                path
        },
    },
}
