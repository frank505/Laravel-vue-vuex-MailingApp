<template>

    <v-card
            class="mx-auto reduce-width"
            tile
    >


        <v-list-item two-line>
            <v-list-item-content>
                <v-list-item-title class="bold-txt">Subject</v-list-item-title>
                <v-list-item-subtitle>{{this.mailData.subject}}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

        <v-list-item two-line>
            <v-list-item-content>
                <v-list-item-title class="bold-txt">From</v-list-item-title>
                <v-list-item-subtitle >{{this.mailData.from}}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

        <v-list-item two-line>
            <v-list-item-content>
                <v-list-item-title class="bold-txt">To</v-list-item-title>
                <v-list-item-subtitle @click="gotoSpecificUserMail(mailData.to)" class="toStyles">{{this.mailData.to}}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

        <v-list-item three-line>
            <v-list-item-content>
                <v-list-item-title class="bold-txt">Text Message</v-list-item-title>
                <v-list-item-subtitle >
                   {{this.mailData.text_content}}
                </v-list-item-subtitle>


            </v-list-item-content>
        </v-list-item>


        <v-list-item three-line>
            <v-list-item-content>
                <v-list-item-title class="bold-txt">Html Content</v-list-item-title>
                <v-list-item-subtitle v-html="htmlString"
                >
                </v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

        <v-list-item two-line>
            <v-list-item-content>
                <v-list-item-title class="bold-txt">Attachments</v-list-item-title>
                <v-list-item-subtitle>
                    <template  v-for="(item,index) in this.mailData.attachements">

                            <a :href="attachedBaseUrl+'/'+item.file_name"
                               :download="attachedBaseUrl+'/'+item.file_name" style="padding:2%;margin:1px;color:red;"
                               :key="index">{{item.file_name}}</a>

                    </template>
                </v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

    </v-card>



</template>

<script>
    import { getSingleMailService} from "../../../services/dashboard/MailService";


    export default {
        name: "MailList",

        data: ()=>({
            mailData:"",
            attachedBaseUrl:"",
            htmlString:''

        }),

        methods:{

            gotoSpecificUserMail(userMail)
         {
            this.$router.push("/dashboard/recipients-mail?mail="+userMail);
         },
            loadMail()
            {
               let uuid = this.$router.history.current.params.uuid;

                getSingleMailService(uuid).then((data)=>
                {
                    console.log(data);
                    this.attachedBaseUrl = data.data.base_url;
                   this.mailData = data.data.data;
                   this.htmlString = data.data.html_content;

                });
            }
        },

        created() {
            this.loadMail();
        }

    }
</script>

<style scoped>
 .reduce-width{
     width: 80%;margin-left: 15%;margin-right: 15%;
     align-content: center !important;
     align-items: center !important;
     text-align: center;
     margin-top:40px;
 }
    .container-div{
        padding: 1%;
        border-bottom: 1px solid #ccc;
    }
   .bold-txt{
       font-weight: bolder;
   }
    .toStyles{
        cursor: pointer;
        text-decoration: underline;
    }
</style>