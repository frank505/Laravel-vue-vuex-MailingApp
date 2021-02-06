<template>
    <v-app>
        <v-card
                class=" custom-styles"
        >

            <v-card-title>
                Create New Mail
            </v-card-title>
            <v-card-subtitle>
                please the fields marked red are compulsory
            </v-card-subtitle>

            <form>




                <v-text-field
                        v-model="from"
                        :error-messages="fromErrors"
                        label="From"
                        required
                        @input="$v.from.$touch()"
                        @blur="$v.from.$touch()"
                ></v-text-field>

                <v-text-field
                        v-model="to"
                        :error-messages="toErrors"
                        label="To"
                        type="text"
                        required
                        @input="$v.to.$touch()"
                        @blur="$v.to.$touch()"
                ></v-text-field>

                <v-text-field
                        v-model="subject"
                        :error-messages="subjectErrors"
                        label="Subject"
                        type="text"
                        required
                        @input="$v.subject.$touch()"
                        @blur="$v.subject.$touch()"
                ></v-text-field>

                <v-textarea
                v-model="text_content"
                :error-messages="textContentErrors"
                label="Text Content"
                required
                @input="$v.text_content.$touch()"
                @blur="$v.text_content.$touch()"
                ></v-textarea>

                <vue-editor v-model="html_content"></vue-editor>

                <v-file-input
                        small-chips
                        multiple
                        @change="onFileChange"
                        label="Attach Files Here"
                ></v-file-input>


                <v-alert
                        dense
                        text
                        :type="createMail.success==false?'error':
                                 createMail.success==true?
                              'success'
                           :
                          ''"
                        :style="createMail.success==false?'display:block':
                                 createMail.success==true?
                              'display:block'
                           :
                          'display:none'"
                >
                    {{createMail.message}}
                </v-alert>

                <v-btn
                        class="mr-4 custom-style-btn-one"
                        @click="submit"

                >
                    submit
                </v-btn>
                <v-btn @click="clear" class="custom-style-btn-two">
                    clear
                </v-btn>
            </form>




        </v-card>

    </v-app>

</template>

<script>

    import { validationMixin } from 'vuelidate'
    import { required } from 'vuelidate/lib/validators'
    import { VueEditor } from "vue2-editor";
    import {checkIfFieldsAreEmpty} from "../../../utilities/helperFunc";
    import {mapState, mapActions} from 'vuex'


    export default {
        mixins: [validationMixin],

        validations: {
            from:{required},
            to:{required},
            text_content:{required},
            html_content: {required},
            subject:{required}
        },

        data: () => ({
            from: '',
            to: '',
            subject:'',
            html_content:"<h1>Some initial content</h1>",
            text_content:'',
            files:''
        }),

        computed: {
            ...mapState("Mail", ["createMail"]),

            fromErrors () {
                const errors = []
                if (!this.$v.from.$dirty) return errors
                !this.$v.from.required && errors.push('From field is required.')
                return errors
            },
            toErrors () {
                const errors = []
                if (!this.$v.to.$dirty) return errors
                !this.$v.to.required && errors.push('to field is required')
                return errors
            },
            subjectErrors()
            {
                const errors = []
                if (!this.$v.subject.$dirty) return errors
                !this.$v.subject.required && errors.push('to field is required')
                return errors
            },
            htmlContentErrors()
            {
                const errors = []
                if (!this.$v.html_content.$dirty) return errors
                !this.$v.html_content.required && errors.push('to field is required')
                return errors
            },
            textContentErrors()
            {
                const errors = []
                if (!this.$v.text_content.$dirty) return errors
                !this.$v.text_content.required && errors.push('to field is required')
                return errors
            },
        },


        methods: {
            ...mapActions("Mail", ["createMailAction","clearCreateMail"]),
            submit () {
                this.$v.$touch()
                let dataToCheck = {
                    from: this.from,
                    to: this.to,
                    subject: this.subject,
                    html_content:this.html_content,
                    text_content:this.text_content,
                }

                if(checkIfFieldsAreEmpty(dataToCheck)==false)
                {
                    return;
                }

                let fd = new FormData();
                fd.append('from',this.from);
                fd.append('to',this.to);
                fd.append('subject',this.subject);
                fd.append('html_content',this.html_content);
                fd.append('text_content',this.text_content);
                fd.append('attachment',this.files);

                  this.createMailAction(fd);
            },


            onFileChange(e)
            {
                this.files = e;
            },

            clear () {
                this.$v.$reset()
                this.from = ''
                this.to = '',
                 this.subject = '',
               this.html_content = '',
               this.text_content = ''
            },

        },

        beforeRouteLeave (to, from, next) {
            console.log(this.$store._actions);
            this.clearCreateMail();
            next();

        },

        components:{
            VueEditor
        }
    }

</script>


<style scoped>
    .custom-styles{
        width:60%;
        margin-left:20%;
        margin-right: 20%;
        margin-top: 60px;
        padding:5%;
    }
    .custom-style-btn-one
    {
        background-color: #ff5252 !important;
        border-color: #ff5252 !important;
        color: white !important;
        margin: 2%;
        margin-top:3%;
    }
    .custom-style-btn-two{
        background-color: #1867c0 !important;
        border-color: #1867c0 !important;
        color: white !important;
        margin: 2%;
        margin-top:3%;

    }
    .sign-up-txt{
        color:#1867c0 !important;
        font-weight: bolder;
        text-decoration: underline;
        cursor: pointer;
    }
</style>

