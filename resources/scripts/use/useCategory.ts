import axios from "axios"
import {ref} from "vue";


export function useCategory(){
    const categories=ref([])
    const base_url='http://127.0.0.1:8000/api/get/categories'

    //get a task
    axios.get(base_url)
        .then(function (response) {
            // handle success
            categories.value = response.data;
            console.log(response.data.categories)

        })

    return {
        categories
    }
}
