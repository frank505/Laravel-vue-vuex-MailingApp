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