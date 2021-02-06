<template>

             <div>
           <v-row style="border: 1px solid #ccc;padding:2%;margin-top: 30px">
               <v-col md="8">

                   <span>back</span>
                   <span>Header of the news</span>
               </v-col>
               <v-col md="4">
                   19:01:2020
               </v-col>

           </v-row>

           <v-row style="border: 1px solid #ccc;padding:2%;">
               <v-col md="8">

                   <span>from </span>
                   <span>to </span>
               </v-col>
               <v-col md="4">
                   Download attached files here
               </v-col>

           </v-row>


                 <v-row style="border: 1px solid #ccc;padding:2%;text-align: center">
                     <v-col md="12">
                      <b>html content displayed here</b>
                     </v-col>


                 </v-row>

             </div>



</template>

<script>
    export default {
        name: "MailList"
    }
</script>

<style scoped>

</style>