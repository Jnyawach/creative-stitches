import axios from "axios"
import {ref} from "vue";



export function useCategory(){
    const categories=ref([])
    //get a task
    axios.get('get/categories')
        .then(function (response) {
            // handle success
            categories.value = response.data.data;
            //console.log(response.data.data)

        })

    return {
        categories
    }
}
