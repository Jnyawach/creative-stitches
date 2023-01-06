import axios from "axios";
import {reactive, ref} from "vue";

export  function useCart(){
    const cart=ref([])
    axios.get('cart-get')
        .then(function (response) {
            // handle success
            cart.value = response.data[0];
            //console.log(response.data.data)

        })


    return {
        cart
    }
}
