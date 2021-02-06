import * as Types from "./MutationTypes";
import router from "../../../router";
import {createMailService} from "../../../services/dashboard/MailService";

export default {
    namespaced :true,
    state:{
        createMail:'',
        viewMails:'',
        viewMail:''
    },
    mutations:{
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
    }
}