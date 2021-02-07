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
                    <template v-for="(item, index) in filterData.data.data">
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
                                v-if="index < filterData.data.data.length - 1"
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
    import { getReciepientsMailService} from "../../../services/dashboard/MailService";

    export default {

        computed: {

        },
        data: () => ({

            pagination:{
                pages:1,
                page:1,

            },
            filterData:''

        }),
        methods:{

            next (page)
            {
                this.loadData(page)
            },

            loadData(currPage)
            {
                const urlParams = new URLSearchParams(window.location.search);
                let mail = urlParams.get('mail');

                getReciepientsMailService(mail,currPage).then((data)=>{
                    this.filterData = data;
                });

            },



            goToViewSinglePage(uuid)
            {
                this.$router.push("/dashboard/view-mail/"+uuid);
            }
        },

        created()
        {
            console.log(this.$router);
            this.loadData(1);
        },
        mounted() {

        },

        watch:{
            filterData()
            {
                if(this.filterData.data.data.length > 0)
                {

                    this.pagination.pages = Math.ceil(this.filterData.data.total/this.filterData.data.per_page);
                }
            },
            $route ()
            {
                this.loadData(1);
            }
        }
    }
</script>