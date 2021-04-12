<template>
    <b-row>
        <b-col cols="12">
            <main class="inner cover pt-5" role="main">
                <h1>Contacts</h1>
                <div class="actions">
                    <b-button v-if="canEdit" variant="success" size="sm" @click="$router.push({ name: 'contacts-add'})" class="float-right mr-1">
                       Create New
                    </b-button>
                </div>
                <b-table :fields="fields" :items="contacts" hover striped>
                    <template #cell(actions)="row">
                        <b-button v-if="canEdit" size="sm" @click="$router.push({ name: 'contacts-edit', params: { id: row.item.id } })" class="mr-1">
                            Edit
                        </b-button>
                        <b-button v-if="canRemove" variant="danger" size="sm" @click="removeContact(row.item.id)">
                           Remove
                        </b-button>
                    </template>
                </b-table>
            </main>
        </b-col>
    </b-row>
</template>

<script>
import API from '../Services/api'
import notification from "../Mixins/notification";

export default {
    name: 'contacts',
    mixins: [notification],
    data() {
        return {
            loaded: false,
            contacts: [],
            fields: [
                {
                key: 'name',
                sortable: true
                },
                {
                    key: 'phone',
                    sortable: false
                },
                {
                    key: 'description',
                    label: 'Description',
                    sortable: true,
                },
                {
                    key: 'actions',
                    label: 'Actions',
                    thStyle: 'width: 10rem'
                }
            ]
        }
    },
    computed: {
        canEdit: function(){

            return this.usersPermissions.includes('write')
        },
        canRemove: function(){
            return this.usersPermissions.includes('remove')
        },
        usersPermissions: function() {
            console.log('CP', this.$store.getters.currentUser.permissions);
            return this.$store.getters.currentUser.permissions
        }
    },
    methods: {
        removeContact: function (id)
        {
            if (confirm('Are you really want to remove this contact?')) {
                API.removeContact(id)
                    .then(response => {
                        this.fireNewMessage("Contact removed successfully")
                        this.load();
                    })
                    .catch(_ => {
                        this.fireNewMessage("Error: Can't remove contacts")
                    })
            }
        },
        load: function () {
            this.fireNewMessage("Loading ...")
            API.getContacts()
                .then(response => {
                    this.contacts = response.data.data;
                    this.loaded = true
                })
                .catch(_ => {
                    this.fireNewMessage("Error: Can't get contacts")
                })
        }
    },
    mounted() {
        this.load();
    }
}
</script>
