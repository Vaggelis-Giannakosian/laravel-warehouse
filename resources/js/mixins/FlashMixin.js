const {mapActions} = require('vuex');


module.exports = {

    methods: {
        ...mapActions({
            $flash: 'flashMessage',
        })
    },
}
