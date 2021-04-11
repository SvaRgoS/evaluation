<script>
import {mapMutations} from 'vuex'

export default {
    name: 'contacts',
    methods: {
        ...mapMutations(["message_clear", "message_new"]),
        fireNewMessage: function (message) {
            this.message_new(message)
            setTimeout(() => this.message_clear(), 3000)
        }
    }
}

</script>
