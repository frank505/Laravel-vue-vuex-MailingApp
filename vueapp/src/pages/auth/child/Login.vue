 <template>
        <v-app>
        <v-card
                class=" custom-styles"
                >

               <v-card-title>
                   Login Here
               </v-card-title>
               <v-card-subtitle>
                   please enter a valid email and password
               </v-card-subtitle>

            <form>

                <v-text-field
                        v-model="email"
                        :error-messages="emailErrors"
                        label="E-mail"
                        required
                        @input="$v.email.$touch()"
                        @blur="$v.email.$touch()"
                ></v-text-field>

                <v-text-field
                        v-model="password"
                        :error-messages="passwordErrors"
                        :counter="10"
                        label="Password"
                        type="password"
                        required
                        @input="$v.password.$touch()"
                        @blur="$v.password.$touch()"
                ></v-text-field>

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

       <v-card-text class="sign-up-txt" @click="goToRegisterPage">Click Here To Sign Up</v-card-text>


        </v-card>

        </v-app>

    </template>

<script>

    import { validationMixin } from 'vuelidate'
    import { required, maxLength, email } from 'vuelidate/lib/validators'

    export default {
        mixins: [validationMixin],

        validations: {
            password: { required, maxLength: maxLength(10) },
            email: { required, email }
        },

        data: () => ({
            email: '',
            password: '',
        }),

        computed: {

            passwordErrors () {
                const errors = []
                if (!this.$v.password.$dirty) return errors
                !this.$v.password.maxLength && errors.push('Password must be at most 10 characters long')
                !this.$v.password.required && errors.push('Password is required.')
                return errors
            },
            emailErrors () {
                const errors = []
                if (!this.$v.email.$dirty) return errors
                !this.$v.email.email && errors.push('Must be valid e-mail')
                !this.$v.email.required && errors.push('E-mail is required')
                return errors
            },
        },

        methods: {
            submit () {
                this.$v.$touch()
            },
            clear () {
                this.$v.$reset()
                this.email = ''
                this.password = ''

            },
            goToRegisterPage()
            {
                this.$router.push('/register');
            }
        },
    }

</script>


 <style scoped>
     .custom-styles{
         width:50%;
         margin-left:25%;
         margin-right: 25%;
         margin-top: 120px;
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

