<template>
    <v-app>
        <v-card
            class="mx-auto"
            style="width:100%;"
    >


        <v-list two-line>
            <v-list-item-group
                    multiple
            >
                <template v-for="(item, index) in viewMails.data.data">
                    <v-list-item :key="item.title" @click="goToViewSinglePage(item.uuid)">
                        <template>
                            <v-list-item-content>
                                <v-list-item-title v-text="item.to"
                                style="font-weight: bolder"
                                ></v-list-item-title>

                                <v-list-item-subtitle
                                        class="text--primary"
                                        v-text="item.subject"
                                ></v-list-item-subtitle>

                                <v-list-item-subtitle v-text="item.text_content"></v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-action>
                                <v-list-item-action-text v-text="item.created_at"></v-list-item-action-text>
                                <v-list-item-action-text v-text="item.status"></v-list-item-action-text>



                            </v-list-item-action>
                        </template>

                    </v-list-item>

                    <v-divider
                            v-if="index < viewMails.data.data.length - 1"
                            :key="index"
                    ></v-divider>
                </template>
            </v-list-item-group>
        </v-list>

    </v-card>

    <v-pagination
            style="margin-top: 10px"
            v-model="pagination.page"
            :length="pagination.pages"
            @input="next"
    ></v-pagination>
    </v-app>
</template>


<script>
    import {mapActions,mapState} from 'vuex';

    export default {

        computed: {
            ...mapState('Mail',['viewMails'])
        },
        data: () => ({

            pagination:{
                pages:1,
                page:1
            },

        }),
       methods:{
           ...mapActions('Mail',['viewMailsAction','clearViewMailsState']),
               next (page)
               {
               this.viewMailsAction(page);
                },

             loadData()
             {
              this.viewMailsAction(this.pagination.page);

             },
           goToViewSinglePage(uuid)
           {
               this.$router.push("/dashboard/view-mail/"+uuid);
           }
       },

        created()
        {

        },
        mounted() {
            this.loadData();
        },

        watch:{
         viewMails()
         {
            if(this.viewMails.data.data.length > 0)
            {

               this.pagination.pages = Math.ceil(this.viewMails.data.total/this.viewMails.data.per_page);
            }
         }
        }
    }
</script>