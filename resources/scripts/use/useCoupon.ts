import axios from "axios";
import {ref} from "vue";
export  function useCoupon() {
    const coupon=ref('')

    axios.get('api/get/coupon')
        .then(function (response) {
            // handle success
            coupon.value = response.data;
            //console.log(response.data)

        })





    return{
        coupon
    }
}
