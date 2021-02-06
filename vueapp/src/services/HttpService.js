import Cookies from 'js-cookie'


class HttpService
{


    setUrl = () =>
    {
        let url = "http://0.0.0.0/api";

        return url;
    }


    appDomain = () =>
    {
        let url = "http://0.0.0.0/api";
        return url;
    }

    postData = async(item ,addedUrl,postType,tokenId="") =>
    {
        const token = await Cookies.get(tokenId);


        const requestOptions = this.postRequestOptions(token,item,postType);

        console.log(requestOptions);

        return fetch(this.setUrl()+"/"+addedUrl, requestOptions).then(
            response=>response.json());
    }


    getData = async(addedUrl,tokenId="") =>
    {
        const token = await Cookies.get(tokenId);
        const requestOptions = this.getRequestOptions(token);

        return fetch(this.setUrl()+"/"+addedUrl, requestOptions).then(
            response=>response.json());
    }


    deleteData = async(addedUrl,tokenId="") =>
    {
        const token = await Cookies.get(tokenId);
        const requestOptions = this.deleteRequestOptions(token);

        return fetch(this.setUrl()+"/"+addedUrl, requestOptions).then(
            response=>response.json());
    }

    getRequestOptions = (token) =>
    {
        let requestOptions = {
            method:'GET',
            headers:{
                'Authorization':'Bearer '+token,
                'Content-type':'application/json',
            }
        }



        return requestOptions;
    }


    postRequestOptions = (token,item,postType) =>
    {
        let requestOptions = {
            method:postType,
            cache: 'no-cache',
            headers:{
                'Content-type':'Application/json',
                'Accept': 'application/json, text/plain, */*',
                'Authorization':`Bearer ${token}`
            },

            body:JSON.stringify(item)


        }

        return requestOptions;
    }



    deleteRequestOptions = (token) =>
    {
        let requestOptions = {
            method:'DELETE',
            headers:{
                'Authorization':'Bearer '+token,
                'Content-type':'application/json',
            }
        }

        return requestOptions;
    }

    postDataWithFormData = async (item, addedUrl, postType, tokenId = '') => {
        const token = await Cookies.get(tokenId);

        const requestOptions = this.postRequestOptionsWithFormData(
            token,
            item,
            postType,
        );

        console.log(this.setUrl() + '/' + addedUrl);

        return fetch(
            this.setUrl() + '/' + addedUrl,
            requestOptions,
        ).then((response) => response.json());
    };


    postRequestOptionsWithFormData = (token, item, postType) => {
        let requestOptions = {
            method: postType,
            headers: {
                Authorization: 'Bearer ' + token,
            },

            body: item,
        };

        return requestOptions;
    };

}


export default HttpService;








