import axios from "axios";
import {ref} from "vue";
export function useCountry(){
    const countries=ref([])
    axios.get('api/get/country')
        .then(function (response) {
            // handle success
            countries.value = response.data;
            //console.log(response.data)

        })

    return {
        countries
    }
}
