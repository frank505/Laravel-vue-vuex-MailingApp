import * as Types from "./MutationTypes";
import router from "../../../router";
import {createMailService, getMailListService} from "../../../services/dashboard/MailService";


export default {
    namespaced :true,
    state:{
        createMail:'',
        viewMails:'',
        viewMail:'',
        displayMailModal:''
    },
    mutations:{
        /**
         * create mail
         * */
        [Types.RESTART_CREATE_MAIL_RESPONSE] (state) {
            state.createMail = "";
        },
        [Types.CREATE_MAIL_LOADING] (state) {
            state.createMail = "loading..";
        },
        [Types.CREATE_MAIL_SUCCESS] (state, data) {
            state.createMail = data;
        },
        [Types.CREATE_MAIL_ERROR] (state, data) {
            if(typeof data.error == 'undefined')
            {
                let dataErr = {success:false,message:data.error};
                state.createMail = dataErr;

            }else if(typeof data.error =='object')
            {
                Object.keys(data.error).map((keys)=>{

                    let dataErr = {success:false,message:data.error[keys][0]};
                    state.createMail = dataErr;

                });
            }else if(typeof data.error == 'string')
            {
                let dataErr = {success:false, message:data.error};
                state.createMail = dataErr;
            }
        },


        /**
         * view mail
         * */
        [Types.RESTART_VIEW_MAILS_RESPONSE] (state) {
            state.viewMails = "";
        },
        [Types.VIEW_MAILS_LOADING] (state) {
            state.viewMails = "loading..";
        },
        [Types.VIEW_MAILS_SUCCESS] (state, data) {
            state.viewMails = data;
        },
        [Types.VIEW_MAILS_ERROR] (state, data) {
            if(typeof data.error == 'undefined')
            {
                let dataErr = {success:false,message:data.error};
                state.viewMails = dataErr;

            }else if(typeof data.error =='object')
            {
                Object.keys(data.error).map((keys)=>{

                    let dataErr = {success:false,message:data.error[keys][0]};
                    state.viewMails = dataErr;

                });
            }else if(typeof data.error == 'string')
            {
                let dataErr = {success:false, message:data.error};
                state.viewMails = dataErr;
            }

        },


        [Types.HIDE_MAIL_FILTER_MODAL] (state) {
            state.displayMailModal = false;
        },
        [Types.VIEW_MAILS_FILTER_MODAL] (state) {
            state.displayMailModal = true;
        },

    },
    actions:{
        clearCreateMailState({commit})
        {
            commit(Types.RESTART_CREATE_MAIL_RESPONSE);
        },
        createMailAction ({commit}, data)
        {
            console.log(router);
            commit(Types.RESTART_CREATE_MAIL_RESPONSE);
            commit(Types.CREATE_MAIL_LOADING);
            createMailService(data).then((response)=>
            {
                if(response.success == true)
                {
                    commit(Types.CREATE_MAIL_SUCCESS,response);

                }else
                {
                    commit(Types.CREATE_MAIL_ERROR,response);
                }
            });
        },
        clearViewMailsState({commit})
        {
            commit(Types.RESTART_VIEW_MAILS_RESPONSE);
        },
        viewMailsAction ({commit}, data)
        {
            console.log(router);
            commit(Types.RESTART_VIEW_MAILS_RESPONSE);
            commit(Types.CREATE_MAIL_LOADING);
            getMailListService(data).then((response)=>
            {
                if(response.success == true)
                {
                    console.log(response);
                    commit(Types.VIEW_MAILS_SUCCESS,response);

                }else
                {
                    commit(Types.VIEW_MAILS_ERROR,response);
                }
            });
        },
        hideMailFilterModal({commit})
        {
            commit(Types.HIDE_MAIL_FILTER_MODAL);
        },
        showMailFilterModal({commit})
        {
            commit(Types.VIEW_MAILS_FILTER_MODAL);
        }
    }
}