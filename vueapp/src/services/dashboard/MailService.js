import HttpService from '../HttpService';

export const createMailService = (credentials) => {
    let tokenId = 'user-auth';
    const http = new HttpService();
    let Url = 'create-mail';
    return http
        .postDataWithFormData(credentials, Url, 'POST', tokenId)
        .then((data) => {
            //console.log(data);
            console.log(JSON.stringify(data));
            return data;
        })
        .catch((error) => {
            console.log(error);
            return error;
        });
};


export const getMailListService = (page) => {
    let tokenId = 'user-auth';
    const http = new HttpService();
    let Url = 'get-mails?page='+page;
    return http
        .getData(Url, tokenId)
        .then((data) => {
            //console.log(data);
            return data;
        })
        .catch((error) => {
            console.log(error);
        });
};


export const getSingleMailService = (uuid) => {
    let tokenId = 'user-auth';
    const http = new HttpService();
    let Url = 'get-mail/'+uuid;
    return http
        .getData(Url, tokenId)
        .then((data) => {
            //console.log(data);
            return data;
        })
        .catch((error) => {
            console.log(error);
        });
};
