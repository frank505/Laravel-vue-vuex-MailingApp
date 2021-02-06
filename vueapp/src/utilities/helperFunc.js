export const EmailCheckRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;

export const PasswordCheckRegex =  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/i;


export const checkIfFieldsAreEmpty = (dataObject) => {
    console.log(dataObject);
    for (var objects in dataObject) {
        console.log(objects);
        /**
         * if  an empty field exist return return false
         */
        if (dataObject[objects] == '' || dataObject[objects] == null) {
            return false;
        }
        /**
         * if  an invalid email exists in the form then return false
         */
        if (objects == 'email') {
            if (
                !/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(dataObject[objects])
            ) {
                return false;
            }
        }

        // if(objects == 'password')
        // {
        //     if(PasswordCheckRegex.test(dataObject[objects])==false)
        //     {
        //         return false;
        //     }
        // }

        if (objects == false) {
            return false;
        }
    }
    /**
     * all forms fields have been submited then we return false and set disable property to true
     */
    return true;
};