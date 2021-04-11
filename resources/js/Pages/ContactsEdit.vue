<template>
    <b-row>
        <b-col></b-col>
        <b-col cols="6">
            <main class="inner cover pt-5" role="main">
                <h1>{{ header }}</h1>
                <b-form class="login" @submit.prevent="save">

                    <b-form-group label="First Name:" label-for="name-1">
                        <b-form-input
                            id="name-1"
                            v-model="form.first_name"
                            placeholder="Enter a first name"
                            required
                            type="text"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group  label="Last Name" label-for="name-2" >
                        <b-form-input
                            id="name-2"
                            v-model="form.last_name"
                            placeholder="Enter a last name"
                            required
                            type="text"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group  label="Description" label-for="description" >
                        <b-form-textarea
                            id="description"
                            v-model="form.description"
                            placeholder="Enter a description"
                            required
                            type="text"
                        />
                    </b-form-group>

                    <b-form-group  label="Phone:" label-for="name-2" >
                        <b-form-input
                            id="name-2"
                            v-model="form.phone"
                            placeholder="Enter a phone"
                            required
                            type="text"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group  label="Email:" label-for="email" >
                        <b-form-input
                            id="email"
                            v-model="form.email"
                            placeholder="Enter a email"
                            required
                            type="email"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group  label="Country:" label-for="country" >
                        <b-form-input
                            id="country"
                            v-model="form.country"
                            placeholder="Enter a country"
                            required
                            type="text"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group  label="City:" label-for="city" >
                        <b-form-input
                            id="city"
                            v-model="form.city"
                            placeholder="Enter a city"
                            required
                            type="text"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group  label="Address line 1:" label-for="address_line_1" >
                        <b-form-input
                            id="address_line_1"
                            v-model="form.address_line_1"
                            placeholder="Enter an address"
                            required
                            type="text"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group  label="Address line 2:" label-for="address_line_2" >
                        <b-form-input
                            id="address_line_2"
                            v-model="form.address_line_2"
                            placeholder="Enter an address"
                            required
                            type="text"
                        ></b-form-input>
                    </b-form-group>

                    <hr/>
                    <b-button type="reset" @click.prevent="$router.go(-1)" variant="warning">Cancel</b-button>
                    <b-button type="submit" variant="primary">Submit</b-button>
                </b-form>
            </main>
        </b-col>
        <b-col></b-col>
    </b-row>
</template>

<script>
import API from '../Services/api'
import notification from "../Mixins/notification";

export default {
    name: 'ContactsEdit',
    mixins: [notification],
    props:['id'],
    data() {
        return {
            loaded: false,
            form: {
                first_name: '',
                last_name: '',
                phone: '',
                address_line_1:  '',
                address_line_2:  '',
                city:  '',
                country: '',
                description:  '',
                email:  '',
                id:  ''
            },
        }
    },
    computed: {
        header: function () {
            return (this.id ? 'Edit' : 'Create') + ' Contact';
        }
    },
    methods: {
        save: function () {
            if (this.id) {
                API.patchContact(this.form.id, this.form)
                    .then(() => this.$router.push('/contacts'))
                    .catch(err => console.log(err))
            }else{
                API.postContact(this.form)
                    .then(() => this.$router.push('/contacts'))
                    .catch(err => console.log(err))
            }
        },
        load: function () {
            if (this.id) {
                this.fireNewMessage("Loading ...")
                API.getContact(this.id)
                    .then(response => {
                        this.fireNewMessage("Loaded successfully")
                        this.form = response.data.data;
                        this.loaded = true
                    })
                    .catch(_ => {
                        this.fireNewMessage("Error: Can't get contact")
                    })
            }
        }
    },
    mounted() {
        this.load();
    }
}
</script>
