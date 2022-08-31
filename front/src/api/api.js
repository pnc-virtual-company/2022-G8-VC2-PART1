import axios from "axios";

const axiosApi = axios.create({
  baseURL: process.env.VUE_APP_API_URL,
  headers: {
    "Content-type": "application/json",
    'Authorization': 'Bearer ' +  localStorage.getItem('token')
  },
});

axiosApi.interceptors.request.use(function (config) {
  const token = localStorage.getItem("token");
  config.headers.Authorization = token ? `Bearer ${token}` : "";
  console.log(localStorage.getItem('token')+"token reply-------------------------------")
  return config;
});

export default axiosApi;

// import axios from "@/axios-http";

// axios.interceptors.request.use(function (config) {
//   const token = localStorage.getItem("token");
//   config.headers.Authorization = token ? 'Bearer ${token}' : "";
//   return config;
// });

// export default axios;