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

                                <v-alert
                                        type="error"
                                        :class="showErr==false?'hideStyle':'showStyle'"
                                >
                                    Please Ensure not all Filter Fields are Empty
                                </v-alert>

                                <v-text-field
                                        label="From"
                                        v-model="from"
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
                                        v-model="to"
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
                                        v-model="subject"
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

          data: () =>(
              {
                 from:'',
                 to:"",
                 subject:'',
                  showErr:false
              }),
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
                 this.showErr = false;

                 if(this.from=='' && this.to=='' && this.subject=='')
                 {
                     this.showErr = true;
                     return;
                 }


                 this.$router.push('/dashboard/dashboard-filter?from='+
                      this.from+"&to="+this.to+"&subject="+this.subject);

                 this.hideModal()
             }
         }
      }
  </script>


<style scoped>
.showStyle{
    display: block;
}
    .hideStyle{
        display: none;
    }
</style>