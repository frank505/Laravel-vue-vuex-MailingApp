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


            <v-app-bar-nav-icon
                    :style="this.showMe"
                    @click.stop="draw = !draw" ></v-app-bar-nav-icon>

          <v-app-bar-title :style="this.showMeBackButton">
              <v-icon
                      large
                      color="white"
                      @click="goBackToPreviousPage"
                      style="margin-right:30px;cursor:pointer"
              >
                  mdi-arrow-left
              </v-icon>
          </v-app-bar-title>

            <v-toolbar-title>MiniSend</v-toolbar-title>

            <v-spacer>
            </v-spacer>

            <v-btn icon @click="loadModalSearch">
                <v-icon>mdi-magnify</v-icon>
            </v-btn>

            <v-btn icon @click="logout">
                <v-icon>mdi-logout</v-icon>
            </v-btn>

        </v-app-bar>



        <div class="dashboard-items" style="margin-top: 80px !important;">
            <router-view></router-view>
        </div>

          <Modal></Modal>

    </v-app>

</template>

<script>




    import {LogoutService} from "../../../services/auth/AuthService";
    import Modal from "../../../components/dashboard/Modal";
    import {mapActions} from "vuex";

    export default {
        name: "Dashboard",
        components:{
            Modal

        },
        data: () => ({
            collapseOnScroll: true,
            showMe:"display:block",
            showMeBackButton:"display:none",
            dialog:false,
            draw:null,
            items: [
                { title: 'View Mails', icon: 'mdi-home-city', url: '/dashboard/mail-lists' },
                { title: 'Send Mail', icon: 'mdi-account-group-outline',url:'/dashboard/create-mail' },

            ],
        }),

        methods:{
            ...mapActions('Mail',['hideMailFilterModal','showMailFilterModal']),
            hideOrShowButtonForNavigation()
            {
                let $currentLocation = window.location.pathname;
                let $splitLocation = $currentLocation.split('/');
                console.log($splitLocation[2]);
                if($splitLocation[2] == 'view-mail')
                {
                    this.showMe="display:none";
                    this.showMeBackButton = "display:block";
                }else
                {
                    this.showMe = "display:block";
                    this.showMeBackButton = "display:none";
                }
            },
            goBackToPreviousPage ()
            {
                this.$router.back();
            },
            logout()
            {
                LogoutService().then(()=>
                {
                    this.$router.push("/login");
                });


            },
            loadModalSearch()
            {
                console.log('this is the enter oooo')
                this.showMailFilterModal();
            }
        },
        watch:{

            $route ()
            {
            this.hideOrShowButtonForNavigation();
            }
        },
        created() {
           // this.hideOrShowButtonForNavigation();
        }
    }
</script>

<style scoped>
.custom-text-field{
    cursor: pointer !important;height:40px !important;line-height:.5 !important;
    margin-top:10px!important;margin-left: 15% !important;margin-right:15% !important;
}
</style>