import axios from "./Axiosinstance";
class fetchUrl {

    static async post(url,body) {
        try {
            await axios.post(url,body)
            console.log("In POST fetch: ",url)
        } catch (error) {
            console.log("In POST fetch: ",error.message)
        }
    }

    static async get(url) {
        try {
            const response = await axios.get(url)
            console.log("In fetch: ",url)
            return response.data
        } catch (error) {
            console.log("In fetch: ",error.message)
        }
    }
}
export default fetchUrl;


// feat Axiosinstance,Fetch and useEffectOnce created for handling get and post fetches