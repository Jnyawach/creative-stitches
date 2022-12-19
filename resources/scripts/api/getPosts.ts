import axios from "axios";
const getPosts= async(limit:any, skip:any)=>{
 const posts=await axios.get(`http://127.0.0.1:8000/api/get/posts?limit=${limit}&skip=${skip}`)
    return posts.data.data
};
export default getPosts;
