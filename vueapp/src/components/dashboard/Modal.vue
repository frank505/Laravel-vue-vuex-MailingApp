<template>
    <v-row justify="center">
        <v-dialog
                v-model="this.displayMailModal"
                persistent
                max-width="600px"
        >

            <v-card>
                <v-card-title>
                    <span class="headline">Filter Data</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="From"
                                        required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="To"
                                        hint="the person the email was sent to"
                                ></v-text-field>
                            </v-col>
                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Subject"
                                        hint="the person who sent the email"
                                        persistent-hint
                                        required
                                ></v-text-field>
                            </v-col>


                        </v-row>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                            color="blue darken-1"
                            text
                            @click="hideModal"
                    >
                        Close
                    </v-btn>
                    <v-btn
                            color="blue darken-1"
                            text
                            @click="filterModal"
                    >
                        Search
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>


  <script>
      import {mapActions,mapState} from 'vuex';

      export default {

          computed: {
              ...mapState('Mail', ['displayMailModal'])
          },

         methods:{
             ...mapActions('Mail',['hideMailFilterModal','showMailFilterModal']),
             hideModal()
             {
                 this.hideMailFilterModal();
             },
             filterModal()
             {
                 this.hideMailFilterModal();
             }
         }
      }
  </script>


<style scoped>

</style>