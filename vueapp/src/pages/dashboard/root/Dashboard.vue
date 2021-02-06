<template>
    <v-app style="overflow: scroll;">



        <v-navigation-drawer

                height="100%;"
                class="overflow-hidden"
                style="position:fixed;top:0;bottom:0;left:0;right:0"
                v-model="draw"
                absolute
                temporary
        >
            <v-list-item>


                <v-list-item-content>
                    <v-list-item-title>Welcome To Minisend</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list dense>
              <router-link
                      style="text-decoration: none !important;"
                      v-for="item in items"
                      :key="item.title"
                      link
                      v-bind:to="item.url"
              >
                  <v-list-item>

                      <v-list-item-icon>
                          <v-icon>{{ item.icon }}</v-icon>
                      </v-list-item-icon>

                      <v-list-item-content>
                          <v-list-item-title>{{ item.title }}</v-list-item-title>
                      </v-list-item-content>


                  </v-list-item>

              </router-link>



            </v-list>
        </v-navigation-drawer>




        <v-app-bar
                :collapse="!collapseOnScroll"
                :collapse-on-scroll="collapseOnScroll"
                absolute
                style="height: 78px;position: fixed"
                color="#1867c0 !important"
                dark
                scroll-target="#scrolling-techniques-6"
        >
            <v-app-bar-nav-icon @click.stop="draw = !draw" ></v-app-bar-nav-icon>

            <v-toolbar-title>MiniSend</v-toolbar-title>

            <v-spacer>
                <v-text-field
                         class="custom-text-field"
                        label="Click Here To Filter Mails"
                        filled
                        rounded
                        prepend-inner-icon="mdi-map-marker"
                        dense
                ></v-text-field>
            </v-spacer>

            <v-checkbox
                    color="white"
                    hide-details
            ></v-checkbox>
        </v-app-bar>



        <div class="dashboard-items" style="margin-top: 80px !important;">
            <router-view></router-view>
        </div>






    </v-app>

</template>

<script>



    export default {
        name: "Dashboard",
        components:{

        },
        data: () => ({
            collapseOnScroll: true,
            draw:null,
            items: [
                { title: 'View Mails', icon: 'mdi-home-city', url: '/dashboard/mail-lists' },
                { title: 'Send Mail', icon: 'mdi-account-group-outline',url:'/dashboard/create-mail' },
            ],
        }),
    }
</script>

<style scoped>
.custom-text-field{
    cursor: pointer !important;height:40px !important;line-height:.5 !important;
    margin-top:10px!important;margin-left: 15% !important;margin-right:15% !important;
}
</style>