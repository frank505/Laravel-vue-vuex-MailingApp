import HttpService from '../HttpService';
import Cookies from 'js-cookie'



export const LoginService = (credentials) =>{
    const http = new HttpService();
    let addedUrl = "login";
    return http.postData(credentials,addedUrl,"POST").then(data=>{
        console.log(JSON.stringify(data));

        return data;
    }).catch((error)=> {console.log(error)
        return error;
    });
}


export const RegisterService = (credentials) =>{
    const http = new HttpService();
    let addedUrl = "register";
    return http.postData(credentials,addedUrl,"POST").then(data=>{
        console.log(JSON.stringify(data));
        console.log(data);
        return data;
    }).catch((error)=> {console.log(error)
        return error;
    });
}

export const LogoutService =()=>
{
    return new Promise(function(resolve)
    {
        Cookies.remove('user-auth');
        resolve(true);
    });
}

export const setTokenService = (token) =>
{
    return new Promise(function(resolve)
    {
        Cookies.set('user-auth',token);
        resolve(true);
    });

}




